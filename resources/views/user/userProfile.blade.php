<x-app-layout>
    <div>
        <h1 class="title pl-4 pb-10 pt-5 lg:pt-20">Hola {{$user->name}}</h1>
        <button class="greenLightBg flex flex-row align-start text-sm text-white mt-4 px-3 py-2 ml-3 rounded-xl shadow-md">
            <svg width="24" height="24" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.0582 5.7376C21.3442 5.43197 21.6862 5.18819 22.0644 5.02048C22.4427 4.85277 22.8494 4.76449 23.2611 4.7608C23.6727 4.75711 24.0809 4.83808 24.4619 4.99897C24.8428 5.15987 25.189 5.39748 25.48 5.69794C25.7711 5.9984 26.0013 6.35568 26.1571 6.74895C26.313 7.14222 26.3915 7.56359 26.3879 7.98849C26.3843 8.41338 26.2988 8.83329 26.1363 9.2237C25.9739 9.61411 25.7377 9.96721 25.4416 10.2624L24.2125 11.5312L19.8291 7.0064L21.0582 5.7376ZM17.6374 9.2688L4.6499 22.6752V27.2H9.0333L22.0223 13.7936L17.6358 9.2688H17.6374Z" fill="white" />
            </svg>
            <a class="text-sm pl-2 pt-1 exo" href='/user/edit'>Editar perfil</a>
        </button>
    </div>
    @if(count($userHistoryProducts) !== 0)
    <div>
        <h1 class="title text-center pb-10 pt-5 lg:pt-20">Productos que has comprado</h1>
    </div>

    <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
        @foreach($userHistoryProducts as $product)
        <x-product.card.product-card :product="$product" :artisan=null :highlightProducts=null :bestSellers=null/>
        @endforeach
    </div>

    @else
    <section class="p-12 w-full h-96 content-center flex-wrap flex justify-center">
        <p class="beigeAmaso text-xl text-center">
            Aún no has comprado ningún producto.
        </p>
    </section>
    @endif
</x-app-layout>