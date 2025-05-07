<?php

use function Livewire\Volt\{rules, state};

state(['message' => '']);
rules(['message' => 'required|string|max:255']);

$store = function () {
    $validated = $this->validate();
    auth()->user()->chirps()->create($validated);
    $this->message = '';
    $this->dispatch('chirp-created');
};

?>

<div>
    <form wire:submit="store">
        <textarea
            wire:model="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 shadow-sm"
        ></textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button type="submit" class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>
