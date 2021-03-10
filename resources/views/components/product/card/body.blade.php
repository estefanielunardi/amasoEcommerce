<div class="w-72 h-80 px-4 py-3">
    <header>
        <h2 class="productTitle">{{$product->name}}</h2>
        @isset ($product->artisans)
        <a href="/artisan/{{$product->artisans->slug}}" class="w-min">
            <h3 class="productProductor hover:underline ">Productor: {{$product->artisans->name}}</h3>
        </a>
        @endisset
    </header>

    <section class="relative">
        @if ($product->stock > $product->sold)
            <div class="inline-block">
                <p class="pt-2 pr-2 inline-block productPrice ">{{number_format($product->price / 100,2)}} € </p>
                <p class="text-xs">Precio por: {{$product->typequantity}}</p>
            </div>
            
            @if(!$artisan || auth()->id() !== $artisan->user_id)
            <div class="absolute right-1 bottom-1">
                <x-product.card.buttons.add-button :product="$product"></x-product.card.buttons.add-button>
            </div>
            @endif
        @else 
            <div>
                <p class="text-lg beigeAmaso mt-5 pb-1">Producto agotado</p>
            </div>
        @endif

        @if ($artisan)
        @if(auth()->id() == $artisan->user_id)
        <div class="absolute h-12 w-24 right-1 bottom-1">
            <x-product.card.buttons.admin-buttons :product="$product"></x-product.card.buttons.admin-buttons>
        </div>
        @endif
        @endif
    </section>
</div>