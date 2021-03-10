<x-app-layout>

    <body>
        <section class="block space-y-8 ... p-12 pb-5">
            <section class=" flex flex-col md:flex-row">
                <article class="flex justify-start pb-6">
                    <div class="max-h-96 w-96 overflow-hidden rounded-xl">
                        <img class="object-fill w-full" src="{{$artisan->image}}" alt="foto de perfil">
                    </div>
                </article>
                <article class="space-y-3 md:pl-10">
                    <div>
                        <h2 class="block title text-2xl	"> {{$artisan->name}} </h2>
                        <p class="block beigeAmaso text-sm"> {{$artisan->location}} </p>
                        <p class="block greenAmaso text-sm font-light w-64 lg:w-96 pb-5"> {{$artisan->description}} </p>
                    </div>
                    <div>
                        @if(auth()->id() == $artisan->user_id)
                        <button class="greenLightBg flex flex-row align-start text-sm text-white mt-4 px-3 py-2  rounded-xl shadow-md">
                            <svg width="24" height="24" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.0582 5.7376C21.3442 5.43197 21.6862 5.18819 22.0644 5.02048C22.4427 4.85277 22.8494 4.76449 23.2611 4.7608C23.6727 4.75711 24.0809 4.83808 24.4619 4.99897C24.8428 5.15987 25.189 5.39748 25.48 5.69794C25.7711 5.9984 26.0013 6.35568 26.1571 6.74895C26.313 7.14222 26.3915 7.56359 26.3879 7.98849C26.3843 8.41338 26.2988 8.83329 26.1363 9.2237C25.9739 9.61411 25.7377 9.96721 25.4416 10.2624L24.2125 11.5312L19.8291 7.0064L21.0582 5.7376ZM17.6374 9.2688L4.6499 22.6752V27.2H9.0333L22.0223 13.7936L17.6358 9.2688H17.6374Z" fill="white" />
                            </svg>
                            <a class="text-sm pl-2 pt-1 exo" href="{{route('editProfile', $artisan->slug) }}" method="get">
                                Editar perfil
                            </a>
                        </button>

                        <form class="" method="POST" action="{{ route('deleteProfile', $artisan->slug) }}">
                            <x-modal title="¿Eliminar perfil?" submit-label="Eliminar">
                                <x-slot name="trigger">
                                    <button type="button" @click="on = true" class="greenLightBg flex flex-row align-start text-sm text-white mt-4 px-3 py-2  rounded-xl shadow-md">
                                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <p class="text-sm pl-2 pt-1 exo">
                                            Eliminar Perfil
                                        </p>
                                    </button>
                                </x-slot>
                                ¿Está seguro de que desea eliminar su perfil?
                            </x-modal>
                            @method('DELETE')
                            {{ csrf_field() }}
                        </form>
                        @endif
                    </div>
                </article>
            </section>
        </section>

        <div class="flex flex-row mb-10">
            @if (!$artisan->aproved)
            @can('isAdmin')
            <form class="ml-12" method="POST" action="{{ route('aproveArtisan', $artisan->id) }}">
                <x-modal title="¿Aprobar artesano?" submit-label="Aprobar">
                    <x-slot name="trigger">
                        <button type="button" @click="on = true" class="beigeAmasoBg flex flex-row align-start text-sm text-white mt-4 px-6 py-2  rounded-xl shadow-md">Aprobar artesano</button>
                    </x-slot>
                    A partir de ahora este artesano podrá vender sus productos en Amasó.
                </x-modal>
                @method('POST')
                {{ csrf_field() }}
            </form>
            @endcan
            @endif
            @can('isAdmin')
            <form class="ml-20" method="POST" action="{{ route('adminDeleteProfile', $artisan->id) }}">
                <x-modal title="¿Eliminar perfil?" submit-label="Eliminar">
                    <x-slot name="trigger">
                        <button type="button" @click="on = true" class="bg-red-400 flex flex-row align-start text-sm text-white mt-4 px-6 py-2  rounded-xl shadow-md">Eliminar Perfil</button>
                    </x-slot>
                    ¿Está seguro de que desea eliminar este perfil?
                </x-modal>
                @method('DELETE')
                {{ csrf_field() }}
            </form>
            @endcan
        </div>

        <article class="pl-12">
            <h2 class="block title">Productos de {{$artisan->name}}</h2>
        </article>
        @if(auth()->id() == $artisan->user_id)
        <article class="flex pl-12 md:justify-start pb-7">
            <form action="{{'/product/create'}}" method="get">
                <button class="greenLightBg  flex flex-row align-start items-center font-serif text-white text-2xl mt-4 px-3 py-2 w-40 md:w-56  rounded-xl shadow-md" type="submit">
                    <svg width="30" height="30" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M8.48486 16.8905L25.4547 17.0491M16.8905 25.4547L17.0491 8.48491L16.8905 25.4547Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="24" height="24" fill="white" transform="translate(0 16.8112) rotate(-44.4644)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <p class="text-sm pl-2 exo">Subir un nuevo Producto</p>
                </button>
            </form>
            <button class="beigeAmasoBg flex flex-row align-start items-center font-serif text-white text-2xl mt-4 px-3 py-2 pr-4 ml-4 rounded-xl shadow-md" type="submit">
                <a class="text-sm pl-1 exo" href="/orders">Mis Pedidos</a>
            </button>
        </article>
        @endif


        @if('isAuth' || auth()->id() != $artisan->user_id)
        <x-button-cart />
        @endif

        @if (count($highlightProducts))
        <article class="max-w-screen-xl  pl-4 sm:pl-10 xl:pl-20 mx-auto px-4">
            <h1 class="text-center pb-1 pr-16 beigeAmaso vollkorn text-2xl">Productos destacados</h1>
            <div class=" ml-6 flex flex-wrap justify-center">
            </div>
        </article>

        <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
            @foreach($highlightProducts as $product)
            <x-product.card.product-card :product="$product" :artisan="$artisan" :highlightProducts="$highlightProducts" :bestSellers=null />
            @endforeach
        </div>

        @endif

        <article class="max-w-screen-xl pl-4 pt-10 sm:pl-10 xl:pl-20 mx-auto px-4">
            @if (count($products) === 0 && auth()->id() == $artisan->user_id)
            <section class="p-12 w-full h-96 content-center flex-wrap flex justify-center">
                <p class="beigeAmaso text-xl text-center">
                    Aún no has publicado ningún producto. ¡Sube el primero!
                </p>
            </section>
            @else
            <h1 class="text-center pb-1 pr-16 greenAmaso vollkorn text-2xl">Todos los productos</h1>
            @endif
        </article>

        <div class="w-full flex flex-wrap justify-center content-start p-6 xl:px-32 2xl:px-56">
            @foreach($products as $product)
            <x-product.card.product-card :product="$product" :artisan="$artisan" :highlightProducts=null :bestSellers=null />
            @endforeach
        </div>
        <div class="px-6 pb-20 xl:px-32 2xl:px-56">
            {!! $products->links() !!}
        </div>

    </body>
    @push('scripts')
    <script>
        function decrement(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value--;
            target.value = value;
        }

        function increment(e) {
            const btn = e.target.parentNode.parentElement.querySelector(
                'button[data-action="decrement"]'
            );
            const target = btn.nextElementSibling;
            let value = Number(target.value);
            value++;
            target.value = value;
        }

        const decrementButtons = document.querySelectorAll(
            `button[data-action="decrement"]`
        );

        const incrementButtons = document.querySelectorAll(
            `button[data-action="increment"]`
        );

        decrementButtons.forEach(btn => {
            btn.addEventListener("click", decrement);
        });

        incrementButtons.forEach(btn => {
            btn.addEventListener("click", increment);
        });
    </script>

    @endpush

</x-app-layout>