@php
    $class =
        'h-full ease group relative z-[1] cursor-pointer bg-gray-900 px-10 transition-colors motion-safe:duration-300 motion-reduce:duration-0 dark:bg-gray-100 md:px-16 text-gray-100 dark:text-gray-900 dark:active:text-gray-100 md:dark:hover:text-gray-100';
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => $class]) }}>
    <div
        class="absolute inset-0 z-[0] h-full w-full scale-x-[0] bg-purple-500 opacity-0 transition-opacity ease-global motion-safe:duration-300 motion-reduce:duration-0 md:origin-right md:transition-transform md:group-hover:origin-left md:group-focus-visible:origin-left md:motion-safe:duration-300 md:motion-reduce:duration-0 group-active:scale-x-[1] group-active:opacity-100 md:opacity-100 md:group-hover:scale-x-[1] md:group-focus-visible:scale-x-[1]">
    </div>
    <span class="relative z-[1] inline-block h-full flex items-center py-4">
        {{ $slot }}
    </span>
</button>
