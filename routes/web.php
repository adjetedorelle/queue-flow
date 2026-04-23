<?php

use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
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
})->name('Acceuil');

Route::get('/contactez-nous', function () {
    return view('contact');
})->name('contact');

Route::get('connexion_client', function () {
    return view('client');
})->name('connexion_client');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('ajouter_entreprise', [EntrepriseController::class, 'create'])
->middleware(['auth', 'verified'])->name('ajout_entreprise');

Route::post('enregistrer_entreprise',[EntrepriseController::class,'enregistrer_entreprise'])
->middleware(['auth', 'verified'])->name('enregistrer_entreprise');

Route::get('liste_entreprises', [EntrepriseController::class, 'liste'])
->middleware(['auth', 'verified'])->name('liste_entreprises');

Route::get('formulaire_entreprise/{id_entreprise}',[EntrepriseController::class, 'modifier'])
->middleware(['auth', 'verified'])->name('formulaire_entreprise');

Route::put('modifier_entreprise/{id_entreprise}',[EntrepriseController::class, 'mettreAjour'])
->middleware(['auth', 'verified'])->name('modifier_entreprise');

Route::get('entreprises_disponibles',[EntrepriseController::class, 'afficher'])
->name('entreprises_disponibles');

Route::delete('supprimer_entreprise/{id_entreprise}',[EntrepriseController::class, 'supprimer'])
->middleware(['auth', 'verified'])->name('supprimer_entreprises');

Route::patch('modifier_statut/{id_entreprise}',[EntrepriseController::class, 'toggleStatut'])
->middleware(['auth', 'verified'])->name('modifier_statut_entreprise');

Route::get('ajouter_service',[ServiceController::class, 'ajoutService'])
->middleware(['auth', 'verified'])->name('service_ajout');

Route::post('enregistrer_service',[ServiceController::class,'enregistrerService'])
->middleware(['auth', 'verified'])->name('service_enregistrer');

Route::get('liste_service',[ServiceController::class,'listes'])
->middleware(['auth', 'verified'])->name('service_liste');

Route::get('formulaire_modification/{id_service}',[ServiceController::class,'modifier'])
->middleware(['auth', 'verified'])->name('formulaire_service');

Route::put('modifier_service/{id_service}',[ServiceController::class,'mettreAjour'])
->middleware(['auth', 'verified'])->name('modifier_service');

Route::delete('supprimer_service/{id_service}',[ServiceController::class,'supprimer'])
->middleware(['auth', 'verified'])->name('supprimer_service');

 Route::get('services_disponibles/{id_entreprise}',[ServiceController::class, 'servicedispo'])
->middleware(['auth', 'verified'])->name('services_disponibles');

Route::get('ajouter_personnel',[PersonnelController::class, 'ajoutPersonnel'])
->middleware(['auth', 'verified'])->name('ajouter_personnel');

Route::post('enregistrer_personnel',[PersonnelController::class, 'enregistrerPersonnel'])
->middleware(['auth', 'verified'])->name('enregistrer_personnel');

Route::get('liste_personnel',[PersonnelController::class, 'listePersonnel'])
->middleware(['auth', 'verified'])->name('liste_personnel');

Route::get('personnel_formulaire/{id_user}',[PersonnelController::class, 'modifier'])
->middleware(['auth', 'verified'])->name('personnel_formulaire');

Route::put('modifier_personnel/{id_user}',[PersonnelController::class, 'mettreAjour'])
->middleware(['auth', 'verified'])->name('modifier_personnel');

Route::delete('supprimer_personnel/{id_user}',[PersonnelController::class,'supprimer'])
->middleware(['auth', 'verified'])->name('supprimer_personnel');

 Route::get('files_disponibles',[FileController::class, 'filesActives'])
->middleware(['auth', 'verified'])->name('files_disponibles');

Route::get('tickets_disponibles',[TicketController::class, 'ticketsdispo'])
->middleware(['auth', 'verified'])->name('tickets_disponibles');

Route::get('tickets_en_attente/{id_service}',[TicketController::class, 'ticketsEnAttente'])
->middleware(['auth', 'verified'])->name('tickets_en_attente');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
