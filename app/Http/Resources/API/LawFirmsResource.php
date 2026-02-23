<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class LawFirmsResource extends JsonResource
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
        $law_firm_settings = $this->relationLoaded('law_firm_settings') ? $this->whenLoaded('law_firm_settings'):null;
        $law_firm_categories = $this->relationLoaded('law_firm_categories') ? $this->whenLoaded('law_firm_categories'):null;
        $law_firm_lawyers = $this->relationLoaded('law_firm_lawyers') ? $this->whenLoaded('law_firm_lawyers') : null;
        $law_firm_reviews = $this->relationLoaded('law_firm_reviews') ? $this->whenLoaded('law_firm_reviews'):null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan'):null;
        $appointments = $this->relationLoaded('appointments') ? $this->whenLoaded('appointments'):null;

        if($law_firm_reviews){
            $rating = $law_firm_reviews->avg('rating');
            if(!$rating){
                $rating = 0;
            }else{
                $rating = round($rating,2);
            }
        }else{
            $rating = 0;
        }
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->city_id,
            "name" => $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "law_firm_name" => $this->law_firm_name,
            "law_firm_website" => $this->law_firm_website,
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            "is_active" => $this->is_active,
            "is_featured" => $this->is_featured,
            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            'pricing_plan' => $pricing_plan,

            "booked_appointments" => isset($appointments) && count($appointments) ? count($appointments) : 0,
            "law_firm_modules" => $pricing_plan ? $pricing_plan->law_firm_modules()->pluck('pricing_plan_modules.module_code')->toArray():[],
            "law_firm_settings" => isset($law_firm_settings) && count($law_firm_settings) > 0 ? LawFirmSettingsResource::collection($this->whenLoaded('law_firm_settings',function(){
                    return $this->law_firm_settings;
            }))->pluck('value','name')->toArray(): null,
            "law_firm_category_ids" => isset($law_firm_categories) && count($law_firm_categories) > 0 ? LawFirmCategoriesResource::collection($this->whenLoaded('law_firm_categories',function(){
                return $this->law_firm_categories;
            }))->pluck('id')->toArray():null,
            "law_firm_lawyers" => $law_firm_lawyers ? LawyersResource::collection($law_firm_lawyers) : [],
            "law_firm_categories" => $law_firm_categories ? LawFirmCategoriesResource::collection($law_firm_categories):[],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
