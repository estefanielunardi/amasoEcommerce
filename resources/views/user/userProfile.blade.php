<x-app-layout>
    <div>
        <h1 class="title pl-4 pb-10 pt-5 lg:pt-20">Hola {{$user->name}}</h1>
    </div>
    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Productos que has comprado</h1>
    </div>
    <article class="max-w-screen-xl pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
        <div class=" ml-6 flex flex-wrap justify-center">
            @foreach($userHistoryProducts as $product)
            <x-product-card :product="$product" />
            @endforeach
        </div>
    </article>
</x-app-layout>