<x-app-layout>
    @if (session('message'))
    <div class="text-white px-6 py-4 border-0 relative greenLightBg">
        <span class="alert alert-success inline-block align-middle mr-8">
            {{ session('message') }}
        </span>
    </div>
    @endif

    <header class="relative">
        <img class="w-full h-48 object-cover lg:h-72" src="./image/cover2.jpg">
        <section class="absolute z-10 top-7 left-10 w-52 w-1/2 lg:top-16 lg:left-32 xl:top-20 xl:left-52">
            <p class="heroTitle text-left text-2xl pb-1 md:text-3xl lg:text-4xl xl:pb-5 xl:text-5xl">
                Nuestros alimentos tienen orígenes cercanos a tí.
            </p>
            <p class="heroText text-left w-44 text-xs md:text-sm lg:text-base lg:w-full xl:text-xl">
                Tienda online de productos locales y artesanales.
            </p>
            
        </section>
    </header>

    <x-button-cart />
    @if (isset($bestSellers))
    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Productos más vendidos</h1>
        <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
            <div class=" ml-6 flex flex-wrap justify-center">
                @foreach($bestSellers as $bestSeller)
                <x-product-card :product="$bestSeller"/>
                @endforeach
            </div>
        </article>
    </div>
    @endif
    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Catálogo</h1>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex justify-center">
        <div class="flex items-center">
            <button class="py-2 px-4 tracking-wide greenLightBg text-white font-medium hover:bg-gray-700 focus:outline-none focus:bg-gray-700 rounded-xl">Categorias</button>

            <div x-data="{ dropdownOpen: true }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block greenLightBg p-2 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 rounded-xl">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                    <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Todas</a>
                    <a href="{{ url('/drinks') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Bebidas</a>
                    <a href="{{ url('/bakery') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Pasteleria</a>
                    <a href="{{ url('/vegetables') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Vegetales</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Otras</a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
        <div class=" ml-6 flex flex-wrap justify-center">

            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach

        </div>
        {!! $products->links() !!}
        </div>
    </article>
</x-app-layout>