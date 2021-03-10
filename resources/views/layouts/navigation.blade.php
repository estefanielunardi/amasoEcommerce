<nav x-data="{ open: false }" class="greenAmasoBg sticky z-40 top-0">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-row items-center w-full h-16">
        <div class="flex flex-row items-center w-full">
            <!-- Logo -->
            <div class="ml-10 lg:ml-48 items-center ">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex md:w-full md:m-auto md:ml-20 md:mr-10 items-center">
                <div class=" space-x-8 sm:-my-px sm:ml-10 ">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Catálogo') }}
                    </x-nav-link>
                </div>
                @can('isAdmin')
                <div class=" space-x-8 sm:-my-px sm:ml-10 ">
                    <x-nav-link :href="route('adminDash')" :active="request()->routeIs('adminDash')">
                        {{ __('Panel de administrador') }}
                    </x-nav-link>
                </div>
                @endcan
                @guest
                <div class="space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                </div>
                <div class="space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                </div>
                @endguest

                @can('isArtisan')
                <div class=" space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                        {{ __('Mi perfil Artesano') }}
                    </x-nav-link>
                </div>
                @endcan
                <div class="space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('artisans')" :active="request()->routeIs('artisans')">
                        {{ __('Artesanos') }}
                    </x-nav-link>
                </div>
                @auth
                <div class=" space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('userProfile')" :active="request()->routeIs('userProfile')">
                        {{ __('Pedidos') }}
                    </x-nav-link>
                </div>
                @endauth
                <div class="space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                        {{ __('') }}
                        <div class="relative">
                            <svg class="beigeLight relative ml-2 w-11 h-11 text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @if ($productsCount != 0)
                            <div class=" flex rounded-full beigeAmasoBg w-5 h-5 absolute top-0 left-8 justify-center align-center " id="items-cart">
                                <p class='text-white vollkorn'>{{$productsCount}}</p>
                            </div>
                            @endif
                        </div>
                    </x-nav-link>
                </div>
                @can('isAuth')
                <div class="space-x-8 sm:-my-px sm:ml-10">
                    <x-nav-link :href="route('joinArtisan')" :active="request()->routeIs('joinArtisan')">
                        {{ __('Eres artesano? Unete!') }}
                    </x-nav-link>
                </div>
                @endcan
            </div>
            @auth
            <!-- Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:min-w-max md:mr-48 md:justify-end">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium beigeLight hover:text-white hover:border-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
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

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                        @can('isAdmin')
                        <form method="GET" action="{{ route('adminDash') }}">
                            @csrf
                            <x-dropdown-link :href="route('adminDash')" onclick="event.preventDefault();
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
        <div class="flex items-center md:hidden mr-14">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md beigeLight hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>





    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class=" absolute greenAmasoBg w-full z-30">
        @can('isAdmin')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('adminDash')" :active="request()->routeIs('adminDash')">
                {{ __('Administrador') }}
            </x-responsive-nav-link>
        </div>
        @endcan
        @guest
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
        @endguest
        @can('isArtisan')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                {{ __('Mi perfil Artesano') }}
            </x-responsive-nav-link>
        </div>
        @endcan
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('artisans')" :active="request()->routeIs('artisans')">
                {{ __('Artesanos') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                {{ __('Mi carrito') }}
            </x-responsive-nav-link>
        </div>
        @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('userProfile')" :active="request()->routeIs('userProfile')">
                {{ __('Pedidos') }}
            </x-responsive-nav-link>
        </div>
        @endauth
        @can('isAuth')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('joinArtisan')" :active="request()->routeIs('joinArtisan')">
                {{ __('Eres artesano? Unete!') }}
            </x-responsive-nav-link>
        </div>
        @endcan

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 ">
            @auth
            <div class="flex items-center px-4 border-t border-gray-200">
                <div class="ml-3 mt-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-2 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endauth
        </div>
    </div>
</nav>