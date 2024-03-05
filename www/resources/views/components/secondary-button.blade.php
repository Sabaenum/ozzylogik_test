<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn profile-btn btn-width cancel-btn btn-sm menu small-btn px-4']) }}>
    {{ $slot }}
</button>
