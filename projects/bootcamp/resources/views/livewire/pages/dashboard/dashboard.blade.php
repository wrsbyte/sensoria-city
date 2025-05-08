<?php
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'cards' => [
        'Chirps' => [
            'route' => route('chirps'),
            'description' => 'Chirp your thoughts and share them with the world.',
        ],
        'Profile' => [
            'route' => route('profile'),
            'description' => 'Manage your profile and account settings.',
        ],
    ],
]);

?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 overflow-hidden">
        <div class="max-w-2xl mx-auto px-2 sm:px-6 lg:px-8">
            <div
                class="
                    relative z-0 p-3 overflow-hidden

                    /* spin background layer */
                    before:content-['']
                    before:absolute
                    before:z-[-2]
                    before:size-[900px]
                    before:left-[-150px]
                    before:top-[-400px]
                    before:aspect-square
                    before:bg-purple-600
                    before:bg-no-repeat
                    before:bg-[conic-gradient(transparent,_rgba(168,239,255,1),_transparent_70%)]
                    before:animate-[spin_5s_linear_infinite]
                    before:ease-linear
                    before:duration-[4s]

                    /* over layer */
                    after:content-['']
                    after:absolute after:z-[-1]
                    after:left-[6px] after:top-[6px]
                    after:w-[calc(100%-12px)] after:h-[calc(100%-12px)]
                    after:bg-white
            ">
                <div class="p-6 text-gray-900">
                    {{ __('Everything you need in one place!') }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                @foreach ($cards as $title => $card)
                    <a href="{{ $card['route'] }}"
                        class="group hover:border-gray-400 hover:scale-105 transition-transform bg-white border border-gray-200 p-4"
                        wire:navigate>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-500" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.03132 8.91684L19.508 4.58337C19.8835 4.47824 20.2294 4.82421 20.1243 5.19967L15.7908 20.6763C15.6642 21.1284 15.0407 21.1726 14.8517 20.7429L11.6034 13.3605C11.5531 13.246 11.4616 13.1546 11.3471 13.1042L3.96477 9.85598C3.53507 9.66692 3.57926 9.04342 4.03132 8.91684Z"
                                        stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <span>{{ $title }}</span>
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $card['description'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
