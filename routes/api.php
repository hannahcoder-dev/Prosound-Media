<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Public API endpoints
    Route::get('services', function () {
        return App\Models\Service::active()->with('category')->orderBy('sort_order')->get();
    });

    Route::get('portfolio', function () {
        return App\Models\Portfolio::public()->with('category')->latest()->paginate(12);
    });

    Route::get('blog', function () {
        return App\Models\BlogPost::published()->with('author', 'category')->latest('published_at')->paginate(12);
    });

    // Authenticated API endpoints
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', fn() => request()->user()->load('roles'));

        Route::get('bookings', function () {
            return request()->user()->bookings()->with('service')->latest()->paginate(10);
        });

        Route::get('payments', function () {
            return request()->user()->payments()->with('booking')->latest()->paginate(10);
        });
    });
});
