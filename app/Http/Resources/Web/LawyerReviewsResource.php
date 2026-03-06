<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class LawyerReviewsResource extends JsonResource
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
        return [
                "id" =>  $this->id,
                "rating" =>  $this->rating,
                "experience" =>  $this->experience,
                "communication" =>  $this->communication,
                "service" =>  $this->service,
                "comment" =>  $this->comment,
                "is_active" =>  $this->is_active,
                "customer" =>[
                    "name" => $customer->name ?? '',
                    "image" => $customer->image ?? '',
                ],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
