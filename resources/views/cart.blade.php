<x-app-layout>
<H1 class="tuCarritoTitle">Tu Carrito</H1>
    <section>
        <div>
            @foreach ($products as $product)
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 productCart" >
                <article class="overflow-hidden rounded-lg">

                    <div class="relative">
                        <img alt="Placeholder" class="w-full" src="{{ asset('storage') .'/'.$product->image}}" class="w-16">
                    </div>

                    <header class="font-bold text-xl mb-2">
                        <div class="px-6 py-4">
                            {{$product->name}}
                        </div>
                        <div class="px-6 py-4 text-sm">
                            <a href="/artisan/{{$product->artisans->slug}}">Productor: {{$product->artisans->name}} </a>
                        </div>
                        <div class="ml-2 text-grey-darker text-base">
                            {{$product->description}}
                        </div>
                    </header>
                    <div class="px-4 py-4 md:px-10">
                        <p class="py-4"> {{$product->price}} €</p>
                        <div class="relative">
                            @if ($product->stock < $product->sold)
                                <div class="custom-number-input h-12 w-32 absolute bottom-2 right-1">
                                    <p class="textManifiesto text-base font-bold">Añadir al carrito</p>
                                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button data-action="decrement" class="counter greenLightBg beigeLight h-full w-20 rounded-l-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-12 greenAmasoBg font-semibold text-md   md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                                        <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-20 rounded-r-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <p class="greenAmaso">Sold Out</p>
                                @endif
                        </div>
                    </div>
                </article>
            </div>
            @endforeach

            {!! $products->links() !!}
        </div>
    </section>

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