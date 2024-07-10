<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Pass the message count to the 'layouts.admin' view
        View::composer('layouts.admin', function ($view) {
            // $messageCount = Message::count();
            
            $userId = Auth::id();

            // Filtra i messaggi per gli appartamenti di proprietà dell'utente autenticato
            $messages = Message::whereHas('apartment', function($query) use ($userId) {
                $query->where('id_user', $userId);
            })->with('apartment')->orderByDesc('created_at')->get();
    
            // Conta i messaggi filtrati
            $messageCount = $messages->count();
            
            $view->with('messageCount', $messageCount);
            
            // return view('admin.messages', compact('messages', 'messageCount'));
        });
    }

    public function register()
    {
        // Register any application services.
    }
}