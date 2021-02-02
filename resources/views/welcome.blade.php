<x-app-layout>
    <header class="static">
        <img class="w-full h-64 object-cover lg:h-full" src="./image/cover2.jpg">
        <section class="absolute top-24 left-10 w-52 lg:w-1/3 lg:top-52 lg:left-52">
            <p class="heroTitle text-left text-2xl pb-5 lg:text-5xl">
                Nuestros alimentos tienen orígenes cercanos a tí.
            </p>
            <p class="heroText text-left text-xs lg:w-96 lg:text-xl">
                La relación con nuestros proveedores está basada en la vertiente humana por encima de la comercial.
            </p>
        </section>

    </header>
    <x-button-cart />
    <article class="max-w-screen-xl mx-auto px-4">
        <div class=" ml-6 flex flex-wrap">

            @foreach($products as $product)
            <x-product-card :product="$product"/>
            @endforeach

        </div>
        {!! $products->links() !!}
        </div>
    </article>
</x-app-layout>