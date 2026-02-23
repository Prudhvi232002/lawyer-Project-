<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookedServicesResource extends JsonResource
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
        $customer = $this->relationLoaded('customer') ? $this->whenLoaded('customer') : null;
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer') : null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm') : null;
        $service = $this->relationLoaded('service') ? $this->whenLoaded('service') : null;
        $service_status = $this->relationLoaded('service_status') ? $this->whenLoaded('service_status') : null;
        $messages = $this->relationLoaded('messages') ? $this->whenLoaded('messages') : null;
        $reviews = $this->relationLoaded('reviews') ? $this->whenLoaded('reviews') : null;
        return [
            "id" =>  $this->id,
            "customer_id" =>  $this->customer_id,
            "customer_name" => $customer ? $customer->name : null,
            "customer_image" => $customer ? $customer->image : null,
            "lawyer_id" =>  $this->lawyer_id,
            "lawyer_name" => $lawyer ? $lawyer->name : null,
            "lawyer_image" => $lawyer ? $lawyer->image : null,
            "law_firm_id" =>  $this->law_firm_id,
            "law_firm_name" => $law_firm ? $law_firm->name : null,
            "law_firm_image" => $law_firm ? $law_firm->image : null,
            "service_id" =>  $this->service_id,
            "service_name" => $service ? $service->name : null,
            "service_image" => $service ? $service->image : null,
            "service_status_name" => $service_status ? $service_status->display_name : null,
            "date" => Carbon::parse($this->date)->format('d/m/Y'),
            "started_at" =>  $this->started_at,
            "ended_at" =>  $this->ended_at,
            "price" =>  $this->price,
            "is_paid" =>  $this->is_paid,
            "question" =>  $this->question,
            "attachment_url" =>  $this->attachment_url,
            "service_status_code" =>  $this->service_status_code,
            "messages" => $messages ? MessagesResource::collection($messages):[],
            "reviews" => $reviews ? ServiceReviewsResource::collection($reviews):[],
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
        ];
    }
}
