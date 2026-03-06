<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerBroadcastsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerBroadcasts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerBroadcastsImport;
use App\Models\Broadcast;
use App\Models\Lawyer;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class LawyerBroadcastsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_media');
        $this->middleware('permission:lawyer.add_media', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_media', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_media', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_media', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_media', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_broadcasts =  $lawyer->lawyer_broadcasts();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_broadcasts =  $lawyer_broadcasts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_broadcasts =  $lawyer_broadcasts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_broadcasts = $lawyer_broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_broadcasts = $lawyer_broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_broadcasts = $lawyer_broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_broadcasts = $lawyer_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_broadcasts = $lawyer_broadcasts->get();
                return $lawyer_broadcasts;
            }
            $lawyer_broadcasts = $lawyer_broadcasts->get();
            return $lawyer_broadcasts;
        }
        $lawyer_broadcasts = $lawyer->lawyer_broadcasts()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_broadcasts;
    }


    /*********View All LawyerBroadcasts  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_broadcasts = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_broadcasts.index', compact('lawyer_broadcasts', 'lawyer'));
    }

    /*********View Create Form of Broadcast  ***********/
    public function create(Lawyer $lawyer)
    {
        $tags = Tag::active()->get();
        return view('super_admins.lawyers.lawyer_broadcasts.create', compact('lawyer', 'tags'));
    }

    /*********Store Broadcast  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->link_type == 'internal' && $request->file_type == 'audio') {
                $data['audio'] = uploadFile($request, 'file', 'lawyer_broadcasts');
            } else {
                $data['video'] = uploadFile($request, 'file', 'lawyer_broadcasts');
            }
            //$data['image'] = uploadCroppedFile($request,'image','lawyer_broadcasts');
            $lawyer_broadcast = $lawyer->lawyer_broadcasts()->create($data);
            $lawyer_broadcast->slug = Str::slug($lawyer_broadcast->name . ' ' . $lawyer_broadcast->id, '-');
            $lawyer_broadcast->save();
            $lawyer_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_broadcasts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_broadcasts.index', $lawyer->id)->with('message', 'Broadcast Created Successfully')->with('message_type', 'success');
    }

    /*********View Broadcast  ***********/
    public function show(Lawyer $lawyer, Broadcast $lawyer_broadcast)
    {
        if ($lawyer->id != $lawyer_broadcast->lawyer_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_broadcasts.show', compact('lawyer_broadcast', 'lawyer'));
    }

    /*********View Edit Form of Broadcast  ***********/
    public function edit(Lawyer $lawyer, Broadcast $lawyer_broadcast)
    {
        if ($lawyer->id != $lawyer_broadcast->lawyer_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_broadcasts.edit', compact('lawyer_broadcast', 'lawyer'));
    }

    /*********Update Broadcast  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Broadcast $lawyer_broadcast)
    {
        if ($lawyer->id != $lawyer_broadcast->lawyer_id) {
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
                    $data['audio'] = uploadFile($request, 'file', 'lawyer_broadcasts');
                } else {
                    $data['audio'] = $lawyer_broadcast->audio;
                }
            } else {
                if ($request->file) {
                    $data['video'] = uploadFile($request, 'file', 'lawyer_broadcasts');
                } else {
                    $data['video'] = $lawyer_broadcast->video;
                }
            }
            $lawyer_broadcast->update($data);
            $lawyer_broadcast = Broadcast::find($lawyer_broadcast->id);
            $slug = Str::slug($lawyer_broadcast->name . ' ' . $lawyer_broadcast->id, '-');
            $lawyer_broadcast->update([
                'slug' => $slug
            ]);
            $lawyer_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_broadcasts.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_broadcasts.index', $lawyer->id)->with('message', 'Broadcast Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_broadcasts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_broadcasts." . $extension;
        return Excel::download(new LawyerBroadcastsExport($lawyer_broadcasts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerBroadcastsImport, $file);
        return redirect()->back()->with('message', 'Broadcast Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Broadcast ***********/
    public function destroy(Lawyer $lawyer, Broadcast $lawyer_broadcast)
    {
        if ($lawyer->id != $lawyer_broadcast->lawyer_id) {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
        $lawyer_broadcast->delete();
        return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Broadcast ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_broadcast)
    {
        $lawyer_broadcast = Broadcast::withTrashed()->find($lawyer_broadcast);
        if ($lawyer_broadcast) {
            if ($lawyer_broadcast->trashed()) {
                if ($lawyer_broadcast->image && file_exists(public_path($lawyer_broadcast->image))) {
                    unlink(public_path($lawyer_broadcast->image));
                }
                $lawyer_broadcast->forceDelete();
                return redirect()->back()->with('message', 'Broadcast Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Broadcast is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Broadcast***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_broadcast)
    {
        $lawyer_broadcast = Broadcast::withTrashed()->find($lawyer_broadcast);
        if ($lawyer_broadcast->trashed()) {
            $lawyer_broadcast->restore();
            return redirect()->back()->with('message', 'Broadcast Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Broadcast Not Found')->with('message_type', 'error');
        }
    }
}
