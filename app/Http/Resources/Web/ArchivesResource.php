<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchivesResource extends JsonResource
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
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags') : null;
        $law_firm = $this->relationLoaded('law_firm') ? $this->whenLoaded('law_firm') : null;
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer') : null;
        $archive_category = $this->relationLoaded('archive_category') ? $this->whenLoaded('archive_category') : null;

        return [
            "id" =>  $this->id,
            'lawyer_id' => $this->lawyer_id,
            'lawyer_name' => $lawyer ? $lawyer->name : "",
            'law_firm_id' => $this->law_firm_id,
            'law_firm_name' => $law_firm ? $law_firm->name : "",
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            'archive_category_id' => $this->archive_category_id,
            'archive_category_name' => $archive_category ? $archive_category->name : "",
            "name" =>  $this->name,
            "name_translations" => $this->getTranslations('name'),
            "description" =>  $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "slug" =>  $this->slug,
            "is_active" =>  $this->is_active,
            "is_featured" =>  $this->is_featured,
            "icon" =>  $this->icon,
            "image" =>  $this->image,
            "created_at" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "updated_at" =>  $this->updated_at,
        ];
    }
}
