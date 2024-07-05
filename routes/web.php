<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('families')->group(function () {
    Route::get('/', [FamilyController::class, 'index'])->name('families.index');
    Route::get('/create', [FamilyController::class, 'create'])->name('families.create');
    Route::post('/store', [FamilyController::class, 'store'])->name('families.store');
    Route::get('/{family}', [FamilyController::class, 'show'])->name('families.show');
    Route::delete('/{family}', [FamilyController::class, 'destroy'])->name('families.destroy');

    Route::get('families/{family}/edit', [FamilyController::class, 'edit'])->name('families.edit');
    Route::put('families/{family}', [FamilyController::class, 'update'])->name('families.update');
    
});

Route::prefix('family-members')->group(function () {
    Route::get('/create/{family}', [FamilyMemberController::class, 'create'])->name('family_members.create');
    Route::post('/store', [FamilyMemberController::class, 'store'])->name('family_members.store');

    Route::get('/{family_member}/edit', [FamilyMemberController::class, 'edit'])->name('family_members.edit');
    Route::put('/{family_member}', [FamilyMemberController::class, 'update'])->name('family_members.update');


});
Route::get('/get-cities/{state_id}', [FamilyController::class, 'getCities'])->name('get.cities');
Route::resource('family_members', FamilyMemberController::class)->only(['destroy']);