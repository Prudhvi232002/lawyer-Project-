<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityPostsResource extends JsonResource
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
        $share = $this->relationLoaded('share') ? $this->whenLoaded('share') : null;
        $blog_category = $this->relationLoaded('blog_category') ? $this->whenLoaded('blog_category') : null;
        $post_comments = $this->relationLoaded('post_comments') ? $this->whenLoaded('post_comments') : null;
        $post_likes = $this->relationLoaded('post_likes') ? $this->whenLoaded('post_likes') : null;
        return [
            "id" =>  $this->id,
            'lawyer_id' => $this->lawyer_id,
            'lawyer_name' => $lawyer ? $lawyer->name : "",
            'lawyer_image' => $lawyer ? $lawyer->image : "",
            'law_firm_id' => $this->law_firm_id,
            'law_firm_name' => $law_firm ? $law_firm->name : "",
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            'blog_category_id' => $this->blog_category_id,
            'blog_category_name' => $blog_category ? $blog_category->name : "",
            "name" =>  $this->name,
            "name_translations" => $this->getTranslations('name'),
            "description" =>  $this->description,
            "description_translations" =>  $this->getTranslations('description'),

            "slug" =>  $this->slug,
            "is_active" =>  $this->is_active,
            "is_featured" =>  $this->is_featured,
            "icon" =>  $this->icon,
            "image" =>  $this->image,
            "video" =>  $this->video,
            'post_comments' => $post_comments ? PostCommentsResource::collection($post_comments) : null,
            'post_likes' => $post_likes ? $post_likes->count() : 0,
            'is_shared' => $this->is_shared,
            "share_with_name" => $share ? $share->name : null,
            "share_with_image" => $share ? $share->image : null,
            "date" => $this->created_at->diffForHumans(),
            "created_at" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "updated_at" =>  $this->updated_at,
        ];
    }
}
