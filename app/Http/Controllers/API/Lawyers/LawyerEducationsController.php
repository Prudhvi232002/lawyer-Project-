<?php

namespace App\Http\Controllers\API\Lawyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LawyerEducation;
use App\Http\Requests\API\Lawyers\LawyerEducations\CreateRequest;
use App\Http\Requests\API\Lawyers\LawyerEducations\UpdateRequest;
use App\Http\Resources\API\LawyerEducationsResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerEducationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('lawyer.api');
      // $this->middleware('permission:lawyer_educations.index');
      // $this->middleware('permission:lawyer_educations.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_educations.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_educations.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_educations.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_educations.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_educations.update|lawyer_educations.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_educations =  $lawyer->lawyer_educations()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_educations =  $lawyer_educations->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_educations =  $lawyer_educations->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_educations = $lawyer_educations->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_educations = $lawyer_educations->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_educations = $lawyer_educations->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_educations = $lawyer_educations->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_educations = $lawyer_educations->get();
        return $lawyer_educations;
      }
      $totalLawyerCertifications = $lawyer_educations->count();
      $lawyer_educations = $lawyer_educations->paginate($req->perPage);
      $lawyer_educations = LawyerEducationsResource::collection($lawyer_educations)->response()->getData(true);

      return $lawyer_educations;
    }
    $lawyer_educations = LawyerEducationsResource::collection($lawyer->lawyer_educations()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_educations;
  }

  /********* FETCH ALL Lawyer Educations ***********/
    public function index()
    {
        $lawyer_educations =  $this->getter();
        $response = generateResponse($lawyer_educations,count($lawyer_educations['data']) > 0 ? true:false,'Lawyer Educations Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER Lawyer Educations FOR Search ***********/
   public function filter(Request $request){
     $lawyer_educations = $this->getter($request);
     $response = generateResponse($lawyer_educations,count($lawyer_educations['data']) > 0 ? true:false,'Filter Lawyer Educations Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW Lawyer Experience ***********/
    public function store(CreateRequest $request)
    {
      $lawyer = auth()->user()->lawyer;
      try{
        DB::beginTransaction();
        $request->merge(['lawyer_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadFile($request,'file','lawyer_educations');
        $lawyer_education = $lawyer->lawyer_educations()->create($data);
        DB::commit();
        $lawyer_education = $lawyer->lawyer_educations()->withAll()->find($lawyer_education->id);
        $lawyer_education = new LawyerEducationsResource($lawyer_education);
      $response = generateResponse($lawyer_education,true ,'Lawyer Educations Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(LawyerEducation $lawyer_education)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_education->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_education = $lawyer->lawyer_educations()->withAll()->find($lawyer_education->id);
        if($lawyer_education){
          $lawyer_education = new LawyerEducationsResource($lawyer_education);
          $response = generateResponse($lawyer_education,true,'Lawyer Experience Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'Lawyer Experience Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE Lawyer Experience ***********/
    public function update(UpdateRequest $request, LawyerEducation $lawyer_education)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_education->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->file) {
            $data['image'] = uploadFile($request,'file','lawyer_educations',$lawyer_education->image);
        } else {
            $data['image'] = $lawyer_education->image;
        }
        $lawyer_education->update($data);
        DB::commit();
        $lawyer_education = $lawyer->lawyer_educations()->withAll()->find($lawyer_education->id);
        $lawyer_education = new LawyerEducationsResource($lawyer_education);
        $response = generateResponse($lawyer_education,true,'Lawyer Experience Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE Lawyer Experience Status***********/
    public function updateStatus(Request $request,LawyerEducation $lawyer_education){
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_education->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_education->update([
          'is_active' => $lawyer_education->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'Lawyer Experience Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE Lawyer Experience ***********/
    public function destroy(Request $request,LawyerEducation $lawyer_education)
    {
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_education->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($lawyer_education->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $lawyer_education->delete();
          }
          $response = generateResponse(null,true,'Lawyer Experience Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE Lawyer Experience ***********/
    public function destroyPermanently(Request $request,$lawyer_education)
    {
      try{
        $lawyer= auth()->user()->lawyer;
        $lawyer_education = $lawyer->lawyer_educations()->withTrashed()->find($lawyer_education);
        if($lawyer_education){
            if($lawyer_education->lawyer_id != $lawyer->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($lawyer_education->trashed()) {
            $lawyer_education->forceDelete();
            $response = generateResponse(null,true,'Lawyer Experience Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Lawyer Experience is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'Lawyer Experience not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore Lawyer Experience ***********/
    public function restore(Request $request,$lawyer_education)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_education = $lawyer->lawyer_educations()->withTrashed()->find($lawyer_education);
          if ($lawyer_education->trashed()) {
            $lawyer_education->restore();
            $response = generateResponse(null,true,'Lawyer Experience Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'Lawyer Experience is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
