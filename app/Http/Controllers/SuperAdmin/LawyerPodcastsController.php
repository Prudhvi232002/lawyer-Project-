<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerPodcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerPodcastsImport;
use App\Models\Podcast;
use App\Models\Lawyer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class LawyerPodcastsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_podcast');
        $this->middleware('permission:lawyer.add_podcast', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_podcast', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_podcast', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_podcast', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_podcast', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_podcasts =  $lawyer->lawyer_podcasts();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_podcasts =  $lawyer_podcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_podcasts =  $lawyer_podcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_podcasts = $lawyer_podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_podcasts = $lawyer_podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_podcasts = $lawyer_podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_podcasts = $lawyer_podcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_podcasts = $lawyer_podcasts->get();
                return $lawyer_podcasts;
            }
            $lawyer_podcasts = $lawyer_podcasts->get();
            return $lawyer_podcasts;
        }
        $lawyer_podcasts = $lawyer->lawyer_podcasts()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_podcasts;
    }


    /*********View All LawyerPodcasts  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_podcasts = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_podcasts.index', compact('lawyer_podcasts', 'lawyer'));
    }

    /*********View Create Form of Podcast  ***********/
    public function create(Lawyer $lawyer)
    {
        $tags = Tag::active()->get();
        return view('super_admins.lawyers.lawyer_podcasts.create', compact('lawyer', 'tags'));
    }

    /*********Store Podcast  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                $data['audio'] = uploadFile($request, 'file', 'lawyer_podcasts');
            } else {
                $data['video'] = uploadFile($request, 'file', 'lawyer_podcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','lawyer_podcasts');
            $lawyer_podcast = $lawyer->lawyer_podcasts()->create($data);
            $lawyer_podcast->slug = Str::slug($lawyer_podcast->name . ' ' . $lawyer_podcast->id, '-');
            $lawyer_podcast->save();
            $lawyer_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_podcasts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_podcasts.index', $lawyer->id)->with('message', 'Podcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Podcast  ***********/
    public function show(Lawyer $lawyer, Podcast $lawyer_podcast)
    {
        if ($lawyer->id != $lawyer_podcast->lawyer_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_podcasts.show', compact('lawyer_podcast', 'lawyer'));
    }

    /*********View Edit Form of Podcast  ***********/
    public function edit(Lawyer $lawyer, Podcast $lawyer_podcast)
    {
        if ($lawyer->id != $lawyer_podcast->lawyer_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_podcasts.edit', compact('lawyer_podcast', 'lawyer'));
    }

    /*********Update Podcast  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Podcast $lawyer_podcast)
    {
        if ($lawyer->id != $lawyer_podcast->lawyer_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                if ($request->file) {
                    $data['audio'] = uploadFile($request, 'file', 'lawyer_podcasts');
                } else {
                    $data['audio'] = $lawyer_podcast->audio;
                }
            } else {
                if ($request->file) {
                    $data['video'] = uploadFile($request, 'file', 'lawyer_podcasts');
                } else {
                    $data['video'] = $lawyer_podcast->video;
                }
            }
            $lawyer_podcast->update($data);
            $lawyer_podcast = Podcast::find($lawyer_podcast->id);
            $slug = Str::slug($lawyer_podcast->name . ' ' . $lawyer_podcast->id, '-');
            $lawyer_podcast->update([
                'slug' => $slug
            ]);
            $lawyer_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_podcasts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_podcasts.index', $lawyer->id)->with('message', 'Podcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_podcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_podcasts." . $extension;
        return Excel::download(new LawyerPodcastsExport($lawyer_podcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerPodcastsImport, $file);
        return redirect()->back()->with('message', 'Podcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Podcast ***********/
    public function destroy(Lawyer $lawyer, Podcast $lawyer_podcast)
    {
        if ($lawyer->id != $lawyer_podcast->lawyer_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $lawyer_podcast->delete();
        return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Podcast ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_podcast)
    {
        $lawyer_podcast = Podcast::withTrashed()->find($lawyer_podcast);
        if ($lawyer_podcast) {
            if ($lawyer_podcast->trashed()) {
                if ($lawyer_podcast->image && file_exists(public_path($lawyer_podcast->image))) {
                    unlink(public_path($lawyer_podcast->image));
                }
                $lawyer_podcast->forceDelete();
                return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Podcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Podcast***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_podcast)
    {
        $lawyer_podcast = Podcast::withTrashed()->find($lawyer_podcast);
        if ($lawyer_podcast->trashed()) {
            $lawyer_podcast->restore();
            return redirect()->back()->with('message', 'Podcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
}
