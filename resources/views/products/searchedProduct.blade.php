<x-app-layout>
    <h1 class="title text-center pb-10 pt-5 lg:pt-20">Resultado encontrado por {{$name}}</h1>
    <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
        <div class=" ml-6 flex flex-wrap justify-center">
            @foreach($products as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </article>
</x-app-layout>