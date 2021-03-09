
    <div class="max-h-96 w-96 overflow-hidden rounded-xl shadow-lg">
        <img class="object-fill w-full" src="{{$product->image}}" alt="foto de perfil">
    </div>
</article>
<article class=" md:pl-10">
    <div>
        <h2 class="block title text-4xl	"> {{$product->name}} </h2>
        <h2 class="productProductor">Productor:
            <a href="/artisan/{{$product->artisans->slug}}">{{$product->artisans->name}}</a>
        </h2>
    </div>
    <div class="block py-2 flex items-center ">
        @if ($product->stock > $product->sold)
        <p class=" pr-2 text-3xl inline-block productPrice">{{number_format($product->price / 100,2)}} €</p>
        <div class="grid justify-items-center">
            <div class="flex flex-row ml-2 h-9 w-full justify-center rounded-lg relative bg-transparent mt-1 vollkorn">
                <button class="greenLightBg  rounded-xl">
                    <span class="m-auto text-lg p-2 font-thin exo text-white">
                        <a href="{{ route('cartAddProduct' , $product->id) }}">Añadir</a>
                    </span>
                </button>
            </div>
        </div>
        @else
        <p class="text-lg beigeAmasoBg p-1 mt-1 leading-4">Producto agotado</p>
        @endif
    </div>
