<?php

use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PeriodeScolaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::resource('organisations', OrganisationController::class);

Route::resource('sites', SiteController::class);

Route::resource('annees-scolaires', AnneeScolaireController::class)
    ->parameters([
        'annees-scolaires' => 'anneeScolaire',
    ]);


Route::resource(
    'periodes-scolaires',
    PeriodeScolaireController::class
)->parameters([
    'periodes-scolaires' => 'periodeScolaire',
]);
