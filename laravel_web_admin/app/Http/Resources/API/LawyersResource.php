<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class LawyersResource extends JsonResource
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
        $lawyer_settings = $this->relationLoaded('lawyer_settings') ? $this->whenLoaded('lawyer_settings') : null;
        $lawyer_categories = $this->relationLoaded('lawyer_categories') ? $this->whenLoaded('lawyer_categories') : null;
        $lawyer_reviews = $this->relationLoaded('lawyer_reviews') ? $this->whenLoaded('lawyer_reviews') : null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan') : null;
        $appointment_schedules = $this->relationLoaded('appointment_schedules') ? $this->whenLoaded('appointment_schedules') : null;

        if ($lawyer_reviews) {
            $rating = $lawyer_reviews->avg('rating');
            if (!$rating) {
                $rating = 0;
            } else {
                $rating = round($rating, 2);
            }
        } else {
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
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            'pricing_plan' => $pricing_plan,
            "is_active" => $this->is_active,
            "is_online" => $this->is_online,
            "is_featured" => $this->is_featured,
            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            "lawyer_settings" => isset($lawyer_settings) && count($lawyer_settings) > 0 ? LawyerSettingsResource::collection($this->whenLoaded('lawyer_settings', function () {
                return $this->lawyer_settings;
            }))->pluck('value', 'name')->toArray() : null,
            "lawyer_category_ids" => isset($lawyer_categories) && count($lawyer_categories) > 0 ? LawyerCategoriesResource::collection($this->whenLoaded('lawyer_categories', function () {
                return $this->lawyer_categories;
            }))->pluck('id')->toArray() : null,
            "appointment_types" =>  $appointment_schedules && count($appointment_schedules) > 0 ? AppointmentSchedulesResource::collection($appointment_schedules)->keyBy('appointment_type.type') : null,
            "lawyer_categories" => $lawyer_categories ? LawyerCategoriesResource::collection($lawyer_categories) : [],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
