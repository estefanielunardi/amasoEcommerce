<x-app-layout>
    <img class="w-full" src="./image/cover.jpeg">

    <div class="md:container md:mx-auto p-8 flex justify-center text-8l font-bold">
        <div class="textManifiesto">
            <h3 class="textManifiesto text-center font-bold">MANIFIESTO
                <br>
                Nuestros alimentos tienen orígenes cercanos, la relación con nuestros proveedores está basada en la vertiente humana por encima de la comercial.
                <br>
                Ponemos el foco en el origen de los alimentos, siempre respetando su temporalidad.
                Tenemos una relación con nuestros proveedores que va más allá de la comercial.
                <br>
                Creamos valor económico, medioambiental y social; contribuimos al bienestar y al progreso de las generaciones presentes y futuras.
            </h3>
        </div>

    </div>

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
                                <p class="text-lg beigeAmasoBg leading-4">Producto agotado</p>
                            @endif
                        </div>
                    </section>
                </section>
            </div>
            @endforeach

        </div>
        {!! $products->links() !!}
    </div>
    @push('scripts')
    <script>
        function decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value--;
            target.value = value;
        }

        function increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
            `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
            `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
            btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
            btn.addEventListener("click", increment);
        });
    </script>

    @endpush
    

</x-app-layout>