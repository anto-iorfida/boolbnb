<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services')->paginate(3);

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
}
