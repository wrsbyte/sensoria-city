<?php

use function Livewire\Volt\{on, state};
use App\Models\Chirp;

$getChirps = function () {
    $values = Chirp::with('user')->latest()->get();
    $this->chirps = $values;
    return $values;
};

$edit = function (Chirp $chirp) {
    $this->editing = $chirp;
    $this->getChirps();
};

$disableEditing = function () {
    $this->editing = null;

    return $this->getChirps();
};

$delete = function (Chirp $chirp) {
    $this->authorize('delete', $chirp);

    $chirp->delete();

    $this->getChirps();
};

state([
    'chirps' => $getChirps,
    'editing' => null,
]);

on([
    'chirp-created' => $getChirps,
    'chirp-updated' => $disableEditing,
    'chirp-edit-canceled' => $disableEditing,
]);

?>
<div class="mt-6 bg-white border border-gray-200 divide-y">
    @foreach ($chirps as $chirp)
        <div class="p-6 flex space-x-2" wire:key="{{ $chirp->id }}">
            <svg class="h-5 w-5 stroke-gray-500 -scale-x-100" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 20.2895V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V15C21 16.1046 20.1046 17 19 17H7.96125C7.35368 17 6.77906 17.2762 6.39951 17.7506L4.06852 20.6643C3.71421 21.1072 3 20.8567 3 20.2895Z"
                    stroke-width="1.5">
                </path>
            </svg>

            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-800">{{ $chirp->user->name }}</span>
                        <small
                            class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($chirp->created_at->eq($chirp->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>

                    @if ($chirp->user->is(auth()->user()))
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="edit({{ $chirp->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="delete({{ $chirp->id }})"
                                    wire:confirm="Are you sure to delete this chirp?">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>

                @if ($chirp->is($editing))
                    <livewire:components.chirps.edit :chirp="$chirp" :key="$chirp->id" />
                @else
                    <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
