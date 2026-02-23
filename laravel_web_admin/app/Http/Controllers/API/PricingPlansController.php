<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ModulesResource;
use App\Http\Resources\Web\PricingPlansResource;
use App\Models\Lawyer;
use App\Models\LawFirm;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use Laravel\Cashier\Cashier;

class PricingPlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $type)
    {
        if ($type == 'lawyer') {
            $pricing_plans = PricingPlan::with('modules')->lawyer()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::lawyer()->orderBy('sort_order', 'asc')->get();
            $modules = ModulesResource::collection($modules);
        } else if ($type == 'law_firm') {
            $pricing_plans = PricingPlan::with('modules')->lawFirm()->active()->get();
            $pricing_plans = PricingPlansResource::collection($pricing_plans);
            $modules = PricingPlanModule::lawFirm()->orderBy('sort_order', 'asc')->get();
            $modules = ModulesResource::collection($modules);
        } else {
            $response = generateResponse(null, true, "User type noy exists", null, 'collection');
            return response()->json($response);
        }
        $data = [
            'pricing_plans' => $pricing_plans,
            'all_modules' => $modules
        ];
        $response = generateResponse($data, true, "Pricing Plans fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function show(Request $request, $type, $slug)
    {
        $settings = generalSettings();
        $user = auth()->user();
        if ($type == 'lawyer') {
            $pricing_plan = PricingPlan::with('modules')->lawyer()->active()->where('slug', $slug)->first();
            if ($pricing_plan) {
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::lawyer()->orderBy('sort_order', 'asc')->get();
                $modules = ModulesResource::collection($modules);
            } else {
                $response = generateResponse(null, true, "Pricing Plans not found", null, 'collection');
                return response()->json($response);
            }
        } else if ($type == 'law_firm') {
            $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug', $slug)->active()->first();
            if ($pricing_plan) {
                $pricing_plan = new PricingPlansResource($pricing_plan);
                $modules = PricingPlanModule::lawyer()->orderBy('sort_order', 'asc')->get();
                $modules = ModulesResource::collection($modules);
            } else {
                $response = generateResponse(null, true, "Pricing Plans not found", null, 'collection');
                return response()->json($response);
            }
        }
        $data = [
            'pricing_plan' => $pricing_plan,
            'all_modules' => $modules,
        ];
        $response = generateResponse($data, true, "Pricing Plans detail fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function subscription(Request $request, $type, $slug)
    {
        $user = auth()->user();
        if ($type == 'lawyer') {
            config(['cashier.model' => 'App\Models\Lawyer']);
            Cashier::useCustomerModel(Lawyer::class);
            $lawyer = $user->lawyer;
            $pricing_plan = PricingPlan::with('modules')->lawyer()->where('slug', $slug)->active()->first();
            if ($pricing_plan->is_paid) {
                $subscription = $lawyer->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                $lawyer->update(['pricing_plan_id' => $pricing_plan->id]);
            } else {
                $lawyer->update(['pricing_plan_id' => $pricing_plan->id]);
            }
        }
        if ($type == 'law_firm') {
            config(['cashier.model' => 'App\Models\LawFirm']);
            Cashier::useCustomerModel(LawFirm::class);
            $law_firm = $user->law_firm;
            $pricing_plan = PricingPlan::with('modules')->lawFirm()->where('slug', $slug)->active()->first();
            if ($pricing_plan->is_paid) {
                $subscription = $law_firm->newSubscription($pricing_plan->slug, $pricing_plan->stripe_plan)->create($request->token);
                $law_firm->update(['pricing_plan_id' => $pricing_plan->id]);
            } else {
                $law_firm->update(['pricing_plan_id' => $pricing_plan->id]);
            }
        }
        $response = generateResponse(null, true, "Successfully Activated Subscription", null, 'collection');
        return response()->json($response);
    }
}
