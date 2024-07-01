<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();

        return response()->json([
            'success' => true,
            'result' => $apartments
        ]);
    }

    public function show($slug)
    {
        $apartment = Apartment::where('slug', '=', $slug)->first();//aggiungere relazione

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
}
