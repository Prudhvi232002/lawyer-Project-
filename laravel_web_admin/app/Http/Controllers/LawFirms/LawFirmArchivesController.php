<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Http\Requests\LawFirms\LawFirmArchives\CreateRequest;
use App\Http\Resources\Web\ArchivesResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmArchivesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');
      // $this->middleware('permission:law_firm_archives.index');
      // $this->middleware('permission:law_firm_archives.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_archives.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_archives.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_archives.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_archives.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_archives.update|law_firm_archives.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_archives =  $law_firm->law_firm_archives()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_archives =  $law_firm_archives->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_archives =  $law_firm_archives->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_archives = $law_firm_archives->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_archives = $law_firm_archives->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_archives = $law_firm_archives->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_archives = $law_firm_archives->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_archives = $law_firm_archives->get();
        return $law_firm_archives;
      }
      $totalLawFirmArchives = $law_firm_archives->count();
      $law_firm_archives = $law_firm_archives->paginate($req->perPage);
      $law_firm_archives = ArchivesResource::collection($law_firm_archives)->response()->getData(true);

      return $law_firm_archives;
    }
    $law_firm_archives = ArchivesResource::collection($law_firm->law_firm_archives()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_archives;
  }

  /********* FETCH ALL LawFirmArchives ***********/
    public function index()
    {
        $law_firm_archives =  $this->getter();
        $response = generateResponse($law_firm_archives,count($law_firm_archives['data']) > 0 ? true:false,'LawFirmArchives Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmArchives FOR Search ***********/
   public function filter(Request $request){
     $law_firm_archives = $this->getter($request);
     $response = generateResponse($law_firm_archives,count($law_firm_archives['data']) > 0 ? true:false,'Filter LawFirmArchives Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmArchive ***********/
    public function store(CreateRequest $request)
    {
      $law_firm = auth()->user()->law_firm;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','law_firm_archives');
      $law_firm_archive = $law_firm->law_firm_archives()->create($data);
      $law_firm_archive->slug = Str::slug($law_firm_archive->name . ' ' . $law_firm_archive->id, '-');
      $law_firm_archive->tags()->sync($request->tag_ids);
      $law_firm_archive->save();
      $law_firm_archive = $law_firm->law_firm_archives()->withAll()->find($law_firm_archive->id);
      $law_firm_archive = new ArchivesResource($law_firm_archive);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_archive)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_archive->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_archive = $law_firm->law_firm_archives()->withAll()->find($law_firm_archive);
        if($law_firm_archive){
          $law_firm_archive = new ArchivesResource($law_firm_archive);
          $response = generateResponse($law_firm_archive,true,'LawFirmArchive Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirmArchive Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmArchive ***********/
    public function update(CreateRequest $request, Archive $law_firm_archive)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_archive->law_firm_id != $law_firm->id){
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
            $data['image'] = uploadCroppedFile($request,'image','law_firm_archives',$law_firm_archive->image);
        } else {
            $data['image'] = $law_firm_archive->image;
        }
        $data['slug'] = Str::slug($data['name'] . ' ' . $law_firm_archive->id, '-');
        $law_firm_archive->update($data);
        $law_firm_archive->tags()->sync($request->tag_ids);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawFirmArchive Status***********/
    public function updateStatus(Request $request,Archive $law_firm_archive){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_archive->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_archive->update([
          'is_active' => $law_firm_archive->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirmArchive Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmArchive ***********/
    public function destroy(Request $request,Archive $law_firm_archive)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_archive->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_archive->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $law_firm_archive->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirmArchive ***********/
    public function destroyPermanently(Request $request,$law_firm_archive)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_archive = $law_firm->law_firm_archives()->withTrashed()->find($law_firm_archive);
        if($law_firm_archive){
            if($law_firm_archive->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_archive->trashed()) {
            $law_firm_archive->forceDelete();
            $response = generateResponse(null,true,'LawFirmArchive Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmArchive is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirmArchive not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirmArchive ***********/
    public function restore(Request $request,$law_firm_archive)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_archive = $law_firm->law_firm_archives()->withTrashed()->find($law_firm_archive);
          if ($law_firm_archive->trashed()) {
            $law_firm_archive->restore();
            $response = generateResponse(null,true,'LawFirmArchive Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmArchive is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
