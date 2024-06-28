<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartment;
use App\Models\View;
use App\Models\Service;
use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    public function index() //----------------------------------------------------------------------------------------------------------------------------------
    {
        $userId = Auth::id();

        $apartments = Apartment::where('id_user', $userId)->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    public function create(Service $services) //----------------------------------------------------------------------------------------------------------------------------------
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    public function store(Request $request) //---------------------------------------------------------------------------------------------------------------------
    {
        $validatedData = $this->validation($request->all());
        $slug = Str::slug($validatedData['title'], '-');

        $validatedData['slug'] = $slug;

        $formData = $validatedData;


        if ($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('apartment_images', $formData['thumb']);
            $formData['thumb'] = $img_path;
        }

        $newApartment = new Apartment();
        $newApartment->fill($formData);

        $newApartment->slug = Str::slug($newApartment->title, '-');
        $newApartment->id_user = Auth::id();
        // dd($request->all());
        $newApartment->save();

        // "Attaccare" i services scelti dall'utente all'appartamento creato
        // if ($request->has('services')) {
        //     $newApartment->services()->attach($validatedData['services']);
        // }
        if($request->has('services')) {
            $newApartment->services()->attach($formData['services']);
        } else {
            $newApartment->services()->detach();
        }


        return redirect()->route('admin.apartments.show', $newApartment->slug)->with('message', $newApartment->title . ' successfully created.');
    }

    public function show(Apartment $apartment, Sponsor $sponsor, Request $request) //----------------------------------------------------------------------------
    {
        $sponsor = Sponsor::all();
        $ipAddress = $request->ip();
        $currentDateTime = Carbon::now();
        $viewKey = 'viewed_apartment_' . $apartment->id;

        // Controlla se l'utente ha già visualizzato questo appartamento nelle ultime 24 ore
        if (!$request->session()->has($viewKey)) {
            // Registra una nuova visualizzazione
            View::create([
                'apartment_id' => $apartment->id,
                'ip_address' => $ipAddress,
                'date_time' => $currentDateTime,
            ]);

            // Incrementa il conteggio delle visualizzazioni nell'appartamento
            $apartment->views_count = $apartment->views_count + 1;
            $apartment->save();

            // Memorizza nella sessione che l'utente ha visualizzato questo appartamento
            $request->session()->put($viewKey, true);
        }

        return view('admin.apartments.show', compact('apartment', 'sponsor'));
    }

    public function edit(Apartment $apartment) //--------------------------------------------------------------------------------------------------------------------
    {

        return view('admin.apartments.edit', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment) //----------------------------------------------------------------------------------------------
    {
        $request->validate(
            [
                'title' => [
                    'required',
                    'min:3',
                    'max:255',
                    Rule::unique('apartments')->ignore($apartment)
                ],
                'description' => 'required|string',
                'number_rooms' => 'required|integer',
                'number_beds' => 'required|integer',
                'number_baths' => 'nullable|integer',
                'square_meters' => 'nullable|integer',
                'thumb' => 'required|image|max:256',
                'address' => 'required|string',
                'longitude' => 'required|numeric|between:-180,180',
                'latitude' => 'required|numeric|between:-90,90',
                'price' => 'required|numeric',
                'visibility' => 'required|boolean',
            ],
            [
                'title.required' => 'Il campo titolo è obbligatorio',
                'description.required' => 'Il campo descrizione è obbligatorio',
                'number_rooms.required' => 'Il campo numero di stanze è obbligatorio',
                'number_beds.required' => 'Il campo numero di letti è obbligatorio',
                'address.required' => 'Il campo indirizzo è obbligatorio',
                'longitude.required' => 'Il campo longitudine è obbligatorio',
                'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
                'latitude.required' => 'Il campo latitudine è obbligatorio',
                'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
                'price.required' => 'Il campo prezzo è obbligatorio',
                'thumb.required' => 'Il campo thumb è obbligatorio',
                'thumb.image' => 'Il file deve essere un immagine',
                'thumb.max' => 'L\'immagine non può superare i 2MB',
                'visibility.required' => 'Il campo visibilità è obbligatorio',
            ]
        );
        $formData = $request->all();

        if ($request->hasFile('thumb')) {
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }
            $img_path = Storage::disk('public')->put('apartment_images', $request->file('thumb'));
            $formData['thumb'] = $img_path;
        }
        $apartment->slug = Str::slug($formData['title'], '-');
        $apartment->update($formData);

        return redirect()->route('admin.apartments.show', $apartment->slug)->with('message', $apartment->title . ' successfully updated.');
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('apartment_deleted', 'Appartamento eliminato con successo!');
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
                'number_baths' => 'nullable|integer',
                'square_meters' => 'nullable|integer',
                'thumb' => 'required|image|max:256',
                'address' => 'required|string',
                'longitude' => 'required|numeric|between:-180,180',
                'latitude' => 'required|numeric|between:-90,90',
                'price' => 'required|numeric',
                'visibility' => 'required|boolean',
            ],
            [
                'title.required' => 'Il campo titolo è obbligatorio',
                'description.required' => 'Il campo descrizione è obbligatorio',
                'number_rooms.required' => 'Il campo numero di stanze è obbligatorio',
                'number_beds.required' => 'Il campo numero di letti è obbligatorio',
                'address.required' => 'Il campo indirizzo è obbligatorio',
                'longitude.required' => 'Il campo longitudine è obbligatorio',
                'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
                'latitude.required' => 'Il campo latitudine è obbligatorio',
                'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
                'price.required' => 'Il campo prezzo è obbligatorio',
                'thumb.required' => 'Il campo thumb è obbligatorio',
                'thumb.image' => 'Il file deve essere un immagine',
                'thumb.max' => 'L\'immagine non può superare i 2MB',
                'visibility.required' => 'Il campo visibilità è obbligatorio',
            ]
        )->validate();
    }
}
