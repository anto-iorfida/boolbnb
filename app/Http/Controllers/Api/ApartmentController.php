<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;


class ApartmentController extends Controller
{
    public function index()
    {
        // $apartments = Apartment::with('services')->paginate(3);
        $apartments = Apartment::with('services')->get();

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::where('slug', '=', $slug)->with('services')->first();

        if ($apartment) {
            $data = [
                'success' => true,
                'apartment' => $apartment
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'No apartment found with this slug'
            ];
        }

        return response()->json($data);
    }

    private function validation($data)
    {
        return Validator::make(
            $data,
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'number_rooms' => 'required|integer',
                'number_beds' => 'required|integer',
                'number_baths' => 'required|integer',
                'square_meters' => 'required|integer',
                'thumb' => 'required|image|max:1700',
                'images' => 'required|image|max:1700',
                'address' => 'required|string',
                'longitude' => 'required|numeric|between:-180,180',
                'latitude' => 'required|numeric|between:-90,90',
                'visibility' => 'required|boolean',
                'services' => 'required|array|min:1',
                'services.*' => 'integer|exists:services,id',
            ],
            [
                'title.required' => 'Il campo titolo è obbligatorio',
                'description.required' => 'Il campo descrizione è obbligatorio',
                'number_rooms.required' => 'Il campo numero di stanze è obbligatorio',
                'number_beds.required' => 'Il campo numero di letti è obbligatorio',
                'number_baths.required' => 'Il campo numero di bagni è facoltativo',
                'square_meters.required' => 'Il campo metri quadri è facoltativo',
                'address.required' => 'Il campo indirizzo è obbligatorio',
                'longitude.required' => 'Il campo longitudine è obbligatorio',
                'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
                'latitude.required' => 'Il campo latitudine è obbligatorio',
                'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
                'images.required' => 'Il campo images è obbligatorio',
                'thumb.required' => 'Il campo thumb è obbligatorio',
                'thumb.image' => 'Il file deve essere un\'immagine',
                'thumb.max' => 'L\'immagine non può superare i 1700KB',
                'visibility.required' => 'Il campo visibilità è obbligatorio',
                'services.required' => 'Seleziona almeno un servizio.',
                'services.array' => 'I servizi devono essere un array',
                'services.*.integer' => 'Il servizio deve essere un ID valido',
                'services.*.exists' => 'Il servizio selezionato non esiste',
            ]
        )->validate();
    }

    public function validateApartment(Request $request)
    {
        try {
            $this->validation($request->all());
            return response()->json(['message' => 'Validation passed'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validazione dei campi obbligatori
            $validatedData = $request->validate([
                'apartment_id' => 'required|exists:apartments,id',
                'name_lastname' => 'required|string|max:255',
                'email_sender' => 'required|email|max:255',
                'body' => 'required|string',
            ]);
    
            Log::info('Validated Data: ' . json_encode($validatedData));
    
            // Recupera l'appartamento tramite l'ID passato nel payload della richiesta
            $apartment = Apartment::findOrFail($validatedData['apartment_id']);
    
            Log::info('Apartment found: ' . json_encode($apartment));
    
            // Crea e salva il messaggio
            $message = new Message();
            $message->apartment_id = $apartment->id;
            $message->name_lastname = $validatedData['name_lastname'];
            $message->email_sender = $validatedData['email_sender'];
            $message->body = $validatedData['body'];
            $message->save();
    
            // Risposta JSON con conferma di successo
            return response()->json(['message' => 'Messaggio inviato con successo'], 200);
        } catch (\Exception $e) {
            // Gestione degli errori e risposta JSON con errore
            Log::error('Errore durante il salvataggio del messaggio: ' . $e->getMessage());
            return response()->json(['error' => 'Errore durante il salvataggio del messaggio'], 500);
        }
    }
    
    public function showMessages($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $messages = $apartment->messages()->get(); 

        return view('messages.index', compact('messages'));
    }
}
