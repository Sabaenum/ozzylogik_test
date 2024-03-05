<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn profile-btn btn-width btn-sm btn-danger bg-red-600 small-btn text-white px-4 hover:bg-red-500 active:bg-red-700']) }}>
    {{ $slot }}
</button>
