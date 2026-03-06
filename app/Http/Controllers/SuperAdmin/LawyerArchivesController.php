<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchivesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerArchives\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchivesImport;
use App\Models\Archive;
use App\Models\Lawyer;
use App\Models\ArchiveCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawyerArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_archive');
        $this->middleware('permission:lawyer.add_archive', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_archive', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_archive', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_archive', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_archive', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_archives =  $lawyer->lawyer_archives();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_archives =  $lawyer_archives->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_archives =  $lawyer_archives->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_archives = $lawyer_archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_archives = $lawyer_archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_archives = $lawyer_archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_archives = $lawyer_archives->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_archives = $lawyer_archives->get();
                return $lawyer_archives;
            }
            $lawyer_archives = $lawyer_archives->get();
            return $lawyer_archives;
        }
        $lawyer_archives = $lawyer->lawyer_archives()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_archives;
    }


    /*********View All LawyerArchives  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_archives = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_archives.index', compact('lawyer_archives', 'lawyer'));
    }

    /*********View Create Form of Archive  ***********/
    public function create(Lawyer $lawyer)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();

        return view('super_admins.lawyers.lawyer_archives.create', compact('archive_categories', 'lawyer', 'tags'));
    }

    /*********Store Archive  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_archives');
            $lawyer_archive = $lawyer->lawyer_archives()->create($data);
            $lawyer_archive->slug = Str::slug($lawyer_archive->name . ' ' . $lawyer_archive->id, '-');
            $lawyer_archive->save();
            $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_archives.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_archives.index', $lawyer->id)->with('message', 'Archive Created Successfully')->with('message_type', 'success');
    }

    /*********View Archive  ***********/
    public function show(Lawyer $lawyer, Archive $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_archives.show', compact('lawyer_archive', 'lawyer'));
    }

    /*********View Edit Form of Archive  ***********/
    public function edit(Lawyer $lawyer, Archive $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.lawyers.lawyer_archives.edit', compact('lawyer_archive', 'archive_categories', 'lawyer', 'tags'));
    }

    /*********Update Archive  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Archive $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_archives', $lawyer_archive->image);
            } else {
                $data['image'] = $lawyer_archive->image;
            }
            $lawyer_archive->update($data);
            $lawyer_archive = Archive::find($lawyer_archive->id);
            $slug = Str::slug($lawyer_archive->name . ' ' . $lawyer_archive->id, '-');
            $lawyer_archive->update([
                'slug' => $slug
            ]);
            $lawyer_archive->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_archives.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_archives.index', $lawyer->id)->with('message', 'Archive Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_archives = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_archives." . $extension;
        return Excel::download(new ArchivesExport($lawyer_archives), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchivesImport, $file);
        return redirect()->back()->with('message', 'Archive Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Archive ***********/
    public function destroy(Lawyer $lawyer, Archive $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        $lawyer_archive->delete();
        return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Archive ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        $lawyer_archive = Archive::withTrashed()->find($lawyer_archive);
        if ($lawyer_archive) {
            if ($lawyer_archive->trashed()) {
                if ($lawyer_archive->image && file_exists(public_path($lawyer_archive->image))) {
                    unlink(public_path($lawyer_archive->image));
                }
                $lawyer_archive->forceDelete();
                return redirect()->back()->with('message', 'Archive Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Archive Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Archive***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_archive)
    {
        if ($lawyer->id != $lawyer_archive->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerArchive Not Found')->with('message_type', 'error');
        }
        $lawyer_archive = Archive::withTrashed()->find($lawyer_archive);
        if ($lawyer_archive->trashed()) {
            $lawyer_archive->restore();
            return redirect()->back()->with('message', 'Archive Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
}
