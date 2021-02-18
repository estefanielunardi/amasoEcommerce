<x-app-layout>
@if (session('message'))
    <div class="text-white px-6 py-4 border-0 relative greenLightBg">
        <span class="alert alert-success inline-block align-middle mr-8">
        {{ session('message') }}
        </span>
    </div>
@endif

    <header class="relative">
        <img class="w-full h-64 object-cover lg:h-full" src="./image/cover2.jpg">
            <section class="absolute z-10 top-8 left-10 w-52 lg:w-1/3 lg:top-40 lg:left-52">
                <p class="heroTitle text-left text-2xl pb-5 lg:text-5xl">
                    Nuestros alimentos tienen orígenes cercanos a tí.
                </p>
                <p class="heroText text-left w-44 text-xs lg:w-80 lg:text-xl">
                    Tienda online de productos locales y artesanales. 
                </p>
                <button class="exo text-white text-base sm:text-xl uppercase py-1 px-4 sm:py-2 sm:px-8 rounded-full shadow-lg greenAmasoBg mt-4 sm:mt-8">
                    <a href="/register"> ¡únete! </a> 
                </button>
            </section>
    </header>

    <x-button-cart />
    <div>
        <h1 class="title text-center pb-10 pt-20">Catálogo</h1>
        <div class="flex space-x-4 flex-row h-9 w-full justify-center rounded-lg relative bg-transparent mt-1 vollkorn"> 
            <button class="greenLightBg  rounded-xl">
                    <a class="m-auto text-lg p-2 font-thin exo text-white" href="{{ url('/') }}">Todos</a> 
            </button>
            <button class="greenLightBg  rounded-xl">
                    <a class="m-auto text-lg p-2 font-thin exo text-white" href="{{ url('/vegetables') }}">Vegetales</a> 
            </button>
            <button class="greenLightBg  rounded-xl">
                    <a class="m-auto text-lg p-2 font-thin exo text-white" href="{{ url('/drinks') }}">Bebidas</a>
            </button>
            <button class="greenLightBg  rounded-xl">
                    <a class="m-auto text-lg p-2 font-thin exo text-white" href="{{ url('/bakery') }}">Pasteleria/Reposteria</a>
            </button>
        </div>
    </div>
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