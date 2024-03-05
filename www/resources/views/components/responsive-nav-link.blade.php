@props(['active'])

@php
$classes = ($active ?? false)
            ? 'd-flex text-decoration-none active-menu-item-select w-full ps-4 pr-4 py-3 text-left text-base font-medium focus:outline-none transition duration-150 ease-in-out flex-row align-items-center justify-content-start text-decoration-none'
            : 'd-flex text-decoration-none w-full ps-4 pr-4 py-3 text-left text-base font-medium hover:text-gray-800 transition duration-150 menu-color ease-in-out flex-row align-items-center justify-content-start text-decoration-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
