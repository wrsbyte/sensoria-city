<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<header class="bg-white border-b border-gray-200">
    <nav x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center pl-4 sm:pl-6 lg:pl-8">
                        <a href="{{ route('dashboard') }}" wire:navigate>
                            <x-application-logo
                                class="block h-9 w-auto fill-current text-gray-800 hover:scale-105 transition-all" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                        @if (auth()->user())
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                                {{ __('Home') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('chirps')" :active="request()->routeIs('chirps')" wire:navigate>
                                {{ __('Chirps') }}
                            </x-nav-link>
                        @endif

                        @if (auth()->guest())
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                                {{ __('Home') }}
                            </x-nav-link>
                        @endif
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden md:flex md:items-center md:ms-6 gap-3">
                    @if (auth()->user())
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-primary-button>
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                        x-on:profile-updated.window="name = $event.detail.name">
                                    </div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </x-primary-button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    @endif

                    @if (auth()->guest())
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                            {{ __('Log In') }}
                        </x-nav-link>
                        <x-nav-link variant="complete" :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                            {{ __('Register') }}
                        </x-nav-link>
                    @endif
                </div>

                <!-- Hamburger -->
                <div class="mr-2 flex items-center md:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @if (auth()->user())
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('chirps')" :active="request()->routeIs('chirps')" wire:navigate>
                        {{ __('Chirps') }}
                    </x-responsive-nav-link>
                @endif

                @if (auth()->guest())
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                @if (auth()->user())
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                            x-on:profile-updated.window="name = $event.detail.name"></div>
                        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>


                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-responsive-nav-link>
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </button>
                    </div>
                @endif

                @if (auth()->guest())
                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('login')" wire:navigate>
                            {{ __('Log In') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')" wire:navigate>
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
