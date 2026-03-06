<?php

namespace App\Console;

use App\Http\Controllers\NotificationSettingsController;
use App\Models\BookAppointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $appointments = BookAppointment::withAll()->where('appointment_status_code', 2)->get();

        foreach ($appointments as $key => $appointment) {
            $email_users = [
                'customer' => User::where('id', $appointment->customer->user_id)->first(),
                'lawyer' => User::where('id', $appointment->lawyer->user_id)->first(),
                // 'lawfirm' => User::where('id', $appointment->law_firm->user_id)->first(),
            ];
            $appointment_time = Carbon::parse($appointment->start_time);
            $reminder_time = $appointment_time->copy()->subHour();
            $schedule->call(function () use ($appointment, $email_users) {
                NotificationSettingsController::fireNotificationEvent($appointment, 'before_hour_appointment_notification', $email_users);
            })->dailyAt($reminder_time->format('H:i'));
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
