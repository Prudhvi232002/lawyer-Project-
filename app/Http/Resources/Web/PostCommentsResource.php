<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentsResource extends JsonResource
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
        $lawyer = $this->relationLoaded('lawyer') ? $this->whenLoaded('lawyer') : null;
        $user = $this->relationLoaded('user') ? $this->whenLoaded('user') : null;
        $replies = $this->relationLoaded('replies') ? $this->whenLoaded('replies') : null;

        return [
                "id" =>  $this->id,
                "post_id" =>  $this->post_id,
                "user_id" =>  $this->user_id,
                "user_name" => $user? $user->name : "",
                "user_image" => $user? $user->image : "",
                "lawyer_id" =>  $this->lawyer_id,
                "lawyer_name" => $lawyer? $lawyer->name : "",
                "lawyer_image" => $lawyer? $lawyer->image : "",
                "replies" => $replies ? $replies : null,
                "content" =>  $this->content,
                "is_like" =>  $this->is_like,
                "parent_id" =>  $this->parent_id,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
