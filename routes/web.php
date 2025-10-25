<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
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
    Route::get('records', function (){
        $records = [                            // Define an array of records
            'Queen - Greatest Hits',
            'The Rolling Stones - Sticky Fingers',
            'The Beatles - Abbey Road'
        ];

//    return view('admin.records.index', [
//        'records' => $records  // Pass the $records array with the key 'records'
//    ]);

        return view('admin.records.index', compact('records'));
    })->name('records');
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
