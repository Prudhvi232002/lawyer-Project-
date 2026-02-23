<?php

namespace App\Http\Controllers\Lawyers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Http\Requests\Lawyers\LawyerArchives\CreateRequest;
use App\Http\Resources\Web\ArchivesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerArchivesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('lawyer');
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
      $totalLawyerArchives = $lawyer_archives->count();
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
      $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive->id);
      $lawyer_archive = new ArchivesResource($lawyer_archive);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $lawyer_archive)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_archive = $lawyer->lawyer_archives()->withAll()->find($lawyer_archive);
        if($lawyer_archive){
          $lawyer_archive = new ArchivesResource($lawyer_archive);
          $response = generateResponse($lawyer_archive,true,'LawyerArchive Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerArchive Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerArchive ***********/
    public function update(CreateRequest $request, Archive $lawyer_archive)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
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
            $data['image'] = uploadCroppedFile($request,'image','lawyer_archives',$lawyer_archive->image);
        } else {
            $data['image'] = $lawyer_archive->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $lawyer_archive->id, '-');
        $lawyer_archive->update($data);
        $lawyer_archive->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawyerArchive Status***********/
    public function updateStatus(Request $request,Archive $lawyer_archive){
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_archive->update([
          'is_active' => $lawyer_archive->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerArchive Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerArchive ***********/
    public function destroy(Request $request,Archive $lawyer_archive)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_archive->lawyer_id != $lawyer->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($lawyer_archive->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $lawyer_archive->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawyerArchive ***********/
    public function destroyPermanently(Request $request,$lawyer_archive)
    {
        $lawyer= auth()->user()->lawyer;
        $lawyer_archive = $lawyer->lawyer_archives()->withTrashed()->find($lawyer_archive);
        if($lawyer_archive){
            if($lawyer_archive->lawyer_id != $lawyer->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
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
