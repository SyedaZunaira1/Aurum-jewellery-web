<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        \Illuminate\Auth\Notifications\ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.url') . "/admin/password/reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
