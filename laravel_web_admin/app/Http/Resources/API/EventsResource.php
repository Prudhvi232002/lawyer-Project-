<?php

namespace App\Http\Resources\API;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
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
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags'):null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm'):null;
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer'):null;
        $event_category = $this->relationLoaded('event_category') ? $this->whenLoaded('event_category') : null;
        return [
                "id" =>  $this->id,
                'lawyer_id' => $this->lawyer_id,
                'lawyer_name' => $lawyer ? $lawyer->name :"",
                'law_firm_id' => $this->law_firm_id,
                'law_firm_name' => $law_firm ? $law_firm->name :"",
                'event_category_id' => $this->event_category_id,
                'event_category_name' => $event_category ? $event_category->name :"",
                "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags',function(){
                    return $this->tags;
                }))->pluck('id')->toArray():[],
                "tags" => $tags ? TagsResource::collection($tags):[],
                "name" =>  $this->name,
                "description" =>  $this->description,
                "slug" =>  $this->slug,
                "is_active" =>  $this->is_active,
                "is_featured" =>  $this->is_featured,
                "starts_at" =>  $this->starts_at,
                "ends_at" =>  $this->ends_at,
                "sponsor" =>  $this->sponsor,
                "icon" =>  $this->icon,
                "address_line_1" =>  $this->address_line_1,
                "address_line_2" =>  $this->address_line_2,
                "image" =>  $this->image,
                "created_at" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
                "updated_at" =>  $this->updated_at,
        ];
    }
}
