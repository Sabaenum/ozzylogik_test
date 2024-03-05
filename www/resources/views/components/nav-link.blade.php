@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex flex-column color-menu-active-item text-decoration-none items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out active-menu-item-select'
            : 'inline-flex flex-column text-decoration-none items-center px-1 pt-1 text-sm font-medium leading-5 hover:text-gray-700 focus:outline-none menu-color transition duration-150 ease-in-out hover:color-custom-primary-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
