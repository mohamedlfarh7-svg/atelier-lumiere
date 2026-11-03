<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/boules-de-neige', [ShopController::class, 'boulesDeNeige'])
    ->name('category.boules');

Route::get('/nounours', [ShopController::class, 'nounours'])
    ->name('category.nounours');

Route::get('/parfums', [ShopController::class, 'parfums'])
    ->name('category.parfums');

Route::get('/cadeaux', [ShopController::class, 'cadeaux'])
    ->name('category.cadeaux');

Route::post('/order/submit', [ShopController::class, 'storeOrder'])
    ->name('order.submit');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::post('/order/{id}/accept', [AdminController::class, 'acceptOrder'])
            ->name('order.accept');

        Route::post('/order/{id}/refuse', [AdminController::class, 'refuseOrder'])
            ->name('order.refuse');

        Route::get('/{category}', [AdminController::class, 'index'])
            ->name('index');

        Route::post('/{category}', [AdminController::class, 'store'])
            ->name('store');

        Route::put('/{category}/{id}', [AdminController::class, 'update'])
            ->name('update');

        Route::delete('/{category}/{id}', [AdminController::class, 'destroy'])
            ->name('destroy');
    });