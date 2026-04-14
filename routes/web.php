<?php

use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/contactez-nous', function () {
    return view('contact');
})->name('contact');

Route::get('/client', function () {
    return view('client');
})->name('client');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('ajouter_entreprise', [EntrepriseController::class, 'create'])
->middleware(['auth', 'verified'])->name('ajout_entreprise');

Route::post('enregistrer_entreprise',[EntrepriseController::class,'enregistrer_entreprise'])
->middleware(['auth', 'verified'])->name('enregistrer_entreprise');

Route::get('liste_entreprises', [EntrepriseController::class, 'liste'])
->middleware(['auth', 'verified'])->name('liste_entreprises');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
