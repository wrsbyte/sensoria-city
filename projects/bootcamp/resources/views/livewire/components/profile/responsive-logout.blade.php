<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<button wire:click="logout" class="w-full text-start">
    <x-responsive-nav-link>
        {{ __('Log Out') }}
    </x-responsive-nav-link>
</button>
