<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ModulesResource;
use App\Http\Resources\Web\PricingPlansResource;
use App\Models\Lawyer;
use App\Models\LawFirm;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class PricingPlansController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request,$type)
    {
        if ($request && $request != null) {
            $user = User::find($request->user_id);
            if ($user) {
                Auth::login($user);
                $user = Auth()->user();
                $request->session()->regenerate();
                $request->session()->put('logged_in_as', $type);
            }
        }
        if($type == 'lawyer'){
            $pricing_plans = PricingPlan::with('modules')->lawyer()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::lawyer()->orderBy('sort_order','asc')->get();
            $modules = ModulesResource::collection($modules);
        }
        else if($type == 'law_firm'){
            $pricing_plans = PricingPlan::with('modules')->lawFirm()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::lawFirm()->orderBy('sort_order','asc')->get();
            $modules = ModulesResource::collection($modules);
        }else{

        }

        return Inertia::render('PricingPlan/Listing',[
            'pricing_plans' => $pricing_plans,
            'modules' => $modules
        ]);
    }

    public function show(Request $request,$type,$slug)
    {
        $settings = generalSettings();
        $user = auth()->user();
        if(!$user){
            session([$type.'-'.'pricing-plan' => $slug]);
            return redirect()->route('register',['tab' => $type]);
        }
        $logged_in_as = $request->session()->get('logged_in_as');
        if($type == 'lawyer'){
            config(['cashier.model' => 'App\Models\Lawyer']);
            $lawyer = $user->lawyer;
            if($lawyer && $logged_in_as == 'lawyer'){
                $pricing_plan = PricingPlan::with('modules')->lawyer()->active()->where('slug',$slug)->first();
                if($pricing_plan->is_paid && $settings['stripe_key']){
                    $intent = $lawyer->createSetupIntent();
                }
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::lawyer()->orderBy('sort_order','asc')->get();
                $modules = ModulesResource::collection($modules);
            }else{
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Please Switch To Lawyer Profile For Lawyer Subscriptions',
                ]);
                return redirect()->back();
            }
        }
        else if($type == 'law_firm'){
            config(['cashier.model' => 'App\Models\LawFirm']);
            $law_firm = $user->law_firm;
            if($law_firm && $logged_in_as == 'law_firm'){
                $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid && $settings['stripe_key']){
                    $intent = $law_firm->createSetupIntent();
                }
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::lawFirm()->orderBy('sort_order','asc')->get();
                $modules = ModulesResource::collection($modules);
            }else{
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Please Switch To LawFirm Profile For LawFirm Subscriptions',
                ]);
                return redirect()->back();
            }
        }else{
            abort(404);
        }

        return Inertia::render('PricingPlan/Detail',[
            'pricing_plan' => $pricing_plan,
            'modules' => $modules,
            'intent' => $intent ?? null
        ]);
    }

    public function subscription(Request $request,$type,$slug)
    {
        $user = auth()->user();
        if(!$user){
            session([$type.'-'.'pricing-plan' => $slug]);
            return redirect()->route('register',['tab' => $type]);
        }
        $logged_in_as = $request->session()->get('logged_in_as');
        if($type == 'lawyer'){
            config(['cashier.model' => 'App\Models\Lawyer']);
            Cashier::useCustomerModel(Lawyer::class);
            $lawyer = $user->lawyer;
            if($lawyer && $logged_in_as == 'lawyer'){
                $pricing_plan = PricingPlan::with('modules')->lawyer()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid){
                    $subscription = $lawyer->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                    $lawyer->update(['pricing_plan_id' => $pricing_plan->id]);
                }else{
                    $lawyer->update(['pricing_plan_id' => $pricing_plan->id]);
                }
            }
        }
        if($type == 'law_firm'){
            config(['cashier.model' => 'App\Models\LawFirm']);
            Cashier::useCustomerModel(LawFirm::class);
            $law_firm = $user->law_firm;
            if($law_firm && $logged_in_as == 'law_firm'){
                $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug',$slug)->active()->first();
                if($pricing_plan->is_paid){
                    $subscription = $law_firm->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                    $law_firm->update(['pricing_plan_id' => $pricing_plan->id]);
                }else{
                    $law_firm->update(['pricing_plan_id' => $pricing_plan->id]);
                }
            }
        }
        request()->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Successfully Activated Subscription',
        ]);
        return redirect(route('pricing',['type' => $type]));
    }
}
