<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawFirmPodcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmPodcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawFirmPodcastsImport;
use App\Models\Podcast;
use App\Models\LawFirm;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class LawFirmPodcastsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_podcast');
        $this->middleware('permission:law_firm.add_podcast', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_podcast', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_podcast', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_podcast', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_podcast', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_podcasts =  $law_firm->law_firm_podcasts();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_podcasts =  $law_firm_podcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_podcasts =  $law_firm_podcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_podcasts = $law_firm_podcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_podcasts = $law_firm_podcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_podcasts = $law_firm_podcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_podcasts = $law_firm_podcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_podcasts = $law_firm_podcasts->get();
                return $law_firm_podcasts;
            }
            $law_firm_podcasts = $law_firm_podcasts->get();
            return $law_firm_podcasts;
        }
        $law_firm_podcasts = $law_firm->law_firm_podcasts()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_podcasts;
    }


    /*********View All LawFirmPodcasts  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_podcasts = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_podcasts.index', compact('law_firm_podcasts', 'law_firm'));
    }

    /*********View Create Form of Podcast  ***********/
    public function create(LawFirm $law_firm)
    {
        $tags = Tag::active()->get();
        return view('super_admins.law_firms.law_firm_podcasts.create', compact('law_firm', 'tags'));
    }

    /*********Store Podcast  ***********/
    public function store(CreateRequest $request, LawFirm $law_firm)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                $data['audio'] = uploadFile($request, 'file', 'law_firm_podcasts');
            } else {
                $data['video'] = uploadFile($request, 'file', 'law_firm_podcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','law_firm_podcasts');
            $law_firm_podcast = $law_firm->law_firm_podcasts()->create($data);
            $law_firm_podcast->slug = Str::slug($law_firm_podcast->name . ' ' . $law_firm_podcast->id, '-');
            $law_firm_podcast->save();
            $law_firm_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_podcasts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_podcasts.index', $law_firm->id)->with('message', 'Podcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Podcast  ***********/
    public function show(LawFirm $law_firm, Podcast $law_firm_podcast)
    {
        if ($law_firm->id != $law_firm_podcast->law_firm_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_podcasts.show', compact('law_firm_podcast', 'law_firm'));
    }

    /*********View Edit Form of Podcast  ***********/
    public function edit(LawFirm $law_firm, Podcast $law_firm_podcast)
    {
        if ($law_firm->id != $law_firm_podcast->law_firm_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_podcasts.edit', compact('law_firm_podcast', 'law_firm'));
    }

    /*********Update Podcast  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Podcast $law_firm_podcast)
    {
        if ($law_firm->id != $law_firm_podcast->law_firm_id) {
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
                    $data['audio'] = uploadFile($request, 'file', 'law_firm_podcasts');
                } else {
                    $data['audio'] = $law_firm_podcast->audio;
                }
            } else {
                if ($request->file) {
                    $data['video'] = uploadFile($request, 'file', 'law_firm_podcasts');
                } else {
                    $data['video'] = $law_firm_podcast->video;
                }
            }
            $law_firm_podcast->update($data);
            $law_firm_podcast = Podcast::find($law_firm_podcast->id);
            $slug = Str::slug($law_firm_podcast->name . ' ' . $law_firm_podcast->id, '-');
            $law_firm_podcast->update([
                'slug' => $slug
            ]);
            $law_firm_podcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_podcasts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_podcasts.index', $law_firm->id)->with('message', 'Podcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_podcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_podcasts." . $extension;
        return Excel::download(new LawFirmPodcastsExport($law_firm_podcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmPodcastsImport, $file);
        return redirect()->back()->with('message', 'Podcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Podcast ***********/
    public function destroy(LawFirm $law_firm, Podcast $law_firm_podcast)
    {
        if ($law_firm->id != $law_firm_podcast->law_firm_id) {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
        $law_firm_podcast->delete();
        return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Podcast ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_podcast)
    {
        $law_firm_podcast = Podcast::withTrashed()->find($law_firm_podcast);
        if ($law_firm_podcast) {
            if ($law_firm_podcast->trashed()) {
                if ($law_firm_podcast->image && file_exists(public_path($law_firm_podcast->image))) {
                    unlink(public_path($law_firm_podcast->image));
                }
                $law_firm_podcast->forceDelete();
                return redirect()->back()->with('message', 'Podcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Podcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Podcast***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_podcast)
    {
        $law_firm_podcast = Podcast::withTrashed()->find($law_firm_podcast);
        if ($law_firm_podcast->trashed()) {
            $law_firm_podcast->restore();
            return redirect()->back()->with('message', 'Podcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Podcast Not Found')->with('message_type', 'error');
        }
    }
}
