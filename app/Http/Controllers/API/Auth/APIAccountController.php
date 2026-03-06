<?php

namespace App\Http\Controllers\API\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\UsersResource;
use App\Models\User;
use App\Http\Requests\API\Account\UpdateCustomerGeneralInfoRequest;
use App\Http\Requests\API\Account\UpdateLawyerGeneralInfoRequest;
use App\Http\Requests\API\Account\UpdateLawFirmGeneralInfoRequest;
use App\Models\Role;

class APIAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api','auth:api','verified','api_setting']);
        $this->middleware(['customer.api'])->only(['updateCustomerGeneralInformation']);
        $this->middleware(['lawyer.api'])->only(['updateLawyerGeneralInformation' , 'updateLawyerSettings']);
        $this->middleware(['lawfirm.api'])->only(['updateLawFirmGeneralInformation' , 'updateLawFirmSettings']);
    }

    public function updateCustomerGeneralInformation(UpdateCustomerGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $customer = $user->customer;
        if($customer){
            $customer->update($request->only(['first_name','last_name','user_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code']));
            if(!empty($request->image) && !is_null($request->image)){
                $image = uploadFile($request,'image','profile_images');
                $customer->update(['image' => $image]);
            }

            $user = User::withAll()->where('email', $user->email)->first();
            $user = new UsersResource($user);
            $response = generateResponse($user,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateLawyerGeneralInformation(UpdateLawyerGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $lawyer = $user->lawyer;
        if($lawyer){
            $lawyer->update($request->only(
                ['first_name',
                'last_name',
                'description',
                'country_id',
                'state_id',
                'city_id',
                'address_line_1',
                'address_line_2',
                'zip_code',
                'user_name',
                'speciality',
                'home_phone',
                'cell_phone',
                'job_title',
                'website',
                'company',
                'email',
                'work_country_id',
                'work_state_id',
                'work_city_id',
                'work_address_line_1',
                'work_address_line_2',
                'work_zip_code',
                'shipping_country_id',
                'shipping_state_id',
                'shipping_city_id',
                'shipping_address_line_1',
                'shipping_address_line_2',
                'shipping_zip_code',
                'billing_country_id',
                'billing_state_id',
                'billing_city_id',
                'billing_address_line_1',
                'billing_address_line_2',
                'billing_zip_code'
                ]));

                if(!empty($request->image) && !is_null($request->image)){
                    $image = uploadFile($request,'image','profile_images');
                    $lawyer->update(['image' => $image]);
                }
                if(!empty($request->cover_image) && !is_null($request->cover_image)){
                    $cover_image = uploadFile($request,'cover_image','profile_images');
                    $lawyer->update(['cover_image' => $cover_image]);
                }
            $lawyer->lawyer_categories()->sync($request->lawyer_categories);
            $lawyer->languages()->sync($request->languages);
            $lawyer->tags()->sync($request->tags);
            $user = User::withAll()->where('email', $user->email)->first();
            $user = new UsersResource($user);
            $response = generateResponse($user,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateLawyerSettings(Request $request){
        $user = Auth::user();
        $lawyer = $user->lawyer;
        foreach($request->settings as $setting){
            $lawyer->lawyer_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        $response = generateResponse(null,true,"Settings Updated Successfully",null,'collection');
        return response()->json($response);
    }

    public function updateLawFirmGeneralInformation(UpdateLawFirmGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $law_firm = $user->law_firm;
        if($law_firm){
            $law_firm->update($request->only(['law_firm_name','law_firm_website','first_name','last_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code','user_name']));
            $image = uploadCroppedFile($request,'image','profile_images');
            $law_firm->update(['image' => $image]);
            $law_firm->law_firm_categories()->sync($request->law_firm_categories);
            $response = generateResponse($law_firm,true,"Profile Updated Successfully",null,'collection');
        }else{
            $response = generateResponse(null,true,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function updateLawFirmSettings(Request $request){
        $user = Auth::user();
        $law_firm = $user->law_firm;
        foreach($request->settings as $setting){
            $law_firm->law_firm_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        $response = generateResponse(null,true,"Settings Updated Successfully",null,'collection');
        return response()->json($response);
    }

    public function becomeLawyer(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        $pricing_plan = getLawyerDefaultPricingPlan();

        if(!$user->hasRole(Role::$Lawyer)){
            $user->roles()->attach([Role::$Lawyer]);
            $user->lawyer()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,
                'pricing_plan_id' => $pricing_plan->id ?? null
            ]);
        }
        $response = generateResponse(null,true,"You are Now A Lawyer",null,'collection');
        return response()->json($response);
    }
    public function becomeUser(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        if(!$user->hasRole(Role::$Customer)){
            $user->roles()->attach([Role::$Customer]);
            $user->customer()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,

            ]);
        }
        $response = generateResponse(null,true,"You are Now A Cusomer",null,'collection');
        return response()->json($response);
    }
    public function becomeLawFirm(Request $request){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        $pricing_plan = getLawFirmDefaultPricingPlan();
        if(!$user->hasRole(Role::$LawFirm)){
            $user->roles()->attach([Role::$LawFirm]);
            $user->law_firm()->create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'description' => $data->description,
                'country_id' => $data->country_id,
                'state_id' => $data->state_id,
                'city_id' => $data->city_id,
                'address_line_1' => $data->address_line_1,
                'address_line_2' => $data->address_line_2,
                'zip_code' => $data->zip_code,
                'pricing_plan_id' => $pricing_plan->id ?? null
            ]);
        }
        $response = generateResponse(null,true,"You are Now A Law Firm User Also",null,'collection');
        return response()->json($response);
    }
}
