<?php

namespace App\Http\Controllers\Lawyers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Requests\Lawyers\LawyerPodcasts\CreateRequest;
use App\Http\Resources\Web\PodcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerPodcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('lawyer');
      // $this->middleware('permission:lawyer_podcasts.index');
      // $this->middleware('permission:lawyer_podcasts.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_podcasts.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_podcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_podcasts.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_podcasts.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_podcasts.update|lawyer_podcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_podcasts =  $lawyer->lawyer_podcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_podcasts =  $lawyer_podcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_podcasts =  $lawyer_podcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_podcasts = $lawyer_podcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_podcasts = $lawyer_podcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_podcasts = $lawyer_podcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_podcasts = $lawyer_podcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_podcasts = $lawyer_podcasts->get();
        return $lawyer_podcasts;
      }
      $totalLawyerPodcasts = $lawyer_podcasts->count();
      $lawyer_podcasts = $lawyer_podcasts->paginate($req->perPage);
      $lawyer_podcasts = PodcastsResource::collection($lawyer_podcasts)->response()->getData(true);

      return $lawyer_podcasts;
    }
    $lawyer_podcasts = PodcastsResource::collection($lawyer->lawyer_podcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_podcasts;
  }

  /********* FETCH ALL LawyerPodcasts ***********/
    public function index()
    {
        $lawyer_podcasts =  $this->getter();
        $response = generateResponse($lawyer_podcasts,count($lawyer_podcasts['data']) > 0 ? true:false,'LawyerPodcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawyerPodcasts FOR Search ***********/
   public function filter(Request $request){
     $lawyer_podcasts = $this->getter($request);
     $response = generateResponse($lawyer_podcasts,count($lawyer_podcasts['data']) > 0 ? true:false,'Filter LawyerPodcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawyerPodcast ***********/
    public function store(CreateRequest $request)
    {
      $lawyer = auth()->user()->lawyer;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','lawyer_podcasts');
      $data['audio'] = uploadFile($request,'audio','lawyer_podcasts');
      $data['video'] = uploadFile($request,'video','lawyer_podcasts');
      $lawyer_podcast = $lawyer->lawyer_podcasts()->create($data);
      $lawyer_podcast->slug = Str::slug($lawyer_podcast->name . ' ' . $lawyer_podcast->id, '-');
      $lawyer_podcast->save();
      $lawyer_podcast = $lawyer->lawyer_podcasts()->withAll()->find($lawyer_podcast->id);
      $lawyer_podcast = new PodcastsResource($lawyer_podcast);
      $lawyer_podcast->tags()->sync($request->tag_ids);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $lawyer_podcast)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_podcast->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_podcast = $lawyer->lawyer_podcasts()->withAll()->find($lawyer_podcast);
        if($lawyer_podcast){
          $lawyer_podcast = new PodcastsResource($lawyer_podcast);
          $response = generateResponse($lawyer_podcast,true,'LawyerPodcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerPodcast Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerPodcast ***********/
    public function update(CreateRequest $request, Podcast $lawyer_podcast)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_podcast->lawyer_id != $lawyer->id){
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
            $data['image'] = uploadCroppedFile($request,'image','lawyer_podcasts',$lawyer_podcast->image);
        } else {
            $data['image'] = $lawyer_podcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','lawyer_podcasts');
        } else {
            $data['audio'] = $lawyer_podcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','lawyer_podcasts');
        } else {
            $data['video'] = $lawyer_podcast->video;
        }
        $lawyer_podcast->update($data);
        $lawyer_podcast = $lawyer_podcast->find($lawyer_podcast->id);
        $slug = Str::slug($lawyer_podcast['name'] . ' ' . $lawyer_podcast->id, '-');
        $lawyer_podcast->update(
            [
                'slug' => $slug
            ]
        );
        $lawyer_podcast->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawyerPodcast Status***********/
    public function updateStatus(Request $request,Podcast $lawyer_podcast){
        $lawyer = auth()->user()->lawyer;
        if($lawyer_podcast->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_podcast->update([
          'is_active' => $lawyer_podcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerPodcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerPodcast ***********/
    public function destroy(Request $request,Podcast $lawyer_podcast)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_podcast->lawyer_id != $lawyer->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($lawyer_podcast->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $lawyer_podcast->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawyerPodcast ***********/
    public function destroyPermanently(Request $request,$lawyer_podcast)
    {
        $lawyer= auth()->user()->lawyer;
        $lawyer_podcast = $lawyer->lawyer_podcasts()->withTrashed()->find($lawyer_podcast);
        if($lawyer_podcast){
            if($lawyer_podcast->lawyer_id != $lawyer->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($lawyer_podcast->trashed()) {
            $lawyer_podcast->forceDelete();
            $response = generateResponse(null,true,'LawyerPodcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerPodcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawyerPodcast not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawyerPodcast ***********/
    public function restore(Request $request,$lawyer_podcast)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_podcast = $lawyer->lawyer_podcasts()->withTrashed()->find($lawyer_podcast);
          if ($lawyer_podcast->trashed()) {
            $lawyer_podcast->restore();
            $response = generateResponse(null,true,'LawyerPodcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerPodcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
