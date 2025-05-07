@php
    $class =
        'text-sm h-full group relative z-[1] inline-flex cursor-pointer transition-colors text-body-sm text-text-primary pl-3 pr-10 py-3';
@endphp

<div>
    <a {{ $attributes->merge(['class' => $class]) }}>
        <span class="relative my-auto">
            <span
                class="absolute z-[0] origin-right scale-x-[0] bg-purple-200 transition-transform ease-global motion-safe:duration-300 motion-reduce:duration-0 dark:bg-purple-600 lg:group-hover:origin-left lg:group-focus-visible:origin-left -left-[7px] -top-[7px] h-[calc(100%+14px)] w-[calc(100%+14px)] lg:group-hover:scale-x-[1] lg:group-focus-visible:scale-x-[1]">
            </span>
            <span class="relative h-full z-[1] px-[2px]">
                {{ $slot }}
            </span>
        </span>
        <span
            class="ease absolute bottom-0 left-0 h-[3px] w-full origin-bottom bg-gray-900 transition-all motion-safe:duration-300 motion-reduce:duration-0 dark:bg-gray-100 scale-y-[0]">
        </span>
    </a>
</div>
