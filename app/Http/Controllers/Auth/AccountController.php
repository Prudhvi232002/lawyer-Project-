<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\APIGeneralController;
use App\Models\EventCategory;
use App\Models\PodcastCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateCustomerGeneralInfoRequest;
use App\Http\Requests\Account\UpdateLawyerGeneralInfoRequest;
use App\Http\Requests\Account\UpdateLawFirmGeneralInfoRequest;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Http\Resources\Web\ArchiveCategoriesResource;
use App\Http\Resources\Web\BlogCategoriesResource;
use App\Http\Resources\Web\LawFirmsResource;
use App\Http\Resources\Web\LawFirmMainCategoriesResource;
use App\Http\Resources\Web\CustomersResource;
use App\Http\Resources\Web\EventCategoriesResource;
use App\Http\Resources\Web\LawyerMainCategoriesResource;
use App\Http\Resources\Web\LawyersResource;
use App\Http\Resources\Web\PodcastCategoriesResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
use App\Http\Resources\Web\TagsResource;
use App\Models\AllLanguage;
use App\Models\AppointmentType;
use App\Models\ArchiveCategory;
use App\Models\BlogCategory;
use App\Models\LawFirm;
use App\Models\LawFirmCategory;
use App\Models\LawFirmMainCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Lawyer;
use App\Models\LawyerCategory;
use App\Models\LawyerMainCategory;
use App\Models\Role;
use App\Models\ServiceCategory;
use App\Models\State;
use App\Models\Tag;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function showAccountPage(Request $request){
        $user = Auth::user();
        if($request->session()->get('logged_in_as') == 'lawyer'){
            $lawyer = $user->lawyer;
            $lawyer = Lawyer::withChildrens()->withAll()->where('id',$lawyer->id)->first();
            $lawyer = new LawyersResource($lawyer);
            $lawyer_categories = LawyerMainCategory::active()->whereHas('categories',function($q){
                $q->active();
            })->withAll()->withChildrens()->get();
            $lawyer_categories = LawyerMainCategoriesResource::collection($lawyer_categories);
            // $lawyer_categories = LawyerCategory::active()->get();
            $blog_categories = BlogCategory::active()->get();
            $blog_categories = BlogCategoriesResource::collection($blog_categories);
            $event_categories = EventCategory::active()->get();
            $event_categories = EventCategoriesResource::collection($event_categories);
            $podcast_categories = PodcastCategory::active()->get();
            $podcast_categories = PodcastCategoriesResource::collection($podcast_categories);
            $service_categories = ServiceCategory::active()->get();
            $service_categories = ServiceCategoriesResource::collection($service_categories);
            $archive_categories = ArchiveCategory::active()->get();
            $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
            $tags = Tag::active()->get();
            $tags = TagsResource::collection($tags);
            $countries = Country::active()->get();
            $states = State::active()->where('country_id',$lawyer->country_id)->get();
            $cities = City::active()->where('state_id',$lawyer->state_id)->get();
            $appointment_types = AppointmentType::active()->get();
            $appointment_types = AppointmentTypesResource::collection($appointment_types);
            $billing_states = State::active()->where('country_id',$lawyer->billing_country_id)->get();
            $billing_cities = City::active()->where('state_id',$lawyer->billing_state_id)->get();
            $shipping_states = State::active()->where('country_id',$lawyer->shipping_country_id)->get();
            $shipping_cities = City::active()->where('state_id',$lawyer->shipping_state_id)->get();
            $work_states = State::active()->where('country_id',$lawyer->work_country_id)->get();
            $work_cities = City::active()->where('state_id',$lawyer->work_state_id)->get();
            $languages = AllLanguage::active()->get();
            $data = [
                'lawyer' => $lawyer,
                'lawyer_categories' => $lawyer_categories,
                'blog_categories' => $blog_categories,
                'event_categories' => $event_categories,
                'podcast_categories' => $podcast_categories,
                'service_categories' => $service_categories,
                'archive_categories' => $archive_categories,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
                'tags' => $tags,
                'billing_states' => $billing_states,
                'billing_cities' => $billing_cities,
                'shipping_states' => $shipping_states,
                'shipping_cities' => $shipping_cities,
                'work_states' => $work_states,
                'work_cities' => $work_cities,
                'languages' => $languages,
                'appointment_types' => $appointment_types
            ];
        }
        if($request->session()->get('logged_in_as') == 'law_firm'){
            $law_firm = $user->law_firm;
            $law_firm = LawFirm::withChildrens()->withAll()->where('id',$law_firm->id)->first();
            $law_firm = new LawFirmsResource($law_firm);
            $law_firm_categories = LawFirmMainCategory::active()->whereHas('categories',function($q){
                $q->active();
            })->withAll()->withChildrens()->get();
            $law_firm_categories = LawFirmMainCategoriesResource::collection($law_firm_categories);
            $blog_categories = BlogCategory::active()->get();
            $blog_categories = BlogCategoriesResource::collection($blog_categories);
            $event_categories = EventCategory::active()->get();
            $event_categories = EventCategoriesResource::collection($event_categories);
            $podcast_categories = PodcastCategory::active()->get();
            $service_categories = ServiceCategory::active()->get();
            $service_categories = ServiceCategoriesResource::collection($service_categories);
            $podcast_categories = PodcastCategoriesResource::collection($podcast_categories);
            $archive_categories = ArchiveCategory::active()->get();
            $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
            $tags = Tag::active()->get();
            $tags = TagsResource::collection($tags);
            $countries = Country::active()->get();
            $states = State::active()->where('country_id',$law_firm->country_id)->get();
            $cities = City::active()->where('state_id',$law_firm->state_id)->get();
            $billing_states = State::active()->where('country_id',$law_firm->billing_country_id)->get();
            $billing_cities = City::active()->where('state_id',$law_firm->billing_state_id)->get();
            $shipping_states = State::active()->where('country_id',$law_firm->shipping_country_id)->get();
            $shipping_cities = City::active()->where('state_id',$law_firm->shipping_state_id)->get();
            $work_states = State::active()->where('country_id',$law_firm->work_country_id)->get();
            $work_cities = City::active()->where('state_id',$law_firm->work_state_id)->get();
            $languages = AllLanguage::active()->get();
            $appointment_types = AppointmentType::active()->get();
            $appointment_types = AppointmentTypesResource::collection($appointment_types);
            $data = [
                'law_firm' => $law_firm,
                'law_firm_categories' => $law_firm_categories,
                'blog_categories' => $blog_categories,
                'event_categories' => $event_categories,
                'podcast_categories' => $podcast_categories,
                'service_categories' => $service_categories,
                'archive_categories' => $archive_categories,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
                'billing_states' => $billing_states,
                'billing_cities' => $billing_cities,
                'shipping_states' => $shipping_states,
                'shipping_cities' => $shipping_cities,
                'work_states' => $work_states,
                'work_cities' => $work_cities,
                'tags' => $tags,
                'languages' => $languages,
                'appointment_types' => $appointment_types
            ];
        }
        if($request->session()->get('logged_in_as') == 'customer'){
            $customer = $user->customer;
            $customer = Customer::withChildrens()->withAll()->where('id',$customer->id)->first();
            $customer = new CustomersResource($customer);
            $countries = Country::active()->get();
            $states = State::active()->where('country_id',$customer->country_id)->get();
            $cities = City::active()->where('state_id',$customer->state_id)->get();
            $data = [
                'customer' => $customer,
                'countries' => $countries,
                'states' => $states,
                'cities' => $cities,
            ];
        }

        return Inertia::render('Account',$data);
    }

    public function updateCustomerGeneralInformation(UpdateCustomerGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $customer = $user->customer;
        if($customer){
            $customer->update($request->only(['first_name','last_name','user_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$customer->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$customer->cover_images);
            $customer->update(['image' => $image]);
            $customer->update(['cover_image' => $cover_image]);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateLawyerGeneralInformation(UpdateLawyerGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $lawyer = $user->lawyer;
        if($lawyer){
            $lawyer->update($request->only(['first_name','last_name','description','country_id','state_id','city_id','experience','speciality','address_line_1','address_line_2','longitude','latitude','zip_code','user_name','is_energy_exchange','is_co_creation',
            'prefix','suffix','home_phone','cell_phone','job_title','company','website','email',
            'billing_address_line_1','billing_address_line_2','billing_country_id', 'billing_state_id', 'billing_city_id','billing_zip_code',
            'shipping_address_line_1','shipping_address_line_2','shipping_country_id', 'shipping_state_id', 'shipping_city_id','shipping_zip_code',
            'work_address_line_1','work_address_line_2','work_country_id', 'work_state_id', 'work_city_id','work_zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$lawyer->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$lawyer->cover_images);
            $lawyer->update(['image' => $image]);
            $lawyer->update(['cover_image' => $cover_image]);
            $lawyer->lawyer_categories()->sync($request->lawyer_categories);
            $lawyer->languages()->sync($request->languages);
            $lawyer->tags()->sync($request->tags);
        }
        // $this->updateUserProifleCompletion('healer');

        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateLawyerSettings(Request $request){
        $user = Auth::user();
        $lawyer = $user->lawyer;
        foreach($request->settings as $setting){
            $lawyer->lawyer_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Settings Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Settings Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateLawFirmGeneralInformation(UpdateLawFirmGeneralInfoRequest $request)
    {
        $user = auth()->user();
        $law_firm = $user->law_firm;
        if($law_firm){
            $law_firm->update($request->only(['law_firm_name','law_firm_website','first_name','last_name','description','country_id','state_id','city_id','address_line_1','address_line_2','zip_code','user_name','longitude','latitude','prefix','suffix','home_phone','cell_phone','job_title','company','website','email',
            'billing_address_line_1','billing_address_line_2','billing_country_id', 'billing_state_id', 'billing_city_id','billing_zip_code',
            'shipping_address_line_1','shipping_address_line_2','shipping_country_id', 'shipping_state_id', 'shipping_city_id','shipping_zip_code',
            'work_address_line_1','work_address_line_2','work_country_id', 'work_state_id', 'work_city_id','work_zip_code']));
            $image = uploadCroppedFile($request,'image','profile_images',$law_firm->image);
            $cover_image = uploadCroppedFile($request,'cover_image','cover_images',$law_firm->cover_image);

            $law_firm->update(['image' => $image]);
            $law_firm->update(['cover_image' => $cover_image]);

            $law_firm->law_firm_categories()->sync($request->law_firm_categories);
            $law_firm->languages()->sync($request->languages);
            $law_firm->tags()->sync($request->tags);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Profile Updated Successfully',
            'type' => 'success'
        ]);
    }

    public function updateLawFirmSettings(Request $request){
        $user = Auth::user();
        $law_firm = $user->law_firm;
        foreach($request->settings as $setting){
            $law_firm->law_firm_settings()->updateOrCreate(['name' => $setting['name']],$setting);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Settings Updated Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Settings Updated Successfully',
            'type' => 'success'
        ]);
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
        // $request->session()->put('logged_in_as', Role::$Lawyer);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$Lawyer),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A Lawyer Also',
        ]);
        return redirect()->back();
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
        // $request->session()->put('logged_in_as', Role::$Customer);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$Customer),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A Customer Also',
        ]);
        return redirect()->back();
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
        // $request->session()->put('logged_in_as', Role::$LawFirm);
        // request()->session()->flash('alert', [
        //     'type' => 'success',
        //     'message' => 'Successfully Switched To '.ucfirst(Role::$LawFirm),
        // ]);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Now, You Are A LawFirm User Also',
        ]);
        return redirect()->back();
    }
    public function switchRole(Request $request,$role){
        $user = Auth::user();
        $logged_in_as = $request->session()->get('logged_in_as');
        $data = $user->{$logged_in_as};
        if($user->hasRole($role)){
            if(isset($data)){
                $data->update(['is_online' => 0]);
            }
            if(isset($user->{$role})){
                $user->{$role}->update(['is_online' => 1]);
            }
            $request->session()->put('logged_in_as', $role);
        }
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Successfully Switched To '.ucfirst($role),
        ]);
        return redirect()->back();
    }

    public function getStates(Request $request){
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = APIGeneralController::getStates($request);
        $response = generateResponse($states,true,"States Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getCities(Request $request){
        $request->validate(['city_id' => 'exists:cities,id']);
        $cities = APIGeneralController::getCities($request);
        $response = generateResponse($cities,true,"Cities Fetched Successfully",null,'collection');
        return response()->json($response);
    }
}
