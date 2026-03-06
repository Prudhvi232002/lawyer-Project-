<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
class OverrideSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
          if (File::exists(storage_path('installed'))) {
            $settings = generalSettings();

        Config::set('broadcasting.connections.pusher.app_id', $settings['pusher_app_id']);
        Config::set('broadcasting.connections.pusher.secret', $settings['pusher_app_secret']);
        Config::set('broadcasting.connections.pusher.key', $settings['pusher_app_key']);
        Config::set('broadcasting.connections.pusher.options.host', "api-".$settings['pusher_app_cluster'].".pusher.com");


        Config::set('cashier.key', $settings['stripe_key']);
        Config::set('cashier.secret', $settings['stripe_secret']);
        Config::set('services.google.client_id', $settings['google_client_id']);
        Config::set('services.google.client_secret', $settings['google_client_secret']);
        Config::set('services.facebook.client_id', $settings['facebook_client_id']);
        Config::set('services.facebook.client_secret', $settings['facebook_client_secret']);


        Config::set('mail.mailers.smtp.transport', $settings['mail_driver']);
        Config::set('mail.mailers.smtp.host', $settings['mail_host']);
        Config::set('mail.mailers.smtp.port', $settings['mail_port']);
        Config::set('mail.mailers.smtp.username', $settings['mail_username']);
        Config::set('mail.mailers.smtp.password', $settings['mail_password']);
        Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption']);
        }

    }
}
