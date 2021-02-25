<div class=" px-1 w-full flex flex-col p-6 sm:w-1/2 lg:w-1/3">
    <a href="/product/{{$product->id}}">
        <section class="w-72 h-96 shadow-lg rounded-xl">
            <header class="h-48 overflow-hidden">
                <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{$product->image}}">
            </header>

        <section class="relative px-4 h-44">
            <div class="block py-2">
                <h2 class="productTitle">{{$product->name}}</h2>
                <h3 class="productProductor">Productor: 
                    <a href="/artisan/{{$product->artisans->slug}}">{{$product->artisans->name}}</a>
                </h3>
                <h3 class="productCategory">Categoria: {{$product->category}}</h3>
            </div>
            <div class="block pb-1 h-9 overflow-x-auto">
                <p class="productDescription">
                    {{$product->description}}
                </p>
            </div>
            <div class="absolute bottom-0 pt-3 w-full flex items-center pr-3">
                @if ($product->stock > $product->sold)
                <div class="inline-block">
                    <p class="pt-2 pr-2 inline-block productPrice">{{number_format($product->price / 100,2)}} € </p>
                    <p class="text-xs">Precio por: {{$product->typequantity}}</p>
                </div>
                <div class="grid justify-items-center absolute right-10 top-6">
                    
                    <div class="flex flex-row h-9 w-full justify-center rounded-lg relative bg-transparent mt-1 vollkorn">                      
                        <button class="greenLightBg  rounded-xl">
                            <span class="m-auto text-lg p-2 font-thin exo text-white">
                                <a href="{{ route('cartAddProduct' , $product->id) }}">Añadir</a>
                            </span>
                        </button>
                    </div>
                </div>
                @else
                <p class="text-lg beigeAmasoBg p-1 ml-12 mt-2 mb-3 leading-4">Producto agotado</p>
                @endif
            </div>
        </section>
        </section>
    </a>
</div>

