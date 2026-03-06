<?php

namespace App\Http\Controllers\LawFirms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\User;
use App\Http\Requests\LawFirms\LawFirmLawyers\CreateRequest;
use App\Http\Requests\LawFirms\LawFirmLawyers\UpdateRequest;
use App\Http\Resources\Web\LawyersResource;
use App\Notifications\Auth\LawyerCredentialsNotification;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LawFirmLawyersController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('law_firm');

      // $this->middleware('permission:law_firm_lawyers.index');
      // $this->middleware('permission:law_firm_lawyers.create',['only' => ['store']]);
      // $this->middleware('permission:law_firm_lawyers.update',['only' => ['update']]);
      // $this->middleware('permission:law_firm_lawyers.delete',['only' => ['destroy']]);
      // $this->middleware('permission:law_firm_lawyers.export',['only' => ['export']]);
      // $this->middleware('permission:law_firm_lawyers.import',['only' => ['import']])
      // $this->middleware('permission:law_firm_lawyers.update|law_firm_lawyers.is_active',['only' => ['updateStatus']]);
  }

  /********* Getter For Pagination, Searching And Sorting  ***********/
  public function getter($req = null,$export = null)
  {
    $law_firm = auth()->user()->law_firm;
    if($req != null){
      $law_firm_lawyers =  $law_firm->law_firm_lawyers()->withAll();
      if($req->trash && $req->trash == 'with'){
        $law_firm_lawyers =  $law_firm_lawyers->withTrashed();
      }
      if($req->trash && $req->trash == 'only'){
        $law_firm_lawyers =  $law_firm_lawyers->onlyTrashed();
      }
      if($req->column && $req->column != null && $req->search != null){
          $law_firm_lawyers = $law_firm_lawyers->whereLike($req->column,$req->search);
        }
       else if($req->search && $req->search != null){

            $law_firm_lawyers = $law_firm_lawyers->whereLike(['first_name','description'],$req->search);
        }
      if($req->sort && $req->sort['field'] != null && $req->sort['type'] != null){
          $law_firm_lawyers = $law_firm_lawyers->OrderBy($req->sort['field'],$req->sort['type']);
      }
      else
      {
        $law_firm_lawyers = $law_firm_lawyers->OrderBy('id','desc');
      }
      if($export != null){ // for export do not paginate
        $law_firm_lawyers = $law_firm_lawyers->get();
        return $law_firm_lawyers;
      }
      $totalLawFirmLawyers = $law_firm_lawyers->count();
      $law_firm_lawyers = $law_firm_lawyers->paginate($req->perPage);
      $law_firm_lawyers = LawyersResource::collection($law_firm_lawyers)->response()->getData(true);

      return $law_firm_lawyers;
    }
    $law_firm_lawyers = LawyersResource::collection($law_firm->law_firm_lawyers()->withAll()->orderBy('id','desc')->paginate(10))->response()->getData(true);
    return $law_firm_lawyers;
  }

  /********* FETCH ALL LawFirmLawyers ***********/
    public function index()
    {
        $law_firm_lawyers =  $this->getter();
        $response = generateResponse($law_firm_lawyers,count($law_firm_lawyers['data']) > 0 ? true:false,'LawFirm Lawyers Fetched Successfully',null,'collection');
        return response()->json($response, 200);
    }

  /********* FILTER LawFirmLawyers FOR Search ***********/
   public function filter(Request $request){
     $law_firm_lawyers = $this->getter($request);
     $response = generateResponse($law_firm_lawyers,count($law_firm_lawyers['data']) > 0 ? true:false,'Filter LawFirm Lawyers Successfully',null,'collection');
     return response()->json($response, 200);
   }

    /********* ADD NEW LawFirmLawyer ***********/
    public function store(CreateRequest $request)
    {
      $law_firm = auth()->user()->law_firm;
      try{
    //   DB::beginTransaction();
      $data = $request->all();
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['password'] = Hash::make($request->password);
        $data['email'] = $request->email;
        $user = User::create($data);

        $user->roles()->attach(['lawyer']);
        $pricing_plan = getLawyerDefaultPricingPlan();
        if ($request->image) {
            $data['image'] = uploadCroppedFile($request,'image','law_firm_lawyers');
        }

        $lawyer = $user->lawyer()->create([
            'pricing_plan_id' => $pricing_plan->id ?? null,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'is_active' => $request['is_active'],
            'experience' => $request['experience'],
            'speciality' => $request['speciality'],
            'law_firm_id' => $law_firm->id,
            'user_name' => $request->user_name,
            'image' =>$data['image'] ?? null,
            'zip_code' => $data['zip_code'] ?? null
        ]);
        $lawyer->lawyer_categories()->attach($request->lawyer_categories);
        $user->sendEmailVerificationNotification();
        $user->notify(new LawyerCredentialsNotification($user,$request->password));
      $law_firm_lawyer = $law_firm->law_firm_lawyers()->withAll()->find($law_firm->id);
      $law_firm_lawyer = new LawyersResource($law_firm_lawyer);
    //   DB::commit();
    }
      catch (\Exception $e) {
        // DB::rollBack();
        // request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
     }
      return redirect()->back();
    }

    /********* View RECORD TO EDIT Or Display ***********/
    public function show( $law_firm_lawyer)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_lawyer->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_lawyer = $law_firm->law_firm_lawyers()->withAll()->find($law_firm_lawyer);
        if($law_firm_lawyer){
          $law_firm_lawyer = new LawyersResource($law_firm_lawyer);
          $response = generateResponse($law_firm_lawyer,true,'LawFirm Lawyer Fetched Successfully',null,'object');
        }
        else{
          $response = generateResponse(null,false,'LawFirm Lawyer Not FOund',null,'object');
        }
        return response()->json($response, 200);
    }

    /********* UPDATE LawFirm Lawyer ***********/
    public function update(UpdateRequest $request, Lawyer $law_firm_lawyer)
    {
        // dd($request->all());
        $law_firm = auth()->user()->law_firm;
        if($law_firm_lawyer->law_firm_id != $law_firm->id){
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
            $data['image'] = uploadCroppedFile($request,'image','law_firm_lawyers',$law_firm_lawyer->image);
        } else {
            $data['image'] = $law_firm_lawyer->image;
        }
        $law_firm_lawyer->update($data);
        $law_firm_lawyer->lawyer_categories()->sync($request->lawyer_categories);

        DB::commit();
      }
        catch (\Exception $e) {
          DB::rollBack();
          request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
       }
       return redirect()->back();
    }

    /********* UPDATE LawFirm Lawyer Status***********/
    public function updateStatus(Request $request, Lawyer $law_firm_lawyer){
        $law_firm = auth()->user()->law_firm;
        if($law_firm_lawyer->law_firm_id != $law_firm->id){
            return redirect()->back()->withErrors([
                'message' => 'Invalid Request',
                'type' => 'error'
            ]);
        }
        $law_firm_lawyer->update([
          'is_active' => $law_firm_lawyer->is_active == 1 ? 0:1
        ]);
        $response = generateResponse(null,true,'LawFirm Lawyer Status Updated Successfully',null,'object');
        return response()->json($response, 200);
    }


    /********* DELETE LawFirm Lawyer ***********/
    public function destroy(Request $request,Lawyer $law_firm_lawyer)
    {
        $law_firm = auth()->user()->law_firm;
        if($law_firm_lawyer->law_firm_id != $law_firm->id){
            request()->session()->flash('alert',['message' => 'Invalid Request','type' => 'error']);
            return redirect()->back();
        }
          if($law_firm_lawyer->trashed()) {
            request()->session()->flash('alert',['message' => 'Already in Trash','type' => 'error']);
          }
          else{
            // dd($law_firm_lawyer->lawyer_categories());
            User::find($law_firm_lawyer->user_id)->delete();

            $law_firm_lawyer->lawyer_categories()->sync([]);
            $law_firm_lawyer->delete();
          }
          return redirect()->back();
    }
    /*********Permanently DELETE LawFirm Lawyer ***********/
    public function destroyPermanently(Request $request,$law_firm_lawyer)
    {
        $law_firm= auth()->user()->law_firm;
        $law_firm_lawyer = $law_firm->law_firm_lawyers()->withTrashed()->find($law_firm_lawyer);
        if($law_firm_lawyer){
            if($law_firm_lawyer->law_firm_id != $law_firm->id){
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Request',
                    'type' => 'error'
                ]);
            }
          if ($law_firm_lawyer->trashed()) {
            $law_firm_lawyer->forceDelete();
            $response = generateResponse(null,true,'LawFirm Lawyer Deleted Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirm Lawyer is not in trash to delete permanently',null,'object');
          }
        }
        else{
          $response = generateResponse(null,false,'LawFirm Lawyer not found',null,'object');
        }
          return response()->json($response, 200);
    }
    /********* Restore LawFirm Lawyer ***********/
    public function restore(Request $request,$law_firm_lawyer)
    {
      $law_firm= auth()->user()->law_firm;
      $law_firm_lawyer = $law_firm->law_firm_lawyers()->withTrashed()->find($law_firm_lawyer);
          if ($law_firm_lawyer->trashed()) {
            $law_firm_lawyer->restore();
            $response = generateResponse(null,true,'LawFirm Lawyer Restored Successfully',null,'object');
          }
          else{
            $response = generateResponse(null,false,'LawFirm Lawyer is not trashed',null,'object');
          }
          return response()->json($response, 200);
    }
}
