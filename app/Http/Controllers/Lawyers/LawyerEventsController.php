<?php

namespace App\Http\Controllers\Lawyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\Lawyers\LawyerEvents\CreateRequest;
use App\Http\Resources\Web\EventsResource;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LawyerEventsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lawyer');
        // $this->middleware('permission:lawyer_events.index');
        // $this->middleware('permission:lawyer_events.create',['only' => ['store']]);
        // $this->middleware('permission:lawyer_events.update',['only' => ['update']]);
        // $this->middleware('permission:lawyer_events.delete',['only' => ['destroy']]);
        // $this->middleware('permission:lawyer_events.export',['only' => ['export']]);
        // $this->middleware('permission:lawyer_events.import',['only' => ['import']])
        // $this->middleware('permission:lawyer_events.update|lawyer_events.is_active',['only' => ['updateStatus']]);
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        $lawyer = auth()->user()->lawyer;
        if ($req != null) {
            $lawyer_events =  $lawyer->lawyer_events()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_events =  $lawyer_events->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_events =  $lawyer_events->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_events = $lawyer_events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_events = $lawyer_events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $lawyer_events = $lawyer_events->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $lawyer_events = $lawyer_events->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_events = $lawyer_events->get();
                return $lawyer_events;
            }
            $totalLawyerEvents = $lawyer_events->count();
            $lawyer_events = $lawyer_events->paginate($req->perPage);
            $lawyer_events = EventsResource::collection($lawyer_events)->response()->getData(true);

            return $lawyer_events;
        }
        $lawyer_events = EventsResource::collection($lawyer->lawyer_events()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $lawyer_events;
    }

    /********* FETCH ALL LawyerEvents ***********/
    public function index()
    {
        $lawyer_events =  $this->getter();
        $response = generateResponse($lawyer_events, count($lawyer_events['data']) > 0 ? true : false, 'LawyerEvents Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* FILTER LawyerEvents FOR Search ***********/
    public function filter(Request $request)
    {
        $lawyer_events = $this->getter($request);
        $response = generateResponse($lawyer_events, count($lawyer_events['data']) > 0 ? true : false, 'Filter LawyerEvents Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    /********* ADD NEW LawyerEvent ***********/
    public function store(CreateRequest $request)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        try {
            DB::beginTransaction();
            $request->merge(['created_by_user_id' => auth()->user()->id]);
            $data = $request->all();
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_events');
            $lawyer_event = $lawyer->lawyer_events()->create($data);
            $lawyer_event->slug = Str::slug($lawyer_event->name . ' ' . $lawyer_event->id, '-');
            $lawyer_event->save();
            $lawyer_event = $lawyer->lawyer_events()->withAll()->find($lawyer_event->id);
            foreach ($request->sponsers as $sponser) {
                $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                $lawyer_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $lawyer_event = new EventsResource($lawyer_event);
            $lawyer_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back()->withErrors(['line' => $e->getLine(), 'message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show($lawyer_event)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_event->lawyer_id != $lawyer->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_event = $lawyer->lawyer_events()->withAll()->find($lawyer_event);
        if ($lawyer_event) {
            $lawyer_event = new EventsResource($lawyer_event);
            $response = generateResponse($lawyer_event, true, 'LawyerEvent Fetched Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawyerEvent Not FOund', null, 'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerEvent ***********/
    public function update(CreateRequest $request, Event $lawyer_event)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_event->lawyer_id != $lawyer->id) {
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
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_events', $lawyer_event->image);
            } else {
                $data['image'] = $lawyer_event->image;
            }

            $lawyer_event->update($data);
            $lawyer_event = $lawyer_event->find($lawyer_event->id);
            $slug = Str::slug($lawyer_event['name'] . ' ' . $lawyer_event->id, '-');
            $lawyer_event->update(
                [
                    'slug' => $slug
                ]
            );
            $lawyer_event->sponsers()->delete();
            foreach ($request->sponsers as $sponser) {
                if (is_string($sponser['image'])) {
                    $image_url = $sponser['previous_image'];
                } else {
                    $image_url = uploadArrayFile($sponser, 'image', 'event_sponsers');
                }
                $lawyer_event->sponsers()->create([
                    'name' => $sponser['name'],
                    'image' => $image_url
                ]);
            }
            $lawyer_event->tags()->sync($request->tag_ids);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back()->withErrors(['line' => $e->getLine(), 'message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    /********* UPDATE LawyerEvent Status***********/
    public function updateStatus(Request $request, Event $lawyer_event)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_event->lawyer_id != $lawyer->id) {
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_event->update([
            'is_active' => $lawyer_event->is_active == 1 ? 0 : 1
        ]);
        $response = generateResponse(null, true, 'LawyerEvent Status Updated Successfully', null, 'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerEvent ***********/
    public function destroy(Request $request, Event $lawyer_event)
    {
        $lawyer = auth()->user()->lawyer;
        if ($lawyer_event->lawyer_id != $lawyer->id) {
            request()->session()->flash('alert', ['message' => 'Invalid Request', 'type' => 'error']);
            return redirect()->back();
        }
        if ($lawyer_event->trashed()) {
            request()->session()->flash('alert', ['message' => 'Already in Trash', 'type' => 'error']);
        } else {
            $lawyer_event->sponsers()->delete();
            $lawyer_event->delete();
        }
        return redirect()->back();
    }
    /*********Permanently DELETE LawyerEvent ***********/
    public function destroyPermanently(Request $request, $lawyer_event)
    {
        $lawyer = auth()->user()->lawyer;
        $lawyer_event = $lawyer->lawyer_events()->withTrashed()->find($lawyer_event);
        if ($lawyer_event) {
            if ($lawyer_event->lawyer_id != $lawyer->id) {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
            if ($lawyer_event->trashed()) {
                $lawyer_event->forceDelete();
                $response = generateResponse(null, true, 'LawyerEvent Deleted Successfully', null, 'object');
            } else {
                $response = generateResponse(null, false, 'LawyerEvent is not in trash to delete permanently', null, 'object');
            }
        } else {
            $response = generateResponse(null, false, 'LawyerEvent not found', null, 'object');
        }
        return response()->json($response, 200);
    }
    /********* Restore LawyerEvent ***********/
    public function restore(Request $request, $lawyer_event)
    {
        $lawyer = auth()->user()->lawyer;
        $lawyer_event = $lawyer->lawyer_events()->withTrashed()->find($lawyer_event);
        if ($lawyer_event->trashed()) {
            $lawyer_event->restore();
            $response = generateResponse(null, true, 'LawyerEvent Restored Successfully', null, 'object');
        } else {
            $response = generateResponse(null, false, 'LawyerEvent is not trashed', null, 'object');
        }
        return response()->json($response, 200);
    }
}
