<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\LawFirms\LawFirmEvents\CreateRequest;
use App\Http\Resources\Web\EventsResource;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class LawFirmEventsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');
      // $this->middleware('permission:law_firm_events.index');
      // $this->middleware('permission:law_firm_events.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_events.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_events.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_events.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_events.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_events.update|law_firm_events.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_events =  $law_firm->law_firm_events()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_events =  $law_firm_events->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_events =  $law_firm_events->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_events = $law_firm_events->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_events = $law_firm_events->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_events = $law_firm_events->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_events = $law_firm_events->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_events = $law_firm_events->get();
        return $law_firm_events;
      }
      $totalLawFirmEvents = $law_firm_events->count();
      $law_firm_events = $law_firm_events->paginate($req->perPage);
      $law_firm_events = EventsResource::collection($law_firm_events)->response()->getData(true);

      return $law_firm_events;
    }
    $law_firm_events = EventsResource::collection($law_firm->law_firm_events()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_events;
  }

  /********* FETCH ALL LawFirmEvents ***********/
    public function index()
    {
        $law_firm_events =  $this->getter();
        $response = generateResponse($law_firm_events,count($law_firm_events['data']) > 0 ? true:false,'LawFirmEvents Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmEvents FOR Search ***********/
   public function filter(Request $request){
     $law_firm_events = $this->getter($request);
     $response = generateResponse($law_firm_events,count($law_firm_events['data']) > 0 ? true:false,'Filter LawFirmEvents Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmEvent ***********/
    public function store(CreateRequest $request)
    {
      $law_firm = auth()->user()->law_firm;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','law_firm_events');
      $law_firm_event = $law_firm->law_firm_events()->create($data);
      $law_firm_event->slug = Str::slug($law_firm_event->name . ' ' . $law_firm_event->id, '-');
      $law_firm_event->save();
      $law_firm_event = $law_firm->law_firm_events()->withAll()->find($law_firm_event->id);
      foreach ($request->sponsers as $sponser) {
        $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
        $law_firm_event->sponsers()->create([
            'name' => $sponser['name'],
            'image' => $image_url
        ]);
      }
      $law_firm_event = new EventsResource($law_firm_event);
      $law_firm_event->tags()->sync($request->tag_ids);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
        return redirect()->back()->withErrors(['line' => $e->getLine(),'message' => $e->getMessage()]);
    }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_event)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_event->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_event = $law_firm->law_firm_events()->withAll()->find($law_firm_event);
        if($law_firm_event){
          $law_firm_event = new EventsResource($law_firm_event);
          $response = generateResponse($law_firm_event,true,'LawFirmEvent Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirmEvent Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmEvent ***********/
    public function update(CreateRequest $request, Event $law_firm_event)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_event->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','law_firm_events',$law_firm_event->image);
        } else {
            $data['image'] = $law_firm_event->image;
        }
        $law_firm_event->sponsers()->delete();
        foreach ($request->sponsers as $sponser) {
        if (is_string($sponser['image'])) {
            $image_url = $sponser['previous_image'];
        }else{
            $image_url = uploadArrayFile($sponser ,'image','event_sponsers');
        }
            $law_firm_event->sponsers()->create([
                'name' => $sponser['name'],
                'image' => $image_url
            ]);
          }
          $law_firm_event->update($data);
          $law_firm_event = $law_firm_event->find($law_firm_event->id);
          $slug = Str::slug($law_firm_event['name'] . ' ' . $law_firm_event->id, '-');
          $law_firm_event->update(
              [
                  'slug' => $slug
              ]
          );
        $law_firm_event->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
          return redirect()->back()->withErrors(['line' => $e->getLine(),'message' => $e->getMessage()]);
        }
       return redirect()->back();
    }

    /********* UPDATE LawFirmEvent Status***********/
    public function updateStatus(Request $request,Event $law_firm_event){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_event->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_event->update([
          'is_active' => $law_firm_event->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirmEvent Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmEvent ***********/
    public function destroy(Request $request,Event $law_firm_event)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_event->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_event->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $law_firm_event->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirmEvent ***********/
    public function destroyPermanently(Request $request,$law_firm_event)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_event = $law_firm->law_firm_events()->withTrashed()->find($law_firm_event);
        if($law_firm_event){
            if($law_firm_event->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_event->trashed()) {
            $law_firm_event->forceDelete();
            $response = generateResponse(null,true,'LawFirmEvent Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmEvent is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirmEvent not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirmEvent ***********/
    public function restore(Request $request,$law_firm_event)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_event = $law_firm->law_firm_events()->withTrashed()->find($law_firm_event);
          if ($law_firm_event->trashed()) {
            $law_firm_event->restore();
            $response = generateResponse(null,true,'LawFirmEvent Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmEvent is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
