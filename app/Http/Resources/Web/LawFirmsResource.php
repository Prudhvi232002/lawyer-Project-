<?php

namespace App\Http\Resources\Web;

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
        $law_firm_settings = $this->relationLoaded('law_firm_settings') ? $this->whenLoaded('law_firm_settings') : null;
        $law_firm_categories = $this->relationLoaded('law_firm_categories') ? $this->whenLoaded('law_firm_categories') : null;
        $languages = $this->relationLoaded('languages') ? $this->whenLoaded('languages') : null;
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags') : null;
        $law_firm_lawyers = $this->relationLoaded('law_firm_lawyers') ? $this->whenLoaded('law_firm_lawyers') : null;
        $law_firm_certifications = $this->relationLoaded('law_firm_certifications') ? $this->whenLoaded('law_firm_certifications') : null;
        $law_firm_broadcasts = $this->relationLoaded('law_firm_broadcasts') ? $this->whenLoaded('law_firm_broadcasts') : null;
        $law_firm_podcasts = $this->relationLoaded('law_firm_podcasts') ? $this->whenLoaded('law_firm_podcasts') : null;
        $law_firm_services = $this->relationLoaded('law_firm_services') ? $this->whenLoaded('law_firm_services') : null;
        $law_firm_events = $this->relationLoaded('law_firm_events') ? $this->whenLoaded('law_firm_events') : null;
        $appointment_schedules = $this->relationLoaded('appointment_schedules') ? $this->whenLoaded('appointment_schedules') : null;
        $law_firm_posts = $this->relationLoaded('law_firm_posts') ? $this->whenLoaded('law_firm_posts') : null;
        $law_firm_archives = $this->relationLoaded('law_firm_archives') ? $this->whenLoaded('law_firm_archives') : null;
        $law_firm_reviews = $this->relationLoaded('law_firm_reviews') ? $this->whenLoaded('law_firm_reviews') : null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan') : null;
        $country = $this->relationLoaded('country') ? $this->whenLoaded('country') : null;
        $state = $this->relationLoaded('state') ? $this->whenLoaded('state') : null;
        $city = $this->relationLoaded('city') ? $this->whenLoaded('city') : null;
        $appointments = $this->relationLoaded('appointments') ? $this->whenLoaded('appointments'):null;
        if ($law_firm_reviews) {
            $rating = $law_firm_reviews->avg('rating');
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
            "country_name" => $country ? $country->name : "",
            "state_id" => $this->state_id,
            "state_name" => $state ? $state->name : "",
            "city_id" => $this->city_id,
            "city_name" => $city ? $city->name : "",
            "distance" => $this->distance,

            "name" => $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "law_firm_name" => $this->law_firm_name,
            "law_firm_website" => $this->law_firm_website,
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            "is_active" => $this->is_active,
            "is_featured" => $this->is_featured,

            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'home_phone' => $this->home_phone,
            'cell_phone' => $this->cell_phone,
            'job_title' => $this->job_title,
            'company' => $this->company,
            'website' => $this->website,
            'email' => $this->email,

            'billing_address_line_1' => $this->billing_address_line_1,
            'billing_address_line_2' => $this->billing_address_line_2,
            'billing_country_id' => $this->billing_country_id,
            'billing_state_id' => $this->billing_state_id,
            'billing_city_id' => $this->billing_city_id,
            'billing_zip_code' => $this->billing_zip_code,

            'shipping_address_line_1' => $this->shipping_address_line_1,
            'shipping_address_line_2' => $this->shipping_address_line_2,
            'shipping_country_id' => $this->shipping_country_id,
            'shipping_state_id' => $this->shipping_state_id,
            'shipping_city_id' => $this->shipping_city_id,
            'shipping_zip_code' => $this->shipping_zip_code,

            'work_address_line_1' => $this->work_address_line_1,
            'work_address_line_2' => $this->work_address_line_2,
            'work_country_id' => $this->work_country_id,
            'work_state_id' => $this->work_state_id,
            'work_city_id' => $this->work_city_id,
            'work_zip_code' => $this->work_zip_code,


            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            "booked_appointments" => count($appointments),
            "pricing_plan_name" => $pricing_plan->name ?? "",
            "law_firm_modules" => $pricing_plan ? $pricing_plan->law_firm_modules()->pluck('pricing_plan_modules.module_code')->toArray() : [],
            "law_firm_settings" => $law_firm_settings ? LawFirmSettingsResource::collection($this->whenLoaded('law_firm_settings', function () {
                return $this->law_firm_settings;
            }))->pluck('value', 'name')->toArray() : [],
            "law_firm_category_ids" => $law_firm_categories ? LawFirmCategoriesResource::collection($this->whenLoaded('law_firm_categories', function () {
                return $this->law_firm_categories;
            }))->pluck('id')->toArray() : [],
            "law_firm_categories" => $law_firm_categories ? LawFirmCategoriesResource::collection($law_firm_categories) : [],
            "language_ids" => $languages ? AllLanguagesResource::collection($this->whenLoaded('languages', function () {
                return $this->languages;
            }))->pluck('id')->toArray() : [],
            "languages" => $languages ? AllLanguagesResource::collection($languages) : [],
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            "law_firm_lawyers" => $law_firm_lawyers ? LawyersResource::collection($law_firm_lawyers) : [],
            "law_firm_broadcasts" => $law_firm_broadcasts ? BroadcastsResource::collection($law_firm_broadcasts) : [],
            "law_firm_podcasts" => $law_firm_podcasts ? BroadcastsResource::collection($law_firm_podcasts) : [],
            "law_firm_services" => $law_firm_services ? ServicesResource::collection($law_firm_services) : [],
            "law_firm_events" => $law_firm_events ? EventsResource::collection($law_firm_events) : [],
            "law_firm_posts" => $law_firm_posts ? PostsResource::collection($law_firm_posts) : [],
            "law_firm_archives" => $law_firm_archives ? PostsResource::collection($law_firm_archives) : [],
            "law_firm_reviews" => $law_firm_reviews ? LawFirmReviewsResource::collection($law_firm_reviews) : [],
            "law_firm_certifications" => $law_firm_certifications ? CertificationsResource::collection($law_firm_certifications) : [],
            "appointment_types" => $appointment_schedules ? AppointmentSchedulesResource::collection($appointment_schedules)->keyBy('appointment_type.type') : [],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
