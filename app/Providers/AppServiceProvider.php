<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Pass the message count to the 'layouts.admin' view
        View::composer('layouts.admin', function ($view) {
            $messageCount = Message::count();
            $view->with('messageCount', $messageCount);
        });
    }

    public function register()
    {
        // Register any application services.
    }
}