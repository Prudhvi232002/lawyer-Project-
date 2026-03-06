<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\LawFirms\LawFirmServices\CreateRequest;
use App\Http\Resources\Web\ServicesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmServicesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');
      // $this->middleware('permission:law_firm_services.index');
      // $this->middleware('permission:law_firm_services.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_services.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_services.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_services.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_services.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_services.update|law_firm_services.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_services =  $law_firm->law_firm_services()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_services =  $law_firm_services->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_services =  $law_firm_services->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_services = $law_firm_services->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_services = $law_firm_services->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_services = $law_firm_services->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_services = $law_firm_services->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_services = $law_firm_services->get();
        return $law_firm_services;
      }
      $totalLawFirmServices = $law_firm_services->count();
      $law_firm_services = $law_firm_services->paginate($req->perPage);
      $law_firm_services = ServicesResource::collection($law_firm_services)->response()->getData(true);

      return $law_firm_services;
    }
    $law_firm_services = ServicesResource::collection($law_firm->law_firm_services()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_services;
  }

  /********* FETCH ALL LawFirmServices ***********/
    public function index()
    {
        $law_firm_services =  $this->getter();
        $response = generateResponse($law_firm_services,count($law_firm_services['data']) > 0 ? true:false,'LawFirmServices Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmServices FOR Search ***********/
   public function filter(Request $request){
     $law_firm_services = $this->getter($request);
     $response = generateResponse($law_firm_services,count($law_firm_services['data']) > 0 ? true:false,'Filter LawFirmServices Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmService ***********/
    public function store(CreateRequest $request)
    {
        $settings = generalSettings();
      $law_firm = auth()->user()->law_firm;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','law_firm_services');
      $data['audio'] = uploadFile($request,'audio','law_firm_services');
      $data['video'] = uploadFile($request,'video','law_firm_services');
      $law_firm_service = $law_firm->law_firm_services()->create($data);
      $law_firm_service->slug = Str::slug($law_firm_service->name . ' ' . $law_firm_service->id, '-');
      if((int)$settings['auto_approve_law_firm_service']){
        $law_firm_service->is_approved = 1;
        $law_firm_service->approved_at = now();
      }
      $law_firm_service->save();
      $law_firm_service = $law_firm->law_firm_services()->withAll()->find($law_firm_service->id);
      $law_firm_service = new ServicesResource($law_firm_service);
      $law_firm_service->tags()->sync($request->tag_ids);
      if($request->faqs){
        $law_firm_service->faqs()->createMany($request->faqs);
      }
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_service)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_service->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_service = $law_firm->law_firm_services()->withAll()->find($law_firm_service);
        if($law_firm_service){
          $law_firm_service = new ServicesResource($law_firm_service);
          $response = generateResponse($law_firm_service,true,'LawFirmService Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirmService Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmService ***********/
    public function update(CreateRequest $request, Service $law_firm_service)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_service->law_firm_id != $law_firm->id){
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
            $data['image'] = uploadCroppedFile($request,'image','law_firm_services',$law_firm_service->image);
        } else {
            $data['image'] = $law_firm_service->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','law_firm_services');
        } else {
            $data['audio'] = $law_firm_service->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','law_firm_services');
        } else {
            $data['video'] = $law_firm_service->video;
        }
        $law_firm_service->update($data);
        $law_firm_service = $law_firm_service->find($law_firm_service->id);
        $slug = Str::slug($law_firm_service['name'] . ' ' . $law_firm_service->id, '-');
        $law_firm_service->update(
            [
                'slug' => $slug
            ]
        );
        $law_firm_service->tags()->sync($request->tag_ids);
        if($request->faqs){
            $law_firm_service->faqs()->delete();
            $law_firm_service->faqs()->createMany($request->faqs);
          }
        DB::commit();
      }
        catch (\Exception $e) {
            dd($e->getMessage());
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawFirmService Status***********/
    public function updateStatus(Request $request,Service $law_firm_service){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_service->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_service->update([
          'is_active' => $law_firm_service->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirmService Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmService ***********/
    public function destroy(Request $request,Service $law_firm_service)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_service->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_service->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $law_firm_service->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirmService ***********/
    public function destroyPermanently(Request $request,$law_firm_service)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_service = $law_firm->law_firm_services()->withTrashed()->find($law_firm_service);
        if($law_firm_service){
            if($law_firm_service->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_service->trashed()) {
            $law_firm_service->forceDelete();
            $response = generateResponse(null,true,'LawFirmService Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmService is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirmService not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirmService ***********/
    public function restore(Request $request,$law_firm_service)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_service = $law_firm->law_firm_services()->withTrashed()->find($law_firm_service);
          if ($law_firm_service->trashed()) {
            $law_firm_service->restore();
            $response = generateResponse(null,true,'LawFirmService Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmService is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
