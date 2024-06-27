<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartment;
use Illuminate\Support\Str;
class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('admin.apartments.create');
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $validatedData = $this->validation($request->all());
        $slug = Str::slug($validatedData['title'], '-');

        $validatedData['slug'] = $slug;

        // Use validated data instead of request data
        $formData = $validatedData;

        if ($request->hasFile('thumb')) {
            $img_path = Storage::disk('public')->put('apartment_images', $request->file('thumb'));
            $formData['thumb'] = $img_path;
        }

        $newApartment = new Apartment();
        $newApartment->fill($formData);
        $newApartment->save();

        return redirect()->route('admin.apartments.show', $newApartment->id)->with('message', $newApartment->title . ' successfully created.');
=======
        //
        $formData= $request->all();
        $newApartment= new Apartment();
        $newApartment->fill($formData);
        $newApartment->slug = Str::slug($newApartment->title, '-');
        $newApartment->save();
        return redirect()->route('admin.apartments.show',['apartments'=>$newApartment->slug]);
>>>>>>> 3e571e4076ae58c8dc5ff4b04ebbf984628c801d
    }

    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('admin.apartments.edit', compact('apartment'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validation($request->all());
        $slug = Str::slug($validatedData['title'], '-');
        $slug = $this->generateUniqueSlug($slug, $id);

        $validatedData['slug'] = $slug;

        $apartment = Apartment::findOrFail($id);
        $formData = $validatedData;

        if ($request->hasFile('thumb')) {
            if ($apartment->thumb) {
                Storage::disk('public')->delete($apartment->thumb);
            }

            $img_path = Storage::disk('public')->put('apartment_images', $request->file('thumb'));
            $formData['thumb'] = $img_path;
        }

        $apartment->update($formData);

        return redirect()->route('admin.apartments.show', $apartment->id)->with('message', $apartment->title . ' successfully updated.');
    }

    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();
        
        return redirect()->route('admin.apartments.index')->with('apartment_deleted', 'Appartamento eliminato con successo!');
    }
    
    private function validation($data)
    {
        return Validator::make(
            $data,
            [
                'id_user' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'number_rooms' => 'required|integer',
                'number_beds' => 'required|integer',
                'number_baths' => 'nullable|integer',
                'square_meters' => 'nullable|integer',
                'thumb' => 'nullable|max:2048',
                'address' => 'required|string',
                'longitude' => 'required|numeric|between:-180,180',
                'latitude' => 'required|numeric|between:-90,90',
                'price' => 'required|numeric',
                'visibility' => 'required|boolean',
            ],
            [
                'id_user.required' => 'Il campo ID utente è obbligatorio',
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
                'visibility.required' => 'Il campo visibilità è obbligatorio',
                'thumb.image' => 'Il file deve essere un\'immagine',
                'thumb.max' => 'L\'immagine non può superare i 2MB',
            ]
        )->validate();
    }
}
