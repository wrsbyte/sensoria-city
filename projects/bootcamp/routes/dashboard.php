<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('profile', 'pages.profile.profile')
        ->name('profile');

    Volt::route('dashboard', 'pages.dashboard.dashboard')
        ->name('dashboard');

    Volt::route('chirps', 'pages.chirps.chirps')
        ->name('chirps');
});
