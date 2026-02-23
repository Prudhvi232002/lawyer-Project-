<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer'):null;
        $customer = $this->relationLoaded('customer') ? $this->whenLoaded('customer'):null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm'):null;


        $logged_in_as = $request->session()->get('logged_in_as');


        if($logged_in_as == 'lawyer' && $lawyer){
            if($lawyer->pricing_plan){
                $pricing_plan = $lawyer->pricing_plan;
                $lawyer_modules = $pricing_plan->lawyer_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $lawyer_modules = [];
            }
            $login_info = new LawyersResource($lawyer);
        }else if($logged_in_as == 'law_firm' && $law_firm){
            if($law_firm->pricing_plan){
                $pricing_plan = $law_firm->pricing_plan;
                $law_firm_modules = $pricing_plan->law_firm_modules()->pluck('pricing_plan_modules.module_code')->toArray();
            }else{
                $law_firm_modules = [];
            }
            $login_info = new LawFirmsResource($law_firm);
        }else if($logged_in_as == 'customer' && $customer){
            $login_info = new CustomersResource($customer);
        }
        else{
            $login_info = null;
        }
        return [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email,
                "is_active" => $this->is_active,
                "country_id" => $this->country_id,
                "email_verified_at" => $this->email_verified_at,
                "is_email_verified" => $this->hasVerifiedEmail(),
                "profile_image_path" => $this->profile_image_path,
                "password_last_changed" => $this->password_last_changed,
                "is_lawyer" => $this->hasRole('lawyer'),
                "is_customer" => $this->hasRole('customer'),
                "is_law_firm" => $this->hasRole('law_firm'),
                'lawyer_modules' => $lawyer_modules ?? [],
                'law_firm_modules' => $law_firm_modules ?? [],
                'login_info' => $login_info,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
                "deleted_at" =>  $this->deleted_at
        ];
    }
}
