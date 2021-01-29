<x-app-layout>
    <header class="static">
        <img class="w-full h-64 object-cover lg:h-full" src="./image/cover2.jpg">
        <section class="absolute top-24 left-10 w-52 lg:w-96 lg:top-52 lg:left-52">
            <p class="heroTitle text-2xl pb-5 lg:text-5xl">
            Nuestros alimentos tienen orígenes cercanos a tí.
            </p>
            <p class="heroText text-xs lg:text-xl">
            La relación con nuestros proveedores está basada en la vertiente humana por encima de la comercial.
            </p>
        </section>

    </header>


    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
            <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
                <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </x-nav-link>
    </div>

    <article class="max-w-screen-xl mx-auto px-4">
        <div class=" ml-6 flex flex-wrap">

            @foreach($products as $product)
            <div class=" px-1 w-full flex flex-col p-6 sm:w-1/2 lg:w-1/3">
                <section class="w-72 h-96 shadow-lg rounded-xl">
                    <header class="relative">
                        <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{ asset('storage') .'/'. $product->image}}">
                    </header>

                    <section class="px-4">
                        <div class="block py-2">
                            <h2 class="productTitle">{{$product->name}}</h2>
                            <h3 class="productProductor">Productor: {{$product->artisans->name}}</h3>
                        </div>
                        <div class="block py-1">
                            <p class="productDescription">
                            {{$product->description}}
                            </p>
                        </div>
                        <div class="block py-2 flex items-center justify-around">
                            @if ($product->stock > $product->sold)
                                <p class="inline-block productPrice">{{$product->price}} €</p>
                                <div class="grid justify-items-center">
                                    <p class="text-sm">Añadir al carrito:</p>
                                    <x-counter></x-counter>
                                </div>
                            @else 
                                <p class="text-lg beigeAmasoBg p-1 mt-4 leading-4">Producto agotado</p>
                            @endif
                        </div>
                    </section>
                </section>
            </div>
            @endforeach

        </div>
    </article>
    {!! $products->links() !!}

    

</x-app-layout>