@props(['active', 'variant'])

@php
    $variant = $variant ?? 'default';
    $active = $active ?? false;

    $baseClases = 'relative h-full flex items-center';
    $activeClasses = 'font-bold border-b-2 border-black';

    if ($active) {
        $baseClases .= ' ' . $activeClasses;
    }
@endphp

<div class="{{ $baseClases }}">
    @if ($variant === 'default')
        <a {{ $attributes }}
            class="h-full group relative z-[1] inline-flex cursor-pointer transition-colors text-body-sm text-text-primary px-3 py-3">
            <span class="relative my-auto">
                <span
                    class="absolute z-[0] origin-right scale-x-[0] bg-purple-200 transition-transform ease-global motion-safe:duration-300 motion-reduce:duration-0 dark:bg-purple-600 md:group-hover:origin-left md:group-focus-visible:origin-left -left-[7px] -top-[7px] h-[calc(100%+14px)] w-[calc(100%+14px)] md:group-hover:scale-x-[1] md:group-focus-visible:scale-x-[1]">
                </span>
                <span class="relative h-full z-[1] px-[2px]">
                    {{ $slot }}
                </span>
            </span>
            <span
                class="ease absolute bottom-0 left-0 h-[3px] w-full origin-bottom bg-gray-900 transition-all motion-safe:duration-300 motion-reduce:duration-0 dark:bg-gray-100 scale-y-[0]">
            </span>
        </a>
    @elseif($variant === 'complete')
        <a class="h-full ease group relative z-[1] cursor-pointer bg-gray-900 px-10 transition-colors motion-safe:duration-300 motion-reduce:duration-0 dark:bg-gray-100 md:px-16 text-gray-100 dark:text-gray-900 dark:active:text-gray-100 md:dark:hover:text-gray-100"
            {{ $attributes }}>
            <div
                class="absolute inset-0 z-[0] h-full w-full scale-x-[0] bg-purple-500 opacity-0 transition-opacity ease-global motion-safe:duration-300 motion-reduce:duration-0 md:origin-right md:transition-transform md:group-hover:origin-left md:group-focus-visible:origin-left md:motion-safe:duration-300 md:motion-reduce:duration-0 group-active:scale-x-[1] group-active:opacity-100 md:opacity-100 md:group-hover:scale-x-[1] md:group-focus-visible:scale-x-[1]">
            </div>
            <span class="relative z-[1] inline-block h-full flex items-center">
                {{ $slot }}
            </span>
        </a>
    @endif
</div>
