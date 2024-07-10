<?php

// namespace App\Http\Controllers\Admin;

// use App\Models\Message;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;

// class MessageController extends Controller
// {
//     public function __construct()
//     {
//         // Assicurati che l'utente sia autenticato
//         $this->middleware('auth');
//     }

//     public function index()
//     {
//         // Ottieni l'ID dell'utente autenticato
//         $userId = Auth::id();

//         // Filtra i messaggi per gli appartamenti di proprietà dell'utente autenticato
//         $messages = Message::whereHas('apartment', function($query) use ($userId) {
//             $query->where('id_user', $userId);
//         })->with('apartment')->orderByDesc('created_at')->get();

//         $messageCount = $messages->count();
        
//         return view('admin.messages', compact('messages', 'messageCount'));
//     }

//     public function delete($id)
//     {
//         $message = Message::findOrFail($id);
        
//         // Controlla se l'utente autenticato è il proprietario dell'appartamento a cui il messaggio è associato
//         if ($message->apartment->id_user != Auth::id()) {
//             return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
//         }

//         $message->delete();
//         return response()->json(['success' => true]);
//     }

//     public function deleteAll()
//     {
//         // Ottieni l'ID dell'utente autenticato
//         $userId = Auth::id();

//         // Filtra e cancella solo i messaggi associati agli appartamenti di proprietà dell'utente autenticato
//         Message::whereHas('apartment', function($query) use ($userId) {
//             $query->where('id_user', $userId);
//         })->delete();

//         return response()->json(['success' => true]);
//     }
// }

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        // Assicurati che l'utente sia autenticato
        $this->middleware('auth');
    }

    public function index()
    {
        // Ottieni l'ID dell'utente autenticato
        $userId = Auth::id();

        // Filtra i messaggi per gli appartamenti di proprietà dell'utente autenticato
        $messages = Message::whereHas('apartment', function($query) use ($userId) {
            $query->where('id_user', $userId);
        })->with('apartment')->orderByDesc('created_at')->get();

        // Conta i messaggi filtrati
        $messageCount = $messages->count();
        
        return view('admin.messages', compact('messages', 'messageCount'));
    }

    public function delete($id)
    {
        $message = Message::findOrFail($id);
        
        // Controlla se l'utente autenticato è il proprietario dell'appartamento a cui il messaggio è associato
        if ($message->apartment->id_user != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $message->delete();
        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        // Ottieni l'ID dell'utente autenticato
        $userId = Auth::id();

        // Filtra e cancella solo i messaggi associati agli appartamenti di proprietà dell'utente autenticato
        Message::whereHas('apartment', function($query) use ($userId) {
            $query->where('id_user', $userId);
        })->delete();

        return response()->json(['success' => true]);
    }
}
