<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookAppointmentsResource extends JsonResource
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
        $appointment_status = $this->relationLoaded('appointment_status') ? $this->whenLoaded('appointment_status') : null;
        $appointment_type = $this->relationLoaded('appointment_type') ? $this->whenLoaded('appointment_type') : null;
        $messages = $this->relationLoaded('messages') ? $this->whenLoaded('messages') : null;
        $fund = $this->relationLoaded('fund') ? $this->whenLoaded('fund') : null;
        return [
            "id" =>  $this->id,
            "customer_id" =>  $this->customer_id,
            "customer_name" => $customer ? $customer->name : null,
            "customer_image" => $customer ? $customer->image : null,
            "appointment_status_name" => $appointment_status ? $appointment_status->display_name : null,
            "appointment_type_name" => $appointment_type ? $appointment_type->display_name : null,
            "is_schedule_required" => $appointment_type->is_schedule_required ? 1 : 0,
            "lawyer_id" =>  $this->lawyer_id,
            "lawyer_name" => $lawyer ? $lawyer->name : null,
            "lawyer_image" => $lawyer ? $lawyer->image : null,
            "lawyer_cover_image" => $lawyer ? $lawyer->cover_image : null,
            'ratings'=> AppointmentRatingsResource::collection($this->whenLoaded('ratings')),
            "law_firm_id" =>  $this->law_firm_id,
            "law_firm_name" => $law_firm->name ?? null,
            "law_firm_image" => $law_firm->image ?? null,
            "law_firm_cover_image" => $law_firm->cover_image ?? null,
            "date" => Carbon::parse($this->date)->format('d/m/Y'),
            "start_time" =>  $this->start_time,
            "end_time" =>  $this->end_time,
            "fee" =>  $this->fee,
            "is_paid" =>  $this->is_paid,
            "appointment_type_id" =>  $this->appointment_type_id,
            "appointment_type" =>  $this->appointment_type->type,
            "question" =>  $this->question,
            "attachment_url" =>  $this->attachment_url,
            "appointment_status_code" =>  $this->appointment_status_code,
            "messages" => $messages ? MessagesResource::collection($messages):[],
            "is_started" => $this->is_started,
            "is_ended" => $this->is_ended,
            "fund" => $fund ? $fund: '',
            "started_at" => $this->started_at,
            "ended_at" => $this->ended_at,
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
        ];
    }
}
