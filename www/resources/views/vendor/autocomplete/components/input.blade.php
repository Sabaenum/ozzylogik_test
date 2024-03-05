<input
    type="text"
    autocomplete="off"
    {{ $attributes->class('form-control search-width search-input px-4 p-2 placeholder-cool-gray-400 focus:outline-none focus:border-blue-400 disabled:bg-cool-gray-100') }}
    x-bind:class="[selected ? 'pr-9' : 'pr-4']"
    x-bind:disabled="selected" />
