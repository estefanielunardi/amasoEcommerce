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

        <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
            @foreach($bestSellers as $product)
            <x-product.card.product-card :product="$product" :artisan=null :highlightProducts=null :bestSellers="$bestSellers"/>
            @endforeach
        </div>
    </div>
    @endif

    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Catálogo</h1>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-col justify-center">
        <x-welcome.searcher />
        <x-welcome.categories />
    </div>

    <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
        @foreach($products as $product)
        <x-product.card.product-card :product="$product" :artisan=null :highlightProducts=null :bestSellers=null/>
        @endforeach
    </div>
    <div class="px-6 pb-20 xl:px-32 2xl:px-56">
        {!! $products->links() !!}
    </div>

</x-app-layout>