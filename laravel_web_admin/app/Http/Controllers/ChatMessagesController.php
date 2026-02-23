<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Events\ServiceChatMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\MessagesResource;
use App\Models\BookAppointment;
use App\Models\BookedService;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getChatMessages(Request $request)
    {

        $messages = Message::query();

        if($request->service_id){
            $messages = $messages->where('booked_service_id', $request->service_id);
        }else{
            $messages = $messages->where('appointment_id', $request->appointment_id);
        }
        $messages = $messages->get();
        $messages = MessagesResource::collection($messages);
        $response = generateResponse($messages, true, "Chat Messages fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function sendChatMessage(Request $request)
    {
        // dd($request->all());
        $request->merge(['booked_service_id' => $request->service_id]);
        $data = $request->all();
        $user = Auth::user();
        $appointment = BookAppointment::where('id', $request->appointment_id)->first();
        $service = BookedService::where('id', $request->service_id)->first();
        $logged_in_as = $request->session()->get('logged_in_as');
        if ($logged_in_as == 'lawyer') {
            $lawyer = $user->lawyer;
            $sender_id = $lawyer->id;
            $sender_type = 'App\Models\Lawyer';
        }
        if ($logged_in_as == 'law_firm') {
            $law_firm = $user->law_firm;
            $sender_id = $law_firm->id;
            $sender_type = 'App\Models\LawFirm';
        }

        if ($logged_in_as == 'customer') {
            $customer = $user->customer;
            $sender_id = $customer->id;
            $sender_type = 'App\Models\Customer';
        }

        $data['sender_id'] = $sender_id;
        $data['sender_type'] = $sender_type;
    //    Not using anywhere
    if($appointment){
        $data['reciever_id'] = $appointment->customer_id;
        $data['reciever_type'] = "App\Models\Customer";
        $data['reciever_id'] = $appointment->lawyer_id;
        $data['reciever_type'] = "App\Models\Lawyer";
    }
    //    Not using anywhere
        if ($request->hasFile('attachment_file')) {
            $data['attachment_url'] = uploadFile($request, 'attachment_file', 'chat_attachments');
            $data['is_attachment'] = 1;
        }
        $message = Message::create($data);
        $message = new MessagesResource($message);
        if($appointment){
            event(new ChatMessage($message));
        }else{
            event(new ServiceChatMessage($message));
        }

        $response = generateResponse($message, true, "Message send successfully", null, 'collection');
        return response()->json($response);
    }
}
