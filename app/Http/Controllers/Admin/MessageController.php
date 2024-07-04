<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->get();
        return view('admin.messages', compact('messages'));
    }
}
