<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Requests\LawFirms\LawFirmCertifications\CreateRequest;
use App\Http\Resources\Web\CertificationsResource;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LawFirmCertificationsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');

      // $this->middleware('permission:law_firm_certifications.index');
      // $this->middleware('permission:law_firm_certifications.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_certifications.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_certifications.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_certifications.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_certifications.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_certifications.update|law_firm_certifications.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_certifications =  $law_firm->law_firm_certifications()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_certifications =  $law_firm_certifications->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_certifications =  $law_firm_certifications->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_certifications = $law_firm_certifications->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_certifications = $law_firm_certifications->whereLike(['name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_certifications = $law_firm_certifications->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_certifications = $law_firm_certifications->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_certifications = $law_firm_certifications->get();
        return $law_firm_certifications;
      }
      $totalLawFirmCertifications = $law_firm_certifications->count();
      $law_firm_certifications = $law_firm_certifications->paginate($req->perPage);
      $law_firm_certifications = CertificationsResource::collection($law_firm_certifications)->response()->getData(true);

      return $law_firm_certifications;
    }
    $law_firm_certifications = CertificationsResource::collection($law_firm->law_firm_certifications()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_certifications;
  }

  /********* FETCH ALL LawFirmCertifications ***********/
    public function index()
    {
        $law_firm_certifications =  $this->getter();
        $response = generateResponse($law_firm_certifications,count($law_firm_certifications['data']) > 0 ? true:false,'LawFirmCertifications Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmCertifications FOR Search ***********/
   public function filter(Request $request){
     $law_firm_certifications = $this->getter($request);
     $response = generateResponse($law_firm_certifications,count($law_firm_certifications['data']) > 0 ? true:false,'Filter LawFirmCertifications Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmCertification ***********/
    public function store(CreateRequest $request)
    {
      $law_firm = auth()->user()->law_firm;
      try{
      DB::beginTransaction();
      $request->merge(['created_by_user_id'=>auth()->user()->id]);
      $data = $request->all();
      $data['image'] = uploadCroppedFile($request,'image','law_firm_certifications');
      $law_firm_certification = $law_firm->law_firm_certifications()->create($data);
      $law_firm_certification = $law_firm->law_firm_certifications()->withAll()->find($law_firm_certification->id);
      $law_firm_certification = new CertificationsResource($law_firm_certification);
      DB::commit();
    }
      catch (\Exception $e) {
        DB::rollBack();
        request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_certification)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_certification->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_certification = $law_firm->law_firm_certifications()->withAll()->find($law_firm_certification);
        if($law_firm_certification){
          $law_firm_certification = new CertificationsResource($law_firm_certification);
          $response = generateResponse($law_firm_certification,true,'LawFirmCertification Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirmCertification Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirmCertification ***********/
    public function update(CreateRequest $request, Certification $law_firm_certification)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_certification->law_firm_id != $law_firm->id){
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
            $data['image'] = uploadCroppedFile($request,'image','law_firm_certifications',$law_firm_certification->image);
        } else {
            $data['image'] = $law_firm_certification->image;
        }
        $law_firm_certification->update($data);
        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawFirmCertification Status***********/
    public function updateStatus(Request $request,Certification $law_firm_certification){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_certification->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_certification->update([
          'is_active' => $law_firm_certification->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirmCertification Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirmCertification ***********/
    public function destroy(Request $request,Certification $law_firm_certification)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_certification->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_certification->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            $law_firm_certification->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirmCertification ***********/
    public function destroyPermanently(Request $request,$law_firm_certification)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_certification = $law_firm->law_firm_certifications()->withTrashed()->find($law_firm_certification);
        if($law_firm_certification){
            if($law_firm_certification->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_certification->trashed()) {
            $law_firm_certification->forceDelete();
            $response = generateResponse(null,true,'LawFirmCertification Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmCertification is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirmCertification not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirmCertification ***********/
    public function restore(Request $request,$law_firm_certification)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_certification = $law_firm->law_firm_certifications()->withTrashed()->find($law_firm_certification);
          if ($law_firm_certification->trashed()) {
            $law_firm_certification->restore();
            $response = generateResponse(null,true,'LawFirmCertification Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirmCertification is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
