<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 position-relative">
    <!-- Primary Navigation Menu -->
    @guest
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
            </div>
        </div>
    @else
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <div class="flex justify-between">

                <div class="flex">
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Logo -->

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <i class="material-icons nav-icon">workspaces</i>
                            <div class="fw-bold fw-weight">{{ __('Dashboard') }}</div>
                        </x-nav-link>
                    </div>
                </div>
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 leading-4 font-medium rounded-md bg-black transition ease-in-out duration-150 text-uppercase profile">
                                <div class="fw-bold fw-weight text-light">{{ substr(Auth::user()->name, 0, 2)}}</div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden position-fixed mobile-nav-menu responsive-menu">
            <div class="pt-2 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="material-icons nav-icon">workspaces</i>
                    <div class="fw-bold fw-weight ms-3">{{ __('Dashboard') }}</div>
                </x-responsive-nav-link>
            </div>
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1">
                <div>
                    <div class="space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            <div
                                class="inline-flex items-center leading-4 font-medium rounded-md bg-black transition ease-in-out duration-150 text-uppercase profile">
                                    <div class="fw-bold fw-weight text-light">{{ substr(Auth::user()->name, 0, 2)}}</div>
                            </div>
                        </x-responsive-nav-link>
                    </div>
                </div>

                <div class="mt-3 space-y-1 profile-links">

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Logga ut') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @endif
</nav>
