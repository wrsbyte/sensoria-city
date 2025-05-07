@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-4 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0 -left-[0.1rem]',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative h-full flex items-center" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div class="z-[1] bg-transparent h-full" @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 -bottom-[7.5rem] {{ $width }} {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="px-3 border border-gray-200 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
