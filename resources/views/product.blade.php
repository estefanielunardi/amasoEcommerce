<x-app-layout>

<article class="max-w-screen-xl mx-auto px-4">
    <div class=" ml-6 flex flex-wrap">

        @foreach($product as $product)
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
</article>
{!! $products->links() !!}
</x-app-layout>


