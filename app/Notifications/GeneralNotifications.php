<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotifications extends Notification
{
    use Queueable;

    public $data;
    public $notification_setting_name;
    public $email_user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data,$notification_setting_name,$email_user = null)
    {
        $this->data = $data;
        $this->notification_setting_name = $notification_setting_name;
        $this->email_user = $email_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $statusDescription = '';

        switch ($this->notification_setting_name) {
            case 'new-signup-customer':
                return (new MailMessage)
                ->subject('Welcome To Platform')
                ->markdown('emails.general.signup', ['customer' => $this->data,'email_user' => $this->email_user]);
            case 'new-signup-law':
                return (new MailMessage)
                ->subject('Welcome To Platform')
                ->markdown('emails.general.signup', ['lawyer' => $this->data,'email_user' => $this->email_user]);
            case 'new-signup-law-firm':
                return (new MailMessage)
                    ->subject('Welcome To Platform')
                    ->markdown('emails.general.signup', ['law_firm' => $this->data,'email_user' => $this->email_user]);

            case 'change_password':
                return (new MailMessage)
                ->subject('Forgot Password')
                ->markdown('emails.general.change_password', ['user' => $this->data,'email_user' => $this->email_user]);
            case 'reset_password':
                return (new MailMessage)
                    ->subject('Reset Password')
                    ->markdown('emails.general.reset_password', ['user' => $this->data,'email_user' => $this->email_user]);

            case 'approve_or_reject_lawyer':
                return (new MailMessage)
                    ->subject('Lawyer Status Updated')
                    ->markdown('emails.general.approve_or_reject', ['lawyer' => $this->data,'email_user' => $this->email_user]);
            case 'approve_or_reject_law_firm':
                return (new MailMessage)
                    ->subject('Law Firm Status Updated')
                    ->markdown('emails.general.approve_or_reject_law_firm', ['law_firm' => $this->data,'email_user' => $this->email_user]);

            case 'new_appointment_registration':
                return (new MailMessage)
                ->subject('New Appointment')
                ->markdown('emails.general.appointment_book', ['appointment' => $this->data,'email_user' => $this->email_user]);
            case 'before_hour_appointment_notification':
                return (new MailMessage)
                    ->subject('Appointment Reminder')
                    ->markdown('emails.general.appointment_book', ['appointment' => $this->data,'email_user' => $this->email_user]);

            case 'change_appointment_status':
                return (new MailMessage)
                    ->subject('Appointment Status Update')
                    ->markdown('emails.general.appointment_status', ['appointment' => $this->data,'email_user' => $this->email_user]);

            case 'book_quick_service':
                return (new MailMessage)
                    ->subject('New Quick By Service Booked')
                    ->markdown('emails.general.book_service', ['service' => $this->data,'email_user' => $this->email_user]);
            default:
                return null; // Handle unknown notification settings gracefully
        }




    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
