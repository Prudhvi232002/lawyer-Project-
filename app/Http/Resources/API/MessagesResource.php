<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResource extends JsonResource
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
        $sender_type = "";
        if($this->sender_type == 'App\Models\Lawyer'){
            $sender_type = 'lawyer';
        }
        if($this->sender_type == 'App\Models\Customer'){
            $sender_type = 'customer';
        }
        if($this->sender_type == 'App\Models\LawFirm'){
            $sender_type = 'law_firm';
        }
        $reciever_type = "";
        if($this->reciever_type == 'App\Models\Lawyer'){
            $reciever_type = 'lawyer';
        }
        if($this->reciever_type == 'App\Models\Customer'){
            $reciever_type = 'customer';
        }
        if($this->reciever_type == 'App\Models\LawFirm'){
            $reciever_type = 'law_firm';
        }
        return [
                "id" =>  $this->id,
                "message" =>  $this->message,
                "appointment_id" =>  $this->appointment_id,
                "booked_service_id" =>  $this->booked_service_id,
                "sender_id" =>  $this->sender_id,
                "sender_type" =>  $sender_type,
                "reciever_id" =>  $this->reciever_id,
                "reciever_type" =>  $reciever_type,
                "attachment_url" =>  $this->attachment_url,
                "is_attachment" =>  $this->is_attachment ? true : false,
                "is_seen" =>  $this->is_seen ? true : false,
                "seen_at" =>  $this->seen_at,
                "is_delivered" =>  $this->is_delivered ? true : false,
                "delivered_at" =>  $this->delivered_at,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
