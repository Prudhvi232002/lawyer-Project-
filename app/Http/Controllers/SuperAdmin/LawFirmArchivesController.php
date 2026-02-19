<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ArchivesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmArchives\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ArchivesImport;
use App\Models\Archive;
use App\Models\LawFirm;
use App\Models\ArchiveCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_archive');
        $this->middleware('permission:law_firm.add_archive', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_archive', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_archive', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_archive', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_archive', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_archives =  $law_firm->law_firm_archives();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_archives =  $law_firm_archives->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_archives =  $law_firm_archives->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_archives = $law_firm_archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_archives = $law_firm_archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_archives = $law_firm_archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_archives = $law_firm_archives->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_archives = $law_firm_archives->get();
                return $law_firm_archives;
            }
            $law_firm_archives = $law_firm_archives->get();
            return $law_firm_archives;
        }
        $law_firm_archives = $law_firm->law_firm_archives()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_archives;
    }


    /*********View All LawFirmArchives  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_archives = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_archives.index', compact('law_firm_archives', 'law_firm'));
    }

    /*********View Create Form of Archive  ***********/
    public function create(LawFirm $law_firm)
    {
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();

        return view('super_admins.law_firms.law_firm_archives.create', compact('archive_categories', 'law_firm', 'tags'));
    }

    /*********Store Archive  ***********/
    public function store(CreateRequest $request, LawFirm $law_firm)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_archives');
            $law_firm_archive = $law_firm->law_firm_archives()->create($data);
            $law_firm_archive->slug = Str::slug($law_firm_archive->name . ' ' . $law_firm_archive->id, '-');
            $law_firm_archive->save();
            $law_firm_archive = $law_firm->law_firm_archives()->withAll()->find($law_firm_archive->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_archives.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_archives.index', $law_firm->id)->with('message', 'Archive Created Successfully')->with('message_type', 'success');
    }

    /*********View Archive  ***********/
    public function show(LawFirm $law_firm, Archive $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_archives.show', compact('law_firm_archive', 'law_firm'));
    }

    /*********View Edit Form of Archive  ***********/
    public function edit(LawFirm $law_firm, Archive $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
        }
        $archive_categories = ArchiveCategory::active()->get();
        $tags = Tag::active()->get();
        return view('super_admins.law_firms.law_firm_archives.edit', compact('law_firm_archive', 'archive_categories', 'law_firm', 'tags'));
    }

    /*********Update Archive  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Archive $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_archives', $law_firm_archive->image);
            } else {
                $data['image'] = $law_firm_archive->image;
            }
            $law_firm_archive->update($data);
            $law_firm_archive = Archive::find($law_firm_archive->id);
            $slug = Str::slug($law_firm_archive->name . ' ' . $law_firm_archive->id, '-');
            $law_firm_archive->update([
                'slug' => $slug
            ]);
            $law_firm_archive->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_archives.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_archives.index', $law_firm->id)->with('message', 'Archive Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_archives = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_archives." . $extension;
        return Excel::download(new ArchivesExport($law_firm_archives), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ArchivesImport, $file);
        return redirect()->back()->with('message', 'Archive Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Archive ***********/
    public function destroy(LawFirm $law_firm, Archive $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
        }
        $law_firm_archive->delete();
        return redirect()->back()->with('message', 'Archive Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Archive ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
        }
        $law_firm_archive = Archive::withTrashed()->find($law_firm_archive);
        if ($law_firm_archive) {
            if ($law_firm_archive->trashed()) {
                if ($law_firm_archive->image && file_exists(public_path($law_firm_archive->image))) {
                    unlink(public_path($law_firm_archive->image));
                }
                $law_firm_archive->forceDelete();
                return redirect()->back()->with('message', 'Archive Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Archive Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Archive***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_archive)
    {
        if ($law_firm->id != $law_firm_archive->law_firm_id) {
            return redirect()->back()->with('message', 'LawyerFirmArchive Not Found')->with('message_type', 'error');
        }
        $law_firm_archive = Archive::withTrashed()->find($law_firm_archive);
        if ($law_firm_archive->trashed()) {
            $law_firm_archive->restore();
            return redirect()->back()->with('message', 'Archive Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Archive Category Not Found')->with('message_type', 'error');
        }
    }
}
