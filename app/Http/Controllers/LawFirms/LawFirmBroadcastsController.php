<?php

namespace App\Http\Controllers\LawFirms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Http\Requests\LawFirms\LawFirmBroadcasts\CreateRequest;
use App\Http\Resources\Web\BroadcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmBroadcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('law_firm');
        // $this->middleware('permission:law_firm_broadcasts.index');
        // $this->middleware('permission:law_firm_broadcasts.create',['only' => ['store']]);
        // $this->middleware('permission:law_firm_broadcasts.update',['only' => ['update']]);
        // $this->middleware('permission:law_firm_broadcasts.delete',['only' => ['destroy']]);
        // $this->middleware('permission:law_firm_broadcasts.export',['only' => ['export']]);
        // $this->middleware('permission:law_firm_broadcasts.import',['only' => ['import']])
        // $this->middleware('permission:law_firm_broadcasts.update|law_firm_broadcasts.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $law_firm = auth()->user()->law_firm;
        if ($req != null) {
            $law_firm_broadcasts =  $law_firm->law_firm_broadcasts()->withAll();
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
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $law_firm_broadcasts = $law_firm_broadcasts->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $law_firm_broadcasts = $law_firm_broadcasts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_broadcasts = $law_firm_broadcasts->get();
                return $law_firm_broadcasts;
            }
            $totalLawFirmBroadcasts = $law_firm_broadcasts->count();
            $law_firm_broadcasts = $law_firm_broadcasts->paginate($req->perPage);
            $law_firm_broadcasts = BroadcastsResource::collection($law_firm_broadcasts)->response()->getData(true);

            return $law_firm_broadcasts;
        }
        $law_firm_broadcasts = BroadcastsResource::collection($law_firm->law_firm_broadcasts()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $law_firm_broadcasts;
    }

    /********* FETCH ALL LawFirmBroadcasts ***********/
    public function index()
    {
        $law_firm_broadcasts =  $this->getter();
        $response = generateResponse($law_firm_broadcasts, count($law_firm_broadcasts['data']) > 0 ? true : false, 'LawFirmBroadcasts Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER LawFirmBroadcasts FOR Search ***********/
    public function filter(Request $request)
    {
        $law_firm_broadcasts = $this->getter($request);
        $response = generateResponse($law_firm_broadcasts, count($law_firm_broadcasts['data']) > 0 ? true : false, 'Filter LawFirmBroadcasts Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW LawFirmBroadcast ***********/
    public function store(CreateRequest $request)
    {
        $law_firm = auth()->user()->law_firm;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_broadcasts');
            $data['audio'] = uploadFile($request, 'audio', 'law_firm_broadcasts');
            $data['video'] = uploadFile($request, 'video', 'law_firm_broadcasts');
            $law_firm_broadcast = $law_firm->law_firm_broadcasts()->create($data);
            $law_firm_broadcast->slug = Str::slug($law_firm_broadcast->name . ' ' . $law_firm_broadcast->id, '-');
            $law_firm_broadcast->save();
            $law_firm_broadcast->tags()->sync($request->tag_ids);
            $law_firm_broadcast = $law_firm->law_firm_broadcasts()->withAll()->find($law_firm_broadcast->id);
            $law_firm_broadcast = new BroadcastsResource($law_firm_broadcast);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($law_firm_broadcast)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_broadcast->law_firm_id != $law_firm->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_broadcast = $law_firm->law_firm_broadcasts()->withAll()->find($law_firm_broadcast);
        if ($law_firm_broadcast) {
            $law_firm_broadcast = new BroadcastsResource($law_firm_broadcast);
            $response = generateResponse($law_firm_broadcast, true, 'LawFirmBroadcast Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawFirmBroadcast Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmBroadcast ***********/
    public function update(CreateRequest $request, Broadcast $law_firm_broadcast)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_broadcast->law_firm_id != $law_firm->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        try {
            DB::beginTransaction();
            $request->merge(['last_updated_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_broadcasts', $law_firm_broadcast->image);
            } else {
                $data['image'] = $law_firm_broadcast->image;
            }

            if ($request->audio) {
                $data['audio'] = uploadFile($request, 'audio', 'law_firm_broadcasts');
            } else {
                $data['audio'] = $law_firm_broadcast->audio;
            }

            if ($request->video) {
                $data['video'] = uploadFile($request, 'video', 'law_firm_broadcasts');
            } else {
                $data['video'] = $law_firm_broadcast->video;
            }
            $law_firm_broadcast->update($data);
            $law_firm_broadcast = $law_firm_broadcast->find($law_firm_broadcast->id);
            $slug = Str::slug($law_firm_broadcast['name'] . ' ' . $law_firm_broadcast->id, '-');
            $law_firm_broadcast->update(
                [
                    'slug' => $slug
                ]
            );
            $law_firm_broadcast->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
        }
        return redirect()->back();
    }

    /********* UPDATE LawFirmBroadcast Status***********/
    public function updateStatus(Request $request, Broadcast $law_firm_broadcast)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_broadcast->law_firm_id != $law_firm->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_broadcast->update([
            'is_active' => $law_firm_broadcast->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'LawFirmBroadcast Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmBroadcast ***********/
    public function destroy(Request $request, Broadcast $law_firm_broadcast)
    {
        $law_firm = auth()->user()->law_firm;
        if ($law_firm_broadcast->law_firm_id != $law_firm->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($law_firm_broadcast->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $law_firm_broadcast->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE LawFirmBroadcast ***********/
    public function destroyPermanently(Request $request, $law_firm_broadcast)
    {
        $law_firm = auth()->user()->law_firm;
        $law_firm_broadcast = $law_firm->law_firm_broadcasts()->withTrashed()->find($law_firm_broadcast);
        if ($law_firm_broadcast) {
            if ($law_firm_broadcast->law_firm_id != $law_firm->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($law_firm_broadcast->trashed()) {
                $law_firm_broadcast->forceDelete();
                $response = generateResponse(null, true, 'LawFirmBroadcast Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'LawFirmBroadcast is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'LawFirmBroadcast not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore LawFirmBroadcast ***********/
    public function restore(Request $request, $law_firm_broadcast)
    {
        $law_firm = auth()->user()->law_firm;
        $law_firm_broadcast = $law_firm->law_firm_broadcasts()->withTrashed()->find($law_firm_broadcast);
        if ($law_firm_broadcast->trashed()) {
            $law_firm_broadcast->restore();
            $response = generateResponse(null, true, 'LawFirmBroadcast Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawFirmBroadcast is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
