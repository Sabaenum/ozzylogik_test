<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn profile-btn btn-width btn-sm small-btn background-custom-primary-400 text-white px-4']) }}>
    {{ $slot }}
</button>
