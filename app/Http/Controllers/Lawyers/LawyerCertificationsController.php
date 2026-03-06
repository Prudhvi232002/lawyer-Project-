<?php

namespace App\Http\Controllers\Lawyers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Requests\Lawyers\LawyerCertifications\CreateRequest;
use App\Http\Resources\Web\CertificationsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawyerCertificationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('lawyer');
      // $this->middleware('permission:lawyer_certifications.index');
      // $this->middleware('permission:lawyer_certifications.create',['only' => ['store']]);
      // $this->middleware('permission:lawyer_certifications.update',['only' => ['update']]);
      // $this->middleware('permission:lawyer_certifications.delete',['only' => ['destroy']]);
      // $this->middleware('permission:lawyer_certifications.export',['only' => ['export']]);
      // $this->middleware('permission:lawyer_certifications.import',['only' => ['import']])
      // $this->middleware('permission:lawyer_certifications.update|lawyer_certifications.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $lawyer = auth()->user()->lawyer;
    if($req != null){
      $lawyer_certifications =  $lawyer->lawyer_certifications()->withAll();
      if($req->trash && $req->trash == 'with'){
        $lawyer_certifications =  $lawyer_certifications->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $lawyer_certifications =  $lawyer_certifications->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $lawyer_certifications = $lawyer_certifications->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $lawyer_certifications = $lawyer_certifications->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $lawyer_certifications = $lawyer_certifications->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $lawyer_certifications = $lawyer_certifications->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $lawyer_certifications = $lawyer_certifications->get();
        return $lawyer_certifications;
      }
      $totalLawyerCertifications = $lawyer_certifications->count();
      $lawyer_certifications = $lawyer_certifications->paginate($req->perPage);
      $lawyer_certifications = CertificationsResource::collection($lawyer_certifications)->response()->getData(true);

      return $lawyer_certifications;
    }
    $lawyer_certifications = CertificationsResource::collection($lawyer->lawyer_certifications()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $lawyer_certifications;
  }

  /********* FETCH ALL LawyerCertifications ***********/
    public function index()
    {
        $lawyer_certifications =  $this->getter();
        $response = generateResponse($lawyer_certifications,count($lawyer_certifications['data']) > 0 ? true:false,'LawyerCertifications Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawyerCertifications FOR Search ***********/
   public function filter(Request $request){
     $lawyer_certifications = $this->getter($request);
     $response = generateResponse($lawyer_certifications,count($lawyer_certifications['data']) > 0 ? true:false,'Filter LawyerCertifications Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawyerCertification ***********/
    public function store(CreateRequest $request)
    {
      $lawyer = auth()->user()->lawyer;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadFile($request,'file','lawyer_certifications');
      $lawyer_certification = $lawyer->lawyer_certifications()->create($data);
      $lawyer_certification = $lawyer->lawyer_certifications()->withAll()->find($lawyer_certification->id);
      $lawyer_certification = new CertificationsResource($lawyer_certification);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $lawyer_certification)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_certification->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_certification = $lawyer->lawyer_certifications()->withAll()->find($lawyer_certification);
        if($lawyer_certification){
          $lawyer_certification = new CertificationsResource($lawyer_certification);
          $response = generateResponse($lawyer_certification,true,'LawyerCertification Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawyerCertification Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawyerCertification ***********/
    public function update(CreateRequest $request, Certification $lawyer_certification)
    {
        // dd($request->all());
        $lawyer = auth()->user()->lawyer;
        if($lawyer_certification->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
      try{
        DB::beginTransaction();
        $request->merge(['last_updated_by_user_id'=>auth()->user()->id]);
        $data = $request->all();
        if ($request->file) {
            $data['image'] = uploadFile($request,'file','lawyer_certifications',$lawyer_certification->image);
        } else {
            $data['image'] = $lawyer_certification->image;
        }
        $lawyer_certification->update($data);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawyerCertification Status***********/
    public function updateStatus(Request $request,Certification $lawyer_certification){
        $lawyer = auth()->user()->lawyer;
        if($lawyer_certification->lawyer_id != $lawyer->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $lawyer_certification->update([
          'is_active' => $lawyer_certification->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawyerCertification Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawyerCertification ***********/
    public function destroy(Request $request,Certification $lawyer_certification)
    {
        $lawyer = auth()->user()->lawyer;
        if($lawyer_certification->lawyer_id != $lawyer->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($lawyer_certification->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $lawyer_certification->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawyerCertification ***********/
    public function destroyPermanently(Request $request,$lawyer_certification)
    {
        $lawyer= auth()->user()->lawyer;
        $lawyer_certification = $lawyer->lawyer_certifications()->withTrashed()->find($lawyer_certification);
        if($lawyer_certification){
            if($lawyer_certification->lawyer_id != $lawyer->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($lawyer_certification->trashed()) {
            $lawyer_certification->forceDelete();
            $response = generateResponse(null,true,'LawyerCertification Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerCertification is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawyerCertification not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawyerCertification ***********/
    public function restore(Request $request,$lawyer_certification)
    {
      $lawyer= auth()->user()->lawyer;
      $lawyer_certification = $lawyer->lawyer_certifications()->withTrashed()->find($lawyer_certification);
          if ($lawyer_certification->trashed()) {
            $lawyer_certification->restore();
            $response = generateResponse(null,true,'LawyerCertification Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawyerCertification is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
