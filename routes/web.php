<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return Inertia::render('Home', [
        'user' => auth()->user()
    ]);
});

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contacts', ContactController::class);
    Route::resource('user', UserController::class);
});