<x-app-layout>


@if (session('message'))
<div class="text-white px-6 py-4 border-0 rounded relative mb-4 greenLightBg">
    <span class="alert alert-success inline-block align-middle mr-8 capitalize">
    {{ session('message') }}
    </span>
</div>
@endif


    <header class="static">
        <img class="w-full h-64 object-cover lg:h-full" src="./image/cover2.jpg">
        <section class="absolute top-24 left-10 w-52 lg:w-1/3 lg:top-52 lg:left-52">
            <p class="heroTitle text-left text-2xl pb-5 lg:text-5xl">
                Nuestros alimentos tienen orígenes cercanos a tí.
            </p>
            <p class="heroText text-left w-44 text-xs lg:w-80 lg:text-xl">
                Tienda online de productos locales y artesanales. 
            </p>
            @guest
            <button class="exo text-white text-base sm:text-xl uppercase py-1 px-4 sm:py-2 sm:px-8 rounded-full shadow-lg greenAmasoBg mt-4 sm:mt-8">
                <a href="/register"> ¡únete! </a> 
            </button>
            @endguest
        </section>
    </header>

    <x-button-cart />
    <h1 class="title text-center pb-10 pt-36">Catálogo</h1>
    <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
        <div class=" ml-6 flex flex-wrap justify-center">

            @foreach($products as $product)
            <x-product-card :product="$product"/>
            @endforeach

        </div>
        {!! $products->links() !!}
        </div>
    </article>
</x-app-layout>