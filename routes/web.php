<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use App\Livewire\Demo;   // Import the Livewire component
use Laravel\Fortify\Features;

//Route::get('/', function () {
//    return view('welcome');
//    return 'The Vinyl Shop';
//})->name('home');

Route::view('/', 'home')->name('home');

//Route::get('contact', function () {
//    return view('contact');
//})->name('contact');

Route::view('contact', 'contact')->name('contact');     // Use the single-line view notation

Route::view('playground', 'playground')->name('playground');


Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('records', Demo::class)->name('admin.records');
    Route::view('download_covers', 'admin.download_covers')->name('download-covers')->name('admin.covers');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
