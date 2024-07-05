<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->get();
        $messageCount = $messages->count();
        return view('admin.messages', compact('messages', 'messageCount'));
    }

    // public function pippo()
    // {
    //     $messages = Message::all();
    //     $culo = $messages->count();
    //     return view('layouts.admin', compact('culo', 'messages'));
    // }
}
