<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/cv', [PortfolioController::class, 'downloadCv'])->name('cv.download');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('contact.store');

Route::get('/sitemap.xml', function () {
    return response()
        ->view('sitemap', ['url' => url('/')])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    return response(
        "User-agent: *\nAllow: /\nSitemap: ".url('/sitemap.xml')."\n",
        200,
        ['Content-Type' => 'text/plain'],
    );
})->name('robots');
