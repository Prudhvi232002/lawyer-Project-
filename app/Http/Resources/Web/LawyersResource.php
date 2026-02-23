<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
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
        $lawyer_broadcasts = $this->relationLoaded('lawyer_broadcasts') ? $this->whenLoaded('lawyer_broadcasts') : null;
        $lawyer_podcasts = $this->relationLoaded('lawyer_podcasts') ? $this->whenLoaded('lawyer_podcasts') : null;
        $lawyer_services = $this->relationLoaded('lawyer_services') ? $this->whenLoaded('lawyer_services') : null;
        $lawyer_events = $this->relationLoaded('lawyer_events') ? $this->whenLoaded('lawyer_events') : null;
        $lawyer_posts = $this->relationLoaded('lawyer_posts') ? $this->whenLoaded('lawyer_posts') : null;
        $lawyer_archives = $this->relationLoaded('lawyer_archives') ? $this->whenLoaded('lawyer_archives') : null;
        $lawyer_reviews = $this->relationLoaded('lawyer_reviews') ? $this->whenLoaded('lawyer_reviews') : null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan') : null;
        $country = $this->relationLoaded('country') ? $this->whenLoaded('country') : null;
        $state = $this->relationLoaded('state') ? $this->whenLoaded('state') : null;
        $city = $this->relationLoaded('city') ? $this->whenLoaded('city') : null;
        $languages = $this->relationLoaded('languages') ? $this->whenLoaded('languages') : null;
        $appointment_schedules = $this->relationLoaded('appointment_schedules') ? $this->whenLoaded('appointment_schedules') : null;
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags') : null;
        $user = $this->relationLoaded('user') ? $this->whenLoaded('user') : null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm') : null;
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
            "law_firm_id" => $this->law_firm_id,
            "law_firm_name" => $law_firm->name ?? '',
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
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "experience" => $this->experience,
            "speciality" => $this->speciality,
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            "is_active" => $this->is_active,
            "is_online" => $this->is_online,
            "is_premium" => $this->is_premium,
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
            'is_special' => $this->is_special,

            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            "pricing_plan_name" => $pricing_plan->name ?? "",
            "lawyer_modules" => $pricing_plan ? $pricing_plan->lawyer_modules()->pluck('pricing_plan_modules.module_code')->toArray() : [],
            "lawyer_settings" => $lawyer_settings ? LawyerSettingsResource::collection($this->whenLoaded('lawyer_settings', function () {
                return $this->lawyer_settings;
            }))->pluck('value', 'name')->toArray() : [],
            "lawyer_category_ids" => $lawyer_categories ? LawyerCategoriesResource::collection($this->whenLoaded('lawyer_categories', function () {
                return $this->lawyer_categories;
            }))->pluck('id')->toArray() : [],
            "lawyer_categories" => $lawyer_categories ? LawyerCategoriesResource::collection($lawyer_categories) : [],
            "lawyer_broadcasts" => $lawyer_broadcasts ? BroadcastsResource::collection($lawyer_broadcasts) : [],
            "lawyer_podcasts" => $lawyer_podcasts ? BroadcastsResource::collection($lawyer_podcasts) : [],
            "lawyer_services" => $lawyer_services ? ServicesResource::collection($lawyer_services) : [],
            "lawyer_events" => $lawyer_events ? EventsResource::collection($lawyer_events) : [],
            "lawyer_posts" => $lawyer_posts ? PostsResource::collection($lawyer_posts) : [],
            "lawyer_archives" => $lawyer_archives ? ArchivesResource::collection($lawyer_archives) : [],
            "lawyer_reviews" => $lawyer_reviews ? LawyerReviewsResource::collection($lawyer_reviews) : [],
            "appointment_types" => $appointment_schedules ? AppointmentSchedulesResource::collection($appointment_schedules)->keyBy('appointment_type.type') : [],

            "language_ids" => $languages ? AllLanguagesResource::collection($this->whenLoaded('languages', function () {
                return $this->languages;
            }))->pluck('id')->toArray() : [],
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            "user" => $user,

            "created_at" => Carbon::parse($this->created_at)->format('Y-m-d h:i:s'),
            "updated_at" => $this->updated_at,
        ];
    }
}
