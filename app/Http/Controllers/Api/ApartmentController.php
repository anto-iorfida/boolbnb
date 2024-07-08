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
        $apartment = Apartment::where('slug', '=', $slug)->with('services','albums','users')->first();

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


 //     public function searchApartment()
// {
//     // Codice per recuperare gli appartamenti con i servizi
//     $apartments = Apartment::with('services')->get();

//         return response()->json([
//             'success' => true,
//             'result' => $apartments
//         ]);
// }
// public function searchApartments(Request $request)
// {
//     // Ottiene la latitudine convertendola in float dal parametro 'latitude' della query
//     $latitude = floatval($request->query('latitude'));

//     // Ottiene la longitudine convertendola in float dal parametro 'longitude' della query
//     $longitude = floatval($request->query('longitude'));

//     // Ottiene il raggio convertendolo in float dal parametro 'radius' della query, con default a 1000 km se non specificato
//     $radius = floatval($request->query('radius', 1000));

 
//     $number_beds = floatval($request->query('number_beds', 1));

//     // Valida i parametri della richiesta
//     $request->validate([
//         'latitude' => 'required|numeric',
//         'longitude' => 'required|numeric',
//         'radius' => 'required|numeric|min:1',
//         'number_beds' => 'required|numeric|min:1' 
//     ]);

//     try {
//         // Esegue una query per selezionare gli appartamenti e calcolare la distanza in base alle coordinate fornite
//         $apartments = Apartment::selectRaw(
//             "*, 
//             ( 6371 * acos( 
//                 cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) 
//                 + sin( radians(?) ) * sin( radians( latitude ) ) 
//             ) ) AS distance",
//             [$latitude, $longitude, $latitude]
//         )
//             // Filtra i risultati per distanza, includendo solo quelli entro il raggio specificato
//             ->having("distance", "<", $radius)
            
//             ->where('number_beds', '>=', $number_beds)
//             // Ordina i risultati per distanza in ordine ascendente
//             ->orderBy("distance", 'asc')
//             // Carica anche le relazioni di servizi degli appartamenti, se necessario
//             ->with('services', 'users', 'albums')
//             // Esegue la query e ottiene tutti i risultati
//             ->get();

//         // Restituisce una risposta JSON con i risultati degli appartamenti trovati
//         return response()->json(['success' => true, 'result' => $apartments]);
//     } catch (\Exception $e) {
//         // Se si verifica un'eccezione durante l'esecuzione della query, restituisce un errore con codice 500
//         return response()->json(['success' => false, 'error' => 'An error occurred while fetching apartments.'], 500);
//     }
// }
    public function searchApartments(Request $request)
    {
        // Ottiene la latitudine convertendola in float dal parametro 'latitude' della query
        $latitude = floatval($request->query('latitude'));

        // Ottiene la longitudine convertendola in float dal parametro 'longitude' della query
        $longitude = floatval($request->query('longitude'));

        // Ottiene il raggio convertendolo in float dal parametro 'radius' della query, con default a 1000 km se non specificato
        $radius = floatval($request->query('radius', 1000));

        // Ottiene il numero di letti convertendolo in float dal parametro 'number_beds' della query, se presente
        $number_beds = $request->filled('number_beds') ? floatval($request->query('number_beds')) : null;

        // Ottiene il numero di bagni convertendolo in float dal parametro 'number_baths' della query, se presente
        $number_baths = $request->filled('number_baths') ? floatval($request->query('number_baths')) : null;

        // Ottiene la lista dei servizi dalla query
        $services = $request->query('services') ? explode(',', $request->query('services')) : [];

        // Regole di validazione per i parametri della richiesta
        $rules = [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric|min:1',
        ];

        // Se number_baths è stato fornito, aggiungi la regola di validazione
        if ($number_baths !== null) {
            $rules['number_baths'] = 'required|numeric|min:1';
        }

        // Se number_beds è stato fornito, aggiungi la regola di validazione
        if ($number_beds !== null) {
            $rules['number_beds'] = 'required|numeric|min:1';
        }

        // Valida i parametri della richiesta
        $request->validate($rules);

        try {
            // Costruisci la query per selezionare gli appartamenti e calcolare la distanza
            $query = Apartment::selectRaw(
                "*, 
                ( 6371 * acos( 
                    cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) 
                    + sin( radians(?) ) * sin( radians( latitude ) ) 
                ) ) AS distance",
                [$latitude, $longitude, $latitude]
            )
                ->having("distance", "<", $radius);

            // Se number_beds è stato fornito, aggiungi il filtro per number_beds
            if ($number_beds !== null) {
                $query->where('number_beds', '>=', $number_beds);
            }

            // Se number_baths è stato fornito, aggiungi il filtro per number_baths
            if ($number_baths !== null) {
                $query->where('number_baths', '>=', $number_baths);
            }

            // Se servizi sono stati forniti, aggiungi il filtro per i servizi
            if (!empty($services)) {
                $query->whereHas('services', function ($q) use ($services) {
                    $q->whereIn('name', $services);
                });
            }

            // Esegui l'ordinamento per distanza in ordine ascendente e carica le relazioni
            $apartments = $query->orderBy("distance", 'asc')
                ->with('services', 'users', 'albums')
                ->get();

            // Restituisci una risposta JSON con i risultati degli appartamenti trovati
            return response()->json(['success' => true, 'result' => $apartments]);
        } catch (\Exception $e) {
            // Se si verifica un'eccezione durante l'esecuzione della query, restituisci un errore con codice 500
            return response()->json(['success' => false, 'error' => 'An error occurred while fetching apartments.'], 500);
        }
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
                'images' => 'required|array|max:1700',
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
