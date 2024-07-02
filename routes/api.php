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
Route::get('apartments/{slug}', [ApartmentController::class, 'show']);

// rotta per la validazione
Route::post('/validate-apartment', [ApartmentController::class, 'validateApartment'])->name('api.validate.apartment');
