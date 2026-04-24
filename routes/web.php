<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;

// ══════════════════════════════════════════
// PUBLIC ROUTES
// ══════════════════════════════════════════
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ══════════════════════════════════════════
// PROFILE ROUTES (Breeze)
// ══════════════════════════════════════════
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ══════════════════════════════════════════
// ADMIN ROUTES
// ══════════════════════════════════════════
Route::middleware(['auth', 'verified', 'role:super_admin,admin,staff'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except('show');
        Route::patch('users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');

        // Services
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->except('show');

        // Bookings
        Route::get('bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
        Route::patch('bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.update-status');
        Route::post('bookings/{booking}/comment', [App\Http\Controllers\Admin\BookingController::class, 'addComment'])->name('bookings.comment');
        Route::patch('bookings/{booking}/notes', [App\Http\Controllers\Admin\BookingController::class, 'updateNotes'])->name('bookings.notes');
        Route::delete('bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('bookings.destroy');

        // Portfolio
        Route::resource('portfolios', App\Http\Controllers\Admin\PortfolioController::class)->except('show');

        // Blog
        Route::resource('blog', App\Http\Controllers\Admin\BlogController::class)->except('show')->parameters(['blog' => 'post']);

        // Messages
        Route::get('messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
        Route::post('messages/{message}/reply', [App\Http\Controllers\Admin\MessageController::class, 'reply'])->name('messages.reply');
        Route::delete('messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');

        // Testimonials
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class)->except('show');

        // Payments
        Route::get('payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/{payment}', [App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('payments.show');

        // Invoices
        Route::get('invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('invoices/create/{booking}', [App\Http\Controllers\Admin\InvoiceController::class, 'create'])->name('invoices.create');
        Route::post('invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'store'])->name('invoices.store');
        Route::get('invoices/{invoice}', [App\Http\Controllers\Admin\InvoiceController::class, 'show'])->name('invoices.show');
        Route::get('invoices/{invoice}/pdf', [App\Http\Controllers\Admin\InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
        Route::patch('invoices/{invoice}/mark-paid', [App\Http\Controllers\Admin\InvoiceController::class, 'markPaid'])->name('invoices.mark-paid');
    });

// ══════════════════════════════════════════
// CLIENT ROUTES
// ══════════════════════════════════════════
Route::middleware(['auth', 'verified'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');

        // Bookings
        Route::get('bookings', [App\Http\Controllers\Client\BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/create', [App\Http\Controllers\Client\BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [App\Http\Controllers\Client\BookingController::class, 'store'])->name('bookings.store');
        Route::get('bookings/{booking}', [App\Http\Controllers\Client\BookingController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{booking}/comment', [App\Http\Controllers\Client\BookingController::class, 'addComment'])->name('bookings.comment');

        // Files
        Route::post('bookings/{booking}/upload', [App\Http\Controllers\Client\ProjectFileController::class, 'upload'])->name('files.upload');
        Route::get('files/{file}/download', [App\Http\Controllers\Client\ProjectFileController::class, 'download'])->name('files.download');

        // Payments
        Route::get('payments', [App\Http\Controllers\Client\PaymentController::class, 'index'])->name('payments.index');
        Route::post('payments/paystack/{invoice}', [App\Http\Controllers\Client\PaymentController::class, 'initializePaystack'])->name('payments.paystack');
        Route::get('payments/callback/{gateway}', [App\Http\Controllers\Client\PaymentController::class, 'callback'])->name('payments.callback');
    });

// Auth routes
require __DIR__.'/auth.php';
