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
                <!-- <button class="exo text-white text-base sm:text-xl uppercase py-1 px-4 sm:py-2 sm:px-8 rounded-full shadow-lg greenAmasoBg mt-4 sm:mt-8">
                    <a href="/register"> ¡únete! </a> 
                </button> -->
            </section>
    </header>

    <x-button-cart />
    <h1 class="title text-center pb-10 pt-5 lg:pt-20">Catálogo</h1>
    <article class="max-w-screen-xl pl-7 sm:pl-10 xl:pl-20 mx-auto px-4">
        <div class=" ml-6 flex flex-wrap justify-center">

            @foreach($products as $product)
            <x-product-card :product="$product"/>
            @endforeach

        </div>
        {!! $products->links() !!}
        </div>
    </article>
</x-app-layout>