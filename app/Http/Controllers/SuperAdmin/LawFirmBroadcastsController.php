<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawFirmBroadcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmBroadcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawFirmBroadcastsImport;
use App\Models\Broadcast;
use App\Models\LawFirm;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class LawFirmBroadcastsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_media');
        $this->middleware('permission:law_firm.add_media', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_media', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_media', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_media', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_media', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_broadcasts =  $law_firm->law_firm_broadcasts();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_broadcasts =  $law_firm_broadcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_broadcasts =  $law_firm_broadcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_broadcasts = $law_firm_broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_broadcasts = $law_firm_broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_broadcasts = $law_firm_broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_broadcasts = $law_firm_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_broadcasts = $law_firm_broadcasts->get();
                return $law_firm_broadcasts;
            }
            $law_firm_broadcasts = $law_firm_broadcasts->get();
            return $law_firm_broadcasts;
        }
        $law_firm_broadcasts = $law_firm->law_firm_broadcasts()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_broadcasts;
    }


    /*********View All LawFirmBroadcasts  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_broadcasts = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_broadcasts.index', compact('law_firm_broadcasts', 'law_firm'));
    }

    /*********View Create Form of Broadcast  ***********/
    public function create(LawFirm $law_firm)
    {
        $tags = Tag::active()->get();
        return view('super_admins.law_firms.law_firm_broadcasts.create', compact('law_firm', 'tags'));
    }

    /*********Store Broadcast  ***********/
    public function store(CreateRequest $request, LawFirm $law_firm)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                $data['audio'] = uploadFile($request, 'file', 'law_firm_broadcasts');
            } else {
                $data['video'] = uploadFile($request, 'file', 'law_firm_broadcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','law_firm_broadcasts');
            $law_firm_broadcast = $law_firm->law_firm_broadcasts()->create($data);
            $law_firm_broadcast->slug = Str::slug($law_firm_broadcast->name . ' ' . $law_firm_broadcast->id, '-');
            $law_firm_broadcast->save();
            $law_firm_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_broadcasts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_broadcasts.index', $law_firm->id)->with('message', 'Broadcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Broadcast  ***********/
    public function show(LawFirm $law_firm, Broadcast $law_firm_broadcast)
    {
        if ($law_firm->id != $law_firm_broadcast->law_firm_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_broadcasts.show', compact('law_firm_broadcast', 'law_firm'));
    }

    /*********View Edit Form of Broadcast  ***********/
    public function edit(LawFirm $law_firm, Broadcast $law_firm_broadcast)
    {
        if ($law_firm->id != $law_firm_broadcast->law_firm_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_broadcasts.edit', compact('law_firm_broadcast', 'law_firm'));
    }

    /*********Update Broadcast  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Broadcast $law_firm_broadcast)
    {
        if ($law_firm->id != $law_firm_broadcast->law_firm_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                if ($request->file) {
                    $data['audio'] = uploadFile($request, 'file', 'law_firm_broadcasts');
                } else {
                    $data['audio'] = $law_firm_broadcast->audio;
                }
            } else {
                if ($request->file) {
                    $data['video'] = uploadFile($request, 'file', 'law_firm_broadcasts');
                } else {
                    $data['video'] = $law_firm_broadcast->video;
                }
            }
            $law_firm_broadcast->update($data);
            $law_firm_broadcast = Broadcast::find($law_firm_broadcast->id);
            $slug = Str::slug($law_firm_broadcast->name . ' ' . $law_firm_broadcast->id, '-');
            $law_firm_broadcast->update([
                'slug' => $slug
            ]);
            $law_firm_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_broadcasts.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_broadcasts.index', $law_firm->id)->with('message', 'Broadcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_broadcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_broadcasts." . $extension;
        return Excel::download(new LawFirmBroadcastsExport($law_firm_broadcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmBroadcastsImport, $file);
        return redirect()->back()->with('message', 'Broadcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Broadcast ***********/
    public function destroy(LawFirm $law_firm, Broadcast $law_firm_broadcast)
    {
        if ($law_firm->id != $law_firm_broadcast->law_firm_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $law_firm_broadcast->delete();
        return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Broadcast ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_broadcast)
    {
        $law_firm_broadcast = Broadcast::withTrashed()->find($law_firm_broadcast);
        if ($law_firm_broadcast) {
            if ($law_firm_broadcast->trashed()) {
                if ($law_firm_broadcast->image && file_exists(public_path($law_firm_broadcast->image))) {
                    unlink(public_path($law_firm_broadcast->image));
                }
                $law_firm_broadcast->forceDelete();
                return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Broadcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Broadcast***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_broadcast)
    {
        $law_firm_broadcast = Broadcast::withTrashed()->find($law_firm_broadcast);
        if ($law_firm_broadcast->trashed()) {
            $law_firm_broadcast->restore();
            return redirect()->back()->with('message', 'Broadcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
}
