<?php

namespace App\Http\Controllers\API\Lawyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\API\Lawyers\LawyerServices\CreateRequest;
use App\Http\Resources\API\ServicesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerServicesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('lawyer.api');
      // $this->middleware('permission:lawyer_services.index');
      // $this->middleware('permission:lawyer_services.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_services.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_services.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_services.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_services.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_services.update|lawyer_services.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_services =  $lawyer->lawyer_services()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_services =  $lawyer_services->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_services =  $lawyer_services->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_services = $lawyer_services->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_services = $lawyer_services->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_services = $lawyer_services->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_services = $lawyer_services->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_services = $lawyer_services->get();
        return $lawyer_services;
      }
      $lawyer_services = $lawyer_services->paginate($req->perPage);
      $lawyer_services = ServicesResource::collection($lawyer_services)->response()->getData(true);

      return $lawyer_services;
    }
    $lawyer_services = ServicesResource::collection($lawyer->lawyer_services()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_services;
  }

  /********* FETCH ALL LawyerServices ***********/
    public function index()
    {
        $lawyer_services =  $this->getter();
        $response = generateResponse($lawyer_services,count($lawyer_services['data']) > 0 ? true:false,'LawyerServices Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawyerServices FOR Search ***********/
   public function filter(Request $request){
     $lawyer_services = $this->getter($request);
     $response = generateResponse($lawyer_services,count($lawyer_services['data']) > 0 ? true:false,'Filter LawyerServices Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawyerService ***********/
    public function store(CreateRequest $request)
    {
        $settings = generalSettings();
      $lawyer = auth()->user()->lawyer;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'image','lawyer_services');
        $data['audio'] = uploadFile($request,'audio','lawyer_services');
        $data['video'] = uploadFile($request,'video','lawyer_services');
        $lawyer_service = $lawyer->lawyer_services()->create($data);
        $lawyer_service->slug = Str::slug($lawyer_service->name . ' ' . $lawyer_service->id, '-');
        if($settings['auto_approve_lawyer_service'] == 1){
            $lawyer_service->is_approved = 1;
            $lawyer_service->approved_at = now();
          }
        $lawyer_service->save();
        $lawyer_service->tags()->sync($request->tag_ids);
        DB::commit();
        $lawyer_service = $lawyer->lawyer_services()->withAll()->find($lawyer_service->id);
        $lawyer_service = new ServicesResource($lawyer_service);
      $response = generateResponse($lawyer_service,true ,'LawyerServices Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Service $lawyer_service)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_service->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_service = $lawyer->lawyer_services()->withAll()->find($lawyer_service->id);
        if($lawyer_service){
          $lawyer_service = new ServicesResource($lawyer_service);
          $response = generateResponse($lawyer_service,true,'LawyerService Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerService Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerService ***********/
    public function update(CreateRequest $request, Service $lawyer_service)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_service->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadFile($request,'image','lawyer_services',$lawyer_service->image);
        } else {
            $data['image'] = $lawyer_service->image;
        }

        if ($request->audio) {
            $data['audio'] = uploadFile($request,'audio','lawyer_services');
        } else {
            $data['audio'] = $lawyer_service->audio;
        }

        if ($request->video) {
            $data['video'] = uploadFile($request,'video','lawyer_services');
        } else {
            $data['video'] = $lawyer_service->video;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $lawyer_service->id, '-');

        $lawyer_service->update($data);
        $lawyer_service->tags()->sync($request->tag_ids);
        DB::commit();
        $lawyer_service = $lawyer->lawyer_services()->withAll()->find($lawyer_service->id);
        $lawyer_service = new ServicesResource($lawyer_service);
        $response = generateResponse($lawyer_service,true,'LawyerService Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE LawyerService Status***********/
    public function updateStatus(Request $request,Service $lawyer_service){
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_service->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_service->update([
          'is_active' => $lawyer_service->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerService Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE LawyerService ***********/
    public function destroy(Request $request,Service $lawyer_service)
    {
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_service->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($lawyer_service->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $lawyer_service->delete();
          }
          $response = generateResponse(null,true,'LawyerService Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE LawyerService ***********/
    public function destroyPermanently(Request $request,$lawyer_service)
    {
      try{
        $lawyer= auth()->user()->lawyer;
        $lawyer_service = $lawyer->lawyer_services()->withTrashed()->find($lawyer_service);
        if($lawyer_service){
            if($lawyer_service->lawyer_id != $lawyer->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($lawyer_service->trashed()) {
            $lawyer_service->forceDelete();
            $response = generateResponse(null,true,'LawyerService Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerService is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawyerService not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore LawyerService ***********/
    public function restore(Request $request,$lawyer_service)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_service = $lawyer->lawyer_services()->withTrashed()->find($lawyer_service);
          if ($lawyer_service->trashed()) {
            $lawyer_service->restore();
            $response = generateResponse(null,true,'LawyerService Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerService is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
