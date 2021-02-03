<nav x-data="{ open: false }" class="greenAmasoBg">
<!-- Primary Navigation Menu -->
<div class="flex flex-row h-20">
    <!-- Logo -->
    <div class="flex items-center ml-48">
        <a href="{{ route('home') }}" class="m-auto">
            <x-application-logo />
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex flex-row w-1/3 items-center ">
        @can('isAdmin')
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
            <x-nav-link :href="route('adminDash')" :active="request()->routeIs('adminDash')">
                {{ __('Panel de administrador') }}
            </x-nav-link>
        </div>
        @endcan
        @guest
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link  :href="route('register')" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link  :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-nav-link>
        </div>
        @endguest
        @can('isArtisan')
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                {{ __('Mi perfil') }}
            </x-nav-link>
        </div>
        @endcan
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('artisans')" :active="request()->routeIs('artisans')">
                {{ __('Artesanos') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                {{ __('Mi compra') }}
            </x-nav-link>
        </div>
        @can('isAuth')
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('joinArtisan')" :active="request()->routeIs('joinArtisan')">
                {{ __('Eres artesano? Unete!') }}
            </x-nav-link>
        </div>
    </div>
    @endcan
    @auth
    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown >
            <x-slot name="trigger">
                <button class="flex justify-end items-center text-sm font-medium beigeLight hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-dropdown-link>
                </form>
                @can('isAdmin')    
                <form method="GET" action="{{ route('adminDash') }}">
                    @csrf
                    <x-dropdown-link :href="route('adminDash')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Panel administrador') }}
                    </x-dropdown-link>
                </form>
                @endcan
            </x-slot>
        </x-dropdown>
    </div>
    @endauth
</div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md beigeLight hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('adminDash')" :active="request()->routeIs('adminDash')">
                {{ __('Administrador') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                {{ __('Mi perfil') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('artisans')" :active="request()->routeIs('artisans')">
                {{ __('Artesanos') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link >
                {{ __('My Cart') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('joinArtisan')" :active="request()->routeIs('joinArtisan')">
                {{ __('Eres artesano? Unete!') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                
            @auth
                <div class="ml-3">
                    <div class="font-medium text-base beigeLight">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm beigeLight"">{{ Auth::user()->email }}</div>
                </div>
            @endauth
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                    

                </form>
            </div>
        </div>
    </div>
</nav>
