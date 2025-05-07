<?php
use function Livewire\Volt\layout;

layout('layouts.app');

?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <livewire:components.chirps.create />
        <livewire:components.chirps.list />
    </div>
</div>
