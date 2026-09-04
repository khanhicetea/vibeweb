<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\PageContent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home', [
        'collections' => PageContent::collectionsForPage('home', [
            'hero_points',
            'hero_stats',
            'services',
            'steps',
            'stats',
            'testimonials',
        ]),
    ]);
})->name('home');

Route::get('/recruit', function () {
    return view('frontend.recruit', [
        'collections' => PageContent::collectionsForPage('recruit', [
            'hero_stats',
            'values',
            'perks',
            'roles',
            'steps',
        ]),
    ]);
})->name('recruit');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/images', [ImageUploadController::class, 'store'])->name('images.store');
        Route::resource('page-content', PageContentController::class)
            ->only(['index', 'edit', 'update'])
            ->parameters(['page-content' => 'pageContent']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/settings', [WebsiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [WebsiteSettingController::class, 'update'])->name('settings.update');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
