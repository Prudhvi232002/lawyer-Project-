<?php

namespace App\Http\Controllers\API\Lawyers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Http\Requests\API\Lawyers\LawyerArchives\CreateRequest;
use App\Http\Resources\API\ArchivesResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerArchivesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware('lawyer.api');
      // $this->middleware('permission:lawyer_archives.index');
      // $this->middleware('permission:lawyer_archives.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_archives.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_archives.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_archives.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_archives.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_archives.update|lawyer_archives.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_archives =  $lawyer->lawyer_archives()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_archives =  $lawyer_archives->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_archives =  $lawyer_archives->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_archives = $lawyer_archives->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_archives = $lawyer_archives->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_archives = $lawyer_archives->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_archives = $lawyer_archives->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_archives = $lawyer_archives->get();
        return $lawyer_archives;
      }
      $totalLawyerCertifications = $lawyer_archives->count();
      $lawyer_archives = $lawyer_archives->paginate($req->perPage);
      $lawyer_archives = ArchivesResource::collection($lawyer_archives)->response()->getData(true);

      return $lawyer_archives;
    }
    $lawyer_archives = ArchivesResource::collection($lawyer->lawyer_archives()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_archives;
  }

  /********* FETCH ALL LawyerArchives ***********/
    public function index()
    {
        $lawyer_archives =  $this->getter();
        $response = generateResponse($lawyer_archives,count($lawyer_archives['data']) > 0 ? true:false,'LawyerArchives Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawyerArchives FOR Search ***********/
   public function filter(Request $request){
     $lawyer_archives = $this->getter($request);
     $response = generateResponse($lawyer_archives,count($lawyer_archives['data']) > 0 ? true:false,'Filter LawyerArchives Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawyerArchive ***********/
    public function store(CreateRequest $request)
    {
      $lawyer = auth()->user()->lawyer;
      try{
        DB::beginTransaction();
        $request->merge(['created_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        $data['image'] = uploadCroppedFile($request,'image','lawyer_archives');
        $lawyer_archive = $lawyer->lawyer_archives()->create($data);
        $lawyer_archive->slug = Str::slug($lawyer_archive->name . ' ' . $lawyer_archive->id, '-');
        $lawyer_archive->tags()->sync($request->tag_ids);
        $lawyer_archive->save();
        DB::commit();
        $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive->id);
        $lawyer_archive = new ArchivesResource($lawyer_archive);
      $response = generateResponse($lawyer_archive,true ,'LawyerArchives Created Successfully',null,'collection');
      return response()->json($response, 200);
    }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show(Archive $lawyer_archive)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive->id);
        if($lawyer_archive){
          $lawyer_archive = new ArchivesResource($lawyer_archive);
          $response = generateResponse($lawyer_archive,true,'LawyerArchive Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerArchive Not Found',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerArchive ***********/
    public function update(CreateRequest $request, Archive $lawyer_archive)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','lawyer_archives',$lawyer_archive->image);
        } else {
            $data['image'] = $lawyer_archive->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $lawyer_archive->id, '-');
        $lawyer_archive->update($data);
        $lawyer_archive->tags()->sync($request->tag_ids);
        DB::commit();
        $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive->id);
        $lawyer_archive = new ArchivesResource($lawyer_archive);
        $response = generateResponse($lawyer_archive,true,'LawyerArchive Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
        catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }

    /********* UPDATE LawyerArchive Status***********/
    public function updateStatus(Request $request,Archive $lawyer_archive){
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
        $lawyer_archive->update([
          'is_active' => $lawyer_archive->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerArchive Status Updated Successfully',null,'object');
        return response()->json($response, 200);
      }
      catch (\Exception $e) {
        DB::rollBack();
        $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
        return response()->json($response, 200);
     }
    }


    /********* DELETE LawyerArchive ***********/
    public function destroy(Request $request,Archive $lawyer_archive)
    {
      try{
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
          $response = generateResponse(null,false ,'Not Found',null,'collection');
          return response()->json($response, 404);
        }
          if($lawyer_archive->trashed()) {
            $response = generateResponse(null,false ,'Already in Trash',null,'collection');
            return response()->json($response, 404);
          }
          else{
            $lawyer_archive->delete();
          }
          $response = generateResponse(null,true,'LawyerArchive Deleted Successfully',null,'object');
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /*********Permanently DELETE LawyerArchive ***********/
    public function destroyPermanently(Request $request,$lawyer_archive)
    {
      try{
        $lawyer= auth()->user()->lawyer;
        $lawyer_archive = $lawyer->lawyer_archives()->withTrashed()->find($lawyer_archive);
        if($lawyer_archive){
            if($lawyer_archive->lawyer_id != $lawyer->id){
              $response = generateResponse(null,false ,'Not Found',null,'collection');
              return response()->json($response, 404);
            }
          if ($lawyer_archive->trashed()) {
            $lawyer_archive->forceDelete();
            $response = generateResponse(null,true,'LawyerArchive Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerArchive is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawyerArchive not found',null,'object');
        }
          return response()->json($response, 200);

        } catch (\Exception $e) {
          DB::rollBack();
          $response = generateResponse(null,false ,$e->getMessage(),null,'collection');
          return response()->json($response, 200);
       }
    }
    /********* Restore LawyerArchive ***********/
    public function restore(Request $request,$lawyer_archive)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_archive = $lawyer->lawyer_archives()->withTrashed()->find($lawyer_archive);
          if ($lawyer_archive->trashed()) {
            $lawyer_archive->restore();
            $response = generateResponse(null,true,'LawyerArchive Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerArchive is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
