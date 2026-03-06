<?php

namespace App\Console\Commands;

use App\Http\Controllers\NotificationSettingsController;
use App\Models\BookAppointment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class RemindMyAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind User Appointments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointments = BookAppointment::where('appointment_status_code', 2)->get();
        // dd($appointments);
        foreach ($appointments as $appointment) {

            $email_users = [
                'customer' => User::where('id', $appointment->customer->user_id)->first(),
                'lawyer' => User::where('id', $appointment->lawyer->user_id)->first(),
                // 'lawfirm' => User::where('id', $appointment->law_firm->user_id)->first(),
            ];
            NotificationSettingsController::fireNotificationEvent($appointment, 'before_hour_appointment_notification', $email_users);
        }
    }
}
