@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block cursor-pointer p-2 bg-gray-700 rounded-md mt-1 transition duration-150 ease-in-out'
                : 'block cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1 transition duration-150 ease-in-out';
    $open = ($active ?? false)
            ? 'open = true'
            : '';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'x-bind:open' => $open]) }}>
    {{ $slot }}
</a>
