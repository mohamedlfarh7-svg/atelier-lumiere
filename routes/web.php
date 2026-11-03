<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

// ==========================================
// ROUTES PUBLIQUES & CLIENT
// ==========================================

// Page d'accueil
Route::get('/', [ShopController::class, 'index'])->name('home');

// Pages des catégories et filtres
Route::get('/boules-de-neige', [ShopController::class, 'boulesDeNeige'])->name('category.boules');
Route::get('/nounours', [ShopController::class, 'nounours'])->name('category.nounours');
Route::get('/parfums', [ShopController::class, 'parfums'])->name('category.parfums');
Route::get('/cadeaux', [ShopController::class, 'cadeaux'])->name('category.cadeaux');

// Soumettre une commande
Route::post('/order/submit', [ShopController::class, 'storeOrder'])->name('order.submit');


// ==========================================
// ROUTES AUTHENTIFICATION ADMIN
// ==========================================

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ==========================================
// ROUTES ADMINISTRATION (Protégées par Middleware Auth)
// ==========================================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Liste des produits par catégorie
    Route::get('/{category}', [AdminController::class, 'index'])->name('index');

    // Enregistrer un nouveau produit
    Route::post('/{category}', [AdminController::class, 'store'])->name('store');

    // Modifier un produit existant
    // Modifier un produit existant (avec /update)
Route::put('/{category}/{id}/update', [AdminController::class, 'update'])->name('update');  

    // Supprimer un produit
    Route::delete('/{category}/{id}', [AdminController::class, 'destroy'])->name('destroy');

    // ==========================================
    // ROUTES POUR LES COMMANDES (Notifications)
    // ==========================================
    Route::post('/order/{id}/accept', [AdminController::class, 'acceptOrder'])->name('order.accept');
    Route::post('/order/{id}/refuse', [AdminController::class, 'refuseOrder'])->name('order.refuse');
});