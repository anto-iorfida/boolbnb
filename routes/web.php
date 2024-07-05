<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::delete('/messages/{id}', [MessageController::class, 'delete'])->name('messages.delete');
        Route::delete('/messages', [MessageController::class, 'deleteAll'])->name('messages.deleteAll');
        Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);
        Route::get('/garbage',[ApartmentController::class, 'indexDeleted'])->name('garbage');
        Route::group(['prefix' => 'garbage'], function() {
            Route::post('/{apartment}/restore', [ApartmentController::class, 'restore'])->name('garbages.restore');
//             Route::delete('/{apartment}/force', [ApartmentController::class, 'forceDelete'])->name('garbages.forcedelete');
            Route::post('/restore-all', [ApartmentController::class, 'restoreAll'])->name('garbages.restoreall');
        });
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';