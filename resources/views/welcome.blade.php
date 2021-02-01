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
                    <header class="h-48 overflow-hidden">
                        <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{ asset('storage') .'/'. $product->image}}">
                    </header>

                    <section class="px-4">
                        <div class="block py-2">
                            <h2 class="productTitle">{{$product->name}}</h2>
                            <h3 class="productProductor">Productor: {{$product->artisans->name}}</h3>
                        </div>
                        <div class="block py-1 h-12 overflow-auto">
                            <p class="productDescription">
                                {{$product->description}}
                            </p>
                        </div>
                        <div class="block py-2 flex items-center justify-around">
                            @if ($product->stock > $product->sold)
                            <p class="inline-block productPrice">{{number_format($product->price / 100,2)}} €</p>
                            <div class="grid justify-items-center">
                                <p class="text-xs">Añadir al carrito:</p>
                                <div class="flex flex-row h-9 w-full rounded-lg relative bg-transparent mt-1 vollkorn">
                                    <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                                        <button data-action="decrement" type="submit" class="counter greenLightBg beigeLight h-full w-9 rounded-l-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin text-white">-</span>
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </button>
                                    </form>
                                    <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-10 greenAmasoBg font-semibold text-xl  md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                                    <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-9 rounded-r-2xl cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin text-white">
                                            <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
                                        </span>
                                    </button>
                                </div>
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