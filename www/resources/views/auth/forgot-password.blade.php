<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Glömt ditt lösenord? Fyll i din e-postadress, och vi kommer att skicka dig en länk för återställning av lösenordet via e-post. Länken gör det möjligt för dig att välja ett nytt lösenord.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-postadress:')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Begär återställning av lösenord') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
