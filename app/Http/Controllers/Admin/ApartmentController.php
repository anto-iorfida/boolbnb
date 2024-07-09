<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartment;
use App\Models\View;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApartmentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $apartments = Apartment::where('id_user', $userId)->get();
        $messages = Message::orderByDesc('created_at')->get();
        return view('admin.apartments.index', compact('apartments', 'messages'));
    }

    public function create(Service $services, Album $albums)
    {
        $services = Service::all();
        $albums = Album::all();
        return view('admin.apartments.create', compact('services', 'albums'));
    }

    public function store(Request $request)
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
        $newApartment->save();

        if ($request->has('services')) {
            $newApartment->services()->attach($validatedData['services']);
        }
        if ($request->has('albums')) {
            $newApartment->albums()->attach($validatedData['albums']);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $img_path = Storage::disk('public')->put('apartment_images', $file);
                $newApartment->albums()->create(['image' => $img_path]);
            }
        }

        session()->flash('apartments_create', true);
        return redirect()->route('admin.apartments.show', $newApartment->slug);
    }

    public function show(Apartment $apartment, Sponsor $sponsor, Album $album, Request $request)
    {
        $sponsor = Sponsor::all();
        $ipAddress = $request->ip();
        $currentDateTime = Carbon::now();
        $viewKey = 'viewed_apartment_' . $apartment->id;

        if (!$request->session()->has($viewKey)) {
            View::create([
                'apartment_id' => $apartment->id,
                'ip_address' => $ipAddress,
                'date_time' => $currentDateTime,
            ]);

            $apartment->views_count = $apartment->views_count + 1;
            $apartment->save();
            $request->session()->put($viewKey, true);
        }

        $apartment->load('albums', 'services');

        return view('admin.apartments.show', compact('apartment', 'sponsor'));
    }

    public function edit(Apartment $apartment, Album $album)
    {
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment', 'album', 'services'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        $validatedData = $request->validate(
            [
                'title' => [
                    'required',
                    'min:3',
                    'max:255',
                    Rule::unique('apartments')->ignore($apartment)
                ],
                'description' => 'required|string',
                'number_rooms' => 'required|integer|min:1',
                'number_beds' => 'required|integer|min:1',
                'number_baths' => 'required|integer|min:1',
                'square_meters' => 'required|integer|min:0',
                'thumb' => 'required|image|max:1700',
                'images' => 'required|array|min:1',
                'images.*' => 'image|max:1700',
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
                'number_baths.required' => 'Il campo numero di bagni è obbligatorio',
                'square_meters.required' => 'Il campo metri quadri è obbligatorio',
                'thumb.required' => 'Il campo immagine di copertina è obbligatorio',
                'thumb.image' => 'Il file deve essere un\'immagine',
                'thumb.max' => 'L\'immagine non può superare i 1700KB',
                'images.required' => 'Il campo immagini è obbligatorio',
                'images.array' => 'Le immagini devono essere un array',
                'images.min' => 'Seleziona almeno una immagine',
                'images.*.image' => 'Il file deve essere un\'immagine',
                'images.*.max' => 'Ogni immagine non può superare i 1700KB',
                'address.required' => 'Il campo indirizzo è obbligatorio',
                'longitude.required' => 'Il campo longitudine è obbligatorio',
                'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
                'latitude.required' => 'Il campo latitudine è obbligatorio',
                'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
                'visibility.required' => 'Il campo visibilità è obbligatorio',
                'services.required' => 'Seleziona almeno un servizio.',
                'services.array' => 'I servizi devono essere un array',
                'services.*.integer' => 'Il servizio deve essere un ID valido',
                'services.*.exists' => 'Il servizio selezionato non esiste',
            ]
        );

        $formData = $request->all();

        // Caricamento dell'immagine di copertina (thumb)
        if ($request->hasFile('thumb')) {
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }
            $imgPath = Storage::disk('public')->put('apartment_images', $request->file('thumb'));
            $formData['thumb'] = $imgPath;
        }

        // Caricamento delle altre immagini (images)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgPath = Storage::disk('public')->put('apartment_images', $image);
                $formData['images'][] = $imgPath;
            }
        }

        $apartment->slug = Str::slug($formData['title'], '-');
        $apartment->update($formData);

        // Aggiornamento dei servizi
        if ($request->has('services')) {
            $apartment->services()->sync($validatedData['services']);
        } else {
            $apartment->services()->detach();
        }

        session()->flash('apartments_edit', true);
        return redirect()->route('admin.apartments.show', $apartment->slug);
    }



    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        session()->flash('apartments_deleted', true);
        return redirect()->route('admin.apartments.index');
    }

    private function validation($data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'number_rooms' => 'required|integer|min:1',
            'number_beds' => 'required|integer|min:1',
            'number_baths' => 'required|integer|min:1',
            'square_meters' => 'required|integer|min:0',
            'thumb' => 'required|image|max:1700',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:1700',
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
            'number_baths.required' => 'Il campo numero di bagni è obbligatorio',
            'square_meters.required' => 'Il campo metri quadri è obbligatorio',
            'thumb.required' => 'Il campo immagine di copertina è obbligatorio',
            'thumb.image' => 'Il file deve essere un\'immagine',
            'thumb.max' => 'L\'immagine non può superare i 1700KB',
            'images.required' => 'Il campo immagini è obbligatorio',
            'images.array' => 'Le immagini devono essere un array',
            'images.min' => 'Seleziona almeno una immagine',
            'images.*.image' => 'Il file deve essere un\'immagine',
            'images.*.max' => 'Ogni immagine non può superare i 1700KB',
            'address.required' => 'Il campo indirizzo è obbligatorio',
            'longitude.required' => 'Il campo longitudine è obbligatorio',
            'longitude.between' => 'Il campo longitudine deve essere compreso tra -180 e 180',
            'latitude.required' => 'Il campo latitudine è obbligatorio',
            'latitude.between' => 'Il campo latitudine deve essere compreso tra -90 e 90',
            'visibility.required' => 'Il campo visibilità è obbligatorio',
            'services.required' => 'Seleziona almeno un servizio.',
            'services.array' => 'I servizi devono essere un array',
            'services.*.integer' => 'Il servizio deve essere un ID valido',
            'services.*.exists' => 'Il servizio selezionato non esiste',
        ])->validate();
    }

    // softdeletee
    public function indexDeleted(Apartment $apartments)
    {

        $apartments = Apartment::onlyTrashed()->get();
        return view('admin.garbage.index', compact('apartments'));
    }
    public function restore($id)
    {
        $apartment = Apartment::withTrashed()->findOrFail($id);
        $apartment->restore();
        session()->flash('apartments_restore', true);
        return redirect()->route('admin.apartments.index')->with('status', 'User restored successfully.');
    }
    public function forceDelete( $id)
    {
        $apartment = Apartment::withTrashed()->find($id);
        $apartment->forceDelete();
        session()->flash('apartments_forceDelete', true);
         return redirect()->back();
    }
    public function restoreAll() 
{
    Apartment::onlyTrashed()->restore();
    session()->flash('apartments_restoreAll', true);
    return redirect()->route('admin.apartments.index')->withSuccess(__('All users restored successfully.'));
}
}
