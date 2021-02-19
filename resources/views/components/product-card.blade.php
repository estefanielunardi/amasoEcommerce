<div class=" px-1 w-full flex flex-col p-6 sm:w-1/2 lg:w-1/3">
    <section class="w-72 h-96 shadow-lg rounded-xl">
        <a href="/product/{{$product->id}}">
            <header class="h-48 overflow-hidden">
           <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{ asset('storage') .'/'. $product->image}}">
        </header>
        </a>

        <section class="px-4">
            <div class="block py-2">
                <h2 class="productTitle">{{$product->name}}</h2>
                <h3 class="productProductor">Productor: 
                    <a href="/artisan/{{$product->artisans->slug}}">{{$product->artisans->name}}</a>
                </h3>
            </div>
            <div class="block py-1 h-16 overflow-auto">
                <p class="productDescription">
                    {{$product->description}}
                </p>
            </div>
            <div class="block py-2 flex items-center justify-around">
                @if ($product->stock > $product->sold)
                <p class="pt-2 pr-2 inline-block productPrice">{{number_format($product->price / 100,2)}} €</p>
                <div class="grid justify-items-center">
                    
                    <div class="flex flex-row h-9 w-full justify-center rounded-lg relative bg-transparent mt-1 vollkorn">                      
                        <button class="greenLightBg  rounded-xl">
                            <span class="m-auto text-lg p-2 font-thin exo text-white">
                                <a href="{{ route('cartAddProduct' , $product->id) }}">Añadir</a>
                            </span>
                        </button>
                    </div>
                </div>
                @else
                <p class="text-lg beigeAmasoBg p-1 mt-2 leading-4">Producto agotado</p>
                @endif
            </div>
        </section>
    </section>
</div>

