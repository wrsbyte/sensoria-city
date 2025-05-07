<?php

use function Livewire\Volt\{mount, rules, state};

state(['chirp', 'message']);

rules(['message' => 'required|string|max:255']);

mount(fn () => $this->message = $this->chirp->message);

$update = function () {
    $this->authorize('update', $this->chirp);

    $validated = $this->validate();

    $this->chirp->update($validated);

    $this->dispatch('chirp-updated');
};

$cancel = fn () => $this->dispatch('chirp-edit-canceled');

?>

<div>
    <form wire:submit="update">
        <textarea
            wire:model="message"
            class="block w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
        ></textarea>

        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button type="submit" class="mt-4">{{ __('Save') }}</x-primary-button>
        <button class="mt-4 px-3 hover:font-semibold transition-all" wire:click.prevent="cancel">Cancel</button>
    </form>
</div>
