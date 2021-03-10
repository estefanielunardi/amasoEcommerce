<x-app-layout>
    <h1 class="title text-center pb-10 pt-5 lg:pt-20">Resultado encontrado por {{$name}}</h1>

    <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
        @foreach($products as $product)
        <x-product.card.product-card :product="$product" :artisan=null :highlightProducts=null :bestSellers=null/>
        @endforeach
    </div>
    <div class="px-6 pb-20 xl:px-32 2xl:px-56">
        {!! $products->links() !!}
    </div>
</x-app-layout>