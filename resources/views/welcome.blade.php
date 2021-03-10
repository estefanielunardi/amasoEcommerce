<x-app-layout>
    @if (session('message'))
    <div class="text-white px-6 py-4 border-0 relative greenLightBg">
        <span class="alert alert-success inline-block align-middle mr-8">
            {{ session('message') }}
        </span>
    </div>
    @endif

    <header class="relative">
        <img class="w-full h-48 object-cover lg:h-72" src="../image/cover2.jpg">
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
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Productos más vendidos de {{$monthName}}</h1>
        <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
            <div class=" ml-6 flex flex-wrap justify-center">
                @foreach($bestSellers as $bestSeller)
                <x-product-card :product="$bestSeller" />
                @endforeach
            </div>
        </article>
    </div>
    @endif

    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Catálogo</h1>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-wrap-reverse justify-evenly">
        <div class="flex items-center py-2">
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class=" flex flex-row py-2 px-4 tracking-wide greenLightBg text-white font-medium focus:outline-none rounded-xl">
                    <p class="pr-2">Categorias</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                </div>
                <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                    <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Todas</a>
                    <a href="{{ url('/categorias/bebidas') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Bebidas</a>
                    <a href="{{ url('/categorias/pasteleria') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Pasteleria</a>
                    <a href="{{ url('/categorias/vegetales') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Vegetales</a>
                    <a href="{{ url('/categorias/otras') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Otras</a>
                </div>
            </div>
        </div>

        <div class="flex items-center p-2">
            <div class="pt-2 relative mx-auto greenAmaso">
                <form method="POST" action="{{ route('searchProduct') }}" role="search">
                    @method('POST')
                    @csrf
                    <input class="border-2 borderGreen bg-white h-10 px-5 pr-16 rounded-lg text-lg focus:outline-none" type="text" name="search" placeholder="Buscador">
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                        <svg class="text-green-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                            <path color="#003e00fa" d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
        @foreach($products as $product)
        <x-product.card.product-card :product="$product" :artisan=null />
        @endforeach
    </div>
    <div class="px-6 pb-20 xl:px-32 2xl:px-56">
        {!! $products->links() !!}
    </div>


</x-app-layout>