<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Http\Requests\LawFirms\LawFirmPodcasts\CreateRequest;
use App\Http\Resources\Web\PodcastsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmPodcastsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');
      // $this->middleware('permission:law_firm_podcasts.index');
      // $this->middleware('permission:law_firm_podcasts.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_podcasts.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_podcasts.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_podcasts.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_podcasts.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_podcasts.update|law_firm_podcasts.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_podcasts =  $law_firm->law_firm_podcasts()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_podcasts =  $law_firm_podcasts->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_podcasts =  $law_firm_podcasts->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_podcasts = $law_firm_podcasts->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_podcasts = $law_firm_podcasts->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_podcasts = $law_firm_podcasts->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_podcasts = $law_firm_podcasts->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_podcasts = $law_firm_podcasts->get();
        return $law_firm_podcasts;
      }
      $totalLawFirmPodcasts = $law_firm_podcasts->count();
      $law_firm_podcasts = $law_firm_podcasts->paginate($req->perPage);
      $law_firm_podcasts = PodcastsResource::collection($law_firm_podcasts)->response()->getData(true);

      return $law_firm_podcasts;
    }
    $law_firm_podcasts = PodcastsResource::collection($law_firm->law_firm_podcasts()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_podcasts;
  }

  /********* FETCH ALL LawFirmPodcasts ***********/
    public function index()
    {
        $law_firm_podcasts =  $this->getter();
        $response = generateResponse($law_firm_podcasts,count($law_firm_podcasts['data']) > 0 ? true:false,'LawFirmPodcasts Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmPodcasts FOR Search ***********/
   public function filter(Request $request){
     $law_firm_podcasts = $this->getter($request);
     $response = generateResponse($law_firm_podcasts,count($law_firm_podcasts['data']) > 0 ? true:false,'Filter LawFirmPodcasts Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmPodcast ***********/
    public function store(CreateRequest $request)
    {
      $law_firm = auth()->user()->law_firm;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','law_firm_podcasts');
      $data['audio'] = uploadFile($request,'audio','law_firm_podcasts');
      $data['video'] = uploadFile($request,'video','law_firm_podcasts');
      $law_firm_podcast = $law_firm->law_firm_podcasts()->create($data);
      $law_firm_podcast->slug = Str::slug($law_firm_podcast->name . ' ' . $law_firm_podcast->id, '-');
      $law_firm_podcast->save();
      $law_firm_podcast = $law_firm->law_firm_podcasts()->withAll()->find($law_firm_podcast->id);
      $law_firm_podcast = new PodcastsResource($law_firm_podcast);
      $law_firm_podcast->tags()->sync($request->tag_ids);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_podcast)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_podcast->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_podcast = $law_firm->law_firm_podcasts()->withAll()->find($law_firm_podcast);
        if($law_firm_podcast){
          $law_firm_podcast = new PodcastsResource($law_firm_podcast);
          $response = generateResponse($law_firm_podcast,true,'LawFirmPodcast Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirmPodcast Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmPodcast ***********/
    public function update(CreateRequest $request, Podcast $law_firm_podcast)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_podcast->law_firm_id != $law_firm->id){
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
            $data['image'] = uploadCroppedFile($request,'image','law_firm_podcasts',$law_firm_podcast->image);
        } else {
            $data['image'] = $law_firm_podcast->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','law_firm_podcasts');
        } else {
            $data['audio'] = $law_firm_podcast->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','law_firm_podcasts');
        } else {
            $data['video'] = $law_firm_podcast->video;
        }
        $law_firm_podcast->update($data);
        $law_firm_podcast = $law_firm_podcast->find($law_firm_podcast->id);
        $slug = Str::slug($law_firm_podcast['name'] . ' ' . $law_firm_podcast->id, '-');
        $law_firm_podcast->update(
            [
                'slug' => $slug
            ]
        );
        $law_firm_podcast->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
            dd($e->getMessage());
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawFirmPodcast Status***********/
    public function updateStatus(Request $request,Podcast $law_firm_podcast){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_podcast->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_podcast->update([
          'is_active' => $law_firm_podcast->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirmPodcast Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmPodcast ***********/
    public function destroy(Request $request,Podcast $law_firm_podcast)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_podcast->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_podcast->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $law_firm_podcast->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirmPodcast ***********/
    public function destroyPermanently(Request $request,$law_firm_podcast)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_podcast = $law_firm->law_firm_podcasts()->withTrashed()->find($law_firm_podcast);
        if($law_firm_podcast){
            if($law_firm_podcast->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_podcast->trashed()) {
            $law_firm_podcast->forceDelete();
            $response = generateResponse(null,true,'LawFirmPodcast Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmPodcast is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirmPodcast not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirmPodcast ***********/
    public function restore(Request $request,$law_firm_podcast)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_podcast = $law_firm->law_firm_podcasts()->withTrashed()->find($law_firm_podcast);
          if ($law_firm_podcast->trashed()) {
            $law_firm_podcast->restore();
            $response = generateResponse(null,true,'LawFirmPodcast Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmPodcast is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
