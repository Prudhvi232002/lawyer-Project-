<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceReviewsResource extends JsonResource
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
        $customer = $this->relationLoaded('customer') ? $this->whenLoaded('customer'):null;
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer'):null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm'):null;
        $service = $this->relationLoaded('service') ? $this->whenLoaded('service'):null;
        return [
                "id" =>  $this->id,
                "rating" =>  $this->rating,
                "experience" =>  $this->experience,
                "communication" =>  $this->communication,
                "service" =>  $this->service,
                "comment" =>  $this->comment,
                "is_active" =>  $this->is_active,
                "customer" =>[
                    "id" => $customer->id,
                    "name" => $customer->name ?? '',
                    "image" => $customer->image ?? '',
                ],
                "law_firm" =>[
                    "id" => $law_firm->id,
                    "name" => $law_firm->name ?? '',
                    "image" => $law_firm->image ?? '',
                ],
                "lawyer" =>[
                    "id" => $lawyer->id,
                    "name" => $lawyer->name ?? '',
                    "image" => $lawyer->image ?? '',
                ],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
