<?php

use App\Http\Controllers\Api\ApartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentControllerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// http://127.0.0.1:8000/api/apartments     ritorna tutti gli appartamenti
Route::get('/apartments', [ApartmentController::class, 'index']);

// http://127.0.0.1:8000/api/apartments/slug    ritorna il singolo appartamento
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);

// http://127.0.0.1:8000/api/apartment/search  + params = latitude + longitude + radius   ricerca appartamenti per coordinate e raggio
Route::get('/apartment/search', [ApartmentController::class, 'searchApartments']);

// http://127.0.0.1:8000/api/sponsored-apartments
Route::get('/sponsored-apartments', [ApartmentController::class, 'fetchSponsoredApartments']);

// rotta per la validazione
Route::post('/validate-apartment', [ApartmentController::class, 'validateApartment'])->name('api.validate.apartment');

// ROTTA PER MESSAGGI
Route::post('/apartment/messages', [ApartmentController::class, 'store'])->name('apartment.messages.store');

