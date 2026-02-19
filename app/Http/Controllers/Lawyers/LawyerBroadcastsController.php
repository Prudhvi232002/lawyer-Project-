<?php

namespace App\Http\Controllers\Lawyers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Http\Requests\Lawyers\LawyerBroadcasts\CreateRequest;
use App\Http\Resources\Web\BroadcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerBroadcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('lawyer');
      // $this->middleware('permission:lawyer_broadcasts.index');
      // $this->middleware('permission:lawyer_broadcasts.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_broadcasts.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_broadcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_broadcasts.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_broadcasts.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_broadcasts.update|lawyer_broadcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_broadcasts =  $lawyer->lawyer_broadcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_broadcasts =  $lawyer_broadcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_broadcasts =  $lawyer_broadcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_broadcasts = $lawyer_broadcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_broadcasts = $lawyer_broadcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_broadcasts = $lawyer_broadcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_broadcasts = $lawyer_broadcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_broadcasts = $lawyer_broadcasts->get();
        return $lawyer_broadcasts;
      }
      $totalLawyerBroadcasts = $lawyer_broadcasts->count();
      $lawyer_broadcasts = $lawyer_broadcasts->paginate($req->perPage);
      $lawyer_broadcasts = BroadcastsResource::collection($lawyer_broadcasts)->response()->getData(true);

      return $lawyer_broadcasts;
    }
    $lawyer_broadcasts = BroadcastsResource::collection($lawyer->lawyer_broadcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_broadcasts;
  }

  /********* FETCH ALL LawyerBroadcasts ***********/
    public function index()
    {
        $lawyer_broadcasts =  $this->getter();
        $response = generateResponse($lawyer_broadcasts,count($lawyer_broadcasts['data']) > 0 ? true:false,'LawyerBroadcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawyerBroadcasts FOR Search ***********/
   public function filter(Request $request){
     $lawyer_broadcasts = $this->getter($request);
     $response = generateResponse($lawyer_broadcasts,count($lawyer_broadcasts['data']) > 0 ? true:false,'Filter LawyerBroadcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawyerBroadcast ***********/
    public function store(CreateRequest $request)
    {
      $lawyer = auth()->user()->lawyer;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','lawyer_broadcasts');
      $data['audio'] = uploadFile($request,'audio','lawyer_broadcasts');
      $data['video'] = uploadFile($request,'video','lawyer_broadcasts');
      $lawyer_broadcast = $lawyer->lawyer_broadcasts()->create($data);
      $lawyer_broadcast->slug = Str::slug($lawyer_broadcast->name . ' ' . $lawyer_broadcast->id, '-');
      $lawyer_broadcast->save();
      $lawyer_broadcast->tags()->sync($request->tag_ids);
      $lawyer_broadcast = $lawyer->lawyer_broadcasts()->withAll()->find($lawyer_broadcast->id);
      $lawyer_broadcast = new BroadcastsResource($lawyer_broadcast);
      DB::commit();
    }
      catch (\Exception $e) {
        dd($e->getMessage());
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $lawyer_broadcast)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_broadcast->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_broadcast = $lawyer->lawyer_broadcasts()->withAll()->find($lawyer_broadcast);
        if($lawyer_broadcast){
          $lawyer_broadcast = new BroadcastsResource($lawyer_broadcast);
          $response = generateResponse($lawyer_broadcast,true,'LawyerBroadcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerBroadcast Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerBroadcast ***********/
    public function update(CreateRequest $request, Broadcast $lawyer_broadcast)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_broadcast->lawyer_id != $lawyer->id){
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
            $data['image'] = uploadCroppedFile($request,'image','lawyer_broadcasts',$lawyer_broadcast->image);
        } else {
            $data['image'] = $lawyer_broadcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','lawyer_broadcasts');
        } else {
            $data['audio'] = $lawyer_broadcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','lawyer_broadcasts');
        } else {
            $data['video'] = $lawyer_broadcast->video;
        }
        $lawyer_broadcast->update($data);
        $lawyer_broadcast = Broadcast::find($lawyer_broadcast->id);
        $slug = Str::slug($lawyer_broadcast->name . ' ' . $lawyer_broadcast->id, '-');
        $lawyer_broadcast->update([
            'slug' => $slug
        ]);
         $lawyer_broadcast->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawyerBroadcast Status***********/
    public function updateStatus(Request $request,Broadcast $lawyer_broadcast){
        $lawyer = auth()->user()->lawyer;
        if($lawyer_broadcast->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_broadcast->update([
          'is_active' => $lawyer_broadcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerBroadcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerBroadcast ***********/
    public function destroy(Request $request,Broadcast $lawyer_broadcast)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_broadcast->lawyer_id != $lawyer->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($lawyer_broadcast->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $lawyer_broadcast->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawyerBroadcast ***********/
    public function destroyPermanently(Request $request,$lawyer_broadcast)
    {
        $lawyer= auth()->user()->lawyer;
        $lawyer_broadcast = $lawyer->lawyer_broadcasts()->withTrashed()->find($lawyer_broadcast);
        if($lawyer_broadcast){
            if($lawyer_broadcast->lawyer_id != $lawyer->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($lawyer_broadcast->trashed()) {
            $lawyer_broadcast->forceDelete();
            $response = generateResponse(null,true,'LawyerBroadcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerBroadcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawyerBroadcast not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawyerBroadcast ***********/
    public function restore(Request $request,$lawyer_broadcast)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_broadcast = $lawyer->lawyer_broadcasts()->withTrashed()->find($lawyer_broadcast);
          if ($lawyer_broadcast->trashed()) {
            $lawyer_broadcast->restore();
            $response = generateResponse(null,true,'LawyerBroadcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerBroadcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
