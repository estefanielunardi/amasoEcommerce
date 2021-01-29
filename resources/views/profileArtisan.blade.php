<x-app-layout>
    <body>
        <section class="block space-y-8 ... p-12 ">
        @can('isArtisan')
        <button class= "greenLightBg flex flex-row align-start text-sm text-white mt-4 px-6 py-2  rounded-xl shadow-md">               
            <svg  width="24" height="24" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.0582 5.7376C21.3442 5.43197 21.6862 5.18819 22.0644 5.02048C22.4427 4.85277 22.8494 4.76449 23.2611 4.7608C23.6727 4.75711 24.0809 4.83808 24.4619 4.99897C24.8428 5.15987 25.189 5.39748 25.48 5.69794C25.7711 5.9984 26.0013 6.35568 26.1571 6.74895C26.313 7.14222 26.3915 7.56359 26.3879 7.98849C26.3843 8.41338 26.2988 8.83329 26.1363 9.2237C25.9739 9.61411 25.7377 9.96721 25.4416 10.2624L24.2125 11.5312L19.8291 7.0064L21.0582 5.7376ZM17.6374 9.2688L4.6499 22.6752V27.2H9.0333L22.0223 13.7936L17.6358 9.2688H17.6374Z" fill="white"/>
            </svg> 
            <a href="{{route('editProfile', $artisan->slug) }}" method="get"}}>
                Editar perfil
            </a>             
        </button>
        <form method="POST" action="{{ route('deleteProfile', $artisan->slug) }}">
            <x-modal title="¿Eliminar perfil?" submit-label="Eliminar">
                <x-slot name="trigger">
                    <button type="button" @click="on = true" class= "greenLightBg flex flex-row align-start text-sm text-white mt-4 px-6 py-2  rounded-xl shadow-md">Eliminar Perfil</button>
                </x-slot>
                ¿Está seguro de que desea eliminar su perfil?
            </x-modal>
            @method('DELETE')
            {{ csrf_field() }}
        </form>
        @endcan
            <article class="flex justify-start">
                <div>
                    <img class=" max-w-xs w-174 rounded-xl" src="{{ asset('storage') .'/'. $artisan->image}}" alt="foto de perfil">
                </div>
            </article>
            <article class= "space-y-3">
                <h2 class="block title text-2xl	"> {{$artisan->name}} </h2>
                <p class="block beigeAmaso text-sm"> {{$artisan->location}} </p>
                <p class="block greenAmaso text-sm font-light"> {{$artisan->description}} </p>
            </article>
        </section>

        <article class="p-8">
            <h2 class="block title">Productos de {{$artisan->name}}</h2>
        </article>
        @can('isArtisan')
        <article class="flex justify-center pb-7">
            <form action="{{'/product/create'}}" method="get">
                <button class="greenLightBg  flex flex-row align-start font-serif text-white text-2xl mt-4 px-6 py-2  rounded-xl shadow-md" type="submit">
                <svg width="30" height="30" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                    <path d="M8.48486 16.8905L25.4547 17.0491M16.8905 25.4547L17.0491 8.48491L16.8905 25.4547Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0">
                    <rect width="24" height="24" fill="white" transform="translate(0 16.8112) rotate(-44.4644)"/>
                    </clipPath>
                    </defs>
                </svg>
                Subir un nuevo Producto
                </button>                                  
             </form>
        </article> 
        @endcan
        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                @can('isAuth')
                <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                    <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
                        <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </x-nav-link>
                @endcan
                @foreach ($products as $product)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <article class="overflow-hidden rounded-lg">
                 
                        <div class="relative">
                            <img alt="Placeholder" src="{{ asset('storage') .'/'.$product->image}}" class="w-full">
                        </div>

        @can('isAuth')
        <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
            <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        @endcan

        
        <article class="max-w-screen-xl mx-auto px-4">
            <div class=" ml-6 flex flex-wrap">

                @foreach($products as $product)
                <div class=" px-1 w-full flex flex-col p-6 sm:w-1/2 lg:w-1/3">
                    <section class="w-72 h-96 shadow-lg rounded-xl">
                        <header class="">
                            <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{ asset('storage') .'/'. $product->image}}">
                        </header>

                        <section class="px-4">
                            <div class="block py-2">
                                <h2 class="productTitle">{{$product->name}}</h2>
                                <h3 class="productProductor">Productor: {{$artisan->name}}</h3>
                            </div>
                            <div class="block py-1">
                                <p class="productDescription">
                                {{$product->description}}
                                </p>
                            </div>
                            <div class="block py-2 flex items-center justify-around">
                                <p class="inline-block productPrice">{{$product->price}} €</p>
                            @can('isAuth')
                                @if ($product->stock > $product->sold)
                                    <div class="grid justify-items-center">
                                        <p class="text-sm">Añadir al carrito:</p>
                                        <x-counter></x-counter>
                                    </div>
                                @else 
                                    <p class="text-lg beigeAmasoBg leading-4">Producto agotado</p>
                                @endif
                            @endcan
                            @can('isArtisan')
                                <form action="{{ route('editProduct', ['id' => $product->id]) }}" method="get">
                                    <button type="submit">                      
                                        <svg class="inset-x-0 bottom-0 h-16 ..."  width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="19" cy="19" r="19" fill="#81A78C"/>
                                        <path d="M24.3636 10.0204C24.6138 9.75297 24.9131 9.53966 25.2441 9.39291C25.575 9.24617 25.9309 9.16892 26.2911 9.16569C26.6513 9.16246 27.0085 9.23331 27.3418 9.37409C27.6752 9.51488 27.978 9.72279 28.2327 9.98569C28.4874 10.2486 28.6888 10.5612 28.8252 10.9053C28.9616 11.2494 29.0302 11.6181 29.0271 11.9899C29.024 12.3617 28.9491 12.7291 28.807 13.0707C28.6648 13.4123 28.4582 13.7213 28.1991 13.9796L27.1236 15.0898L23.2881 11.1306L24.3636 10.0204V10.0204ZM21.3704 13.1102L10.0063 24.8408V28.8H13.8418L25.2072 17.0694L21.369 13.1102H21.3704Z" fill="white"/>
                                        </svg>
                                    </button>
                                </form> 
                                
                                <form action="{{ route('deleteProduct', ['id' => $product->id]) }}"  method="POST">
                                    <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
                                        <x-slot name="trigger">
                                                <button type="button" @click="on = true">
                                                        <svg class="inset-x-10 bottom-0 h-16 ..." width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="19" cy="19" r="19" fill="#DAB162"/>
                                                            <path d="M17 19V25M21 19V25M11 15H27M26 15L25.133 27.142C25.0971 27.6466 24.8713 28.1188 24.5011 28.4636C24.1309 28.8083 23.6439 29 23.138 29H14.862C14.3561 29 13.8691 28.8083 13.4989 28.4636C13.1287 28.1188 12.9029 27.6466 12.867 27.142L12 15H26ZM22 15V12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11H17C16.7348 11 16.4804 11.1054 16.2929 11.2929C16.1054 11.4804 16 11.7348 16 12V15H22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                </button>
                                            </x-slot>
                                            ¿Está seguro de que desea eliminar este producto?
                                    </x-modal>
                                    @method('DELETE')
                                    {{ csrf_field() }} 
                                </form> 
                            @endcan
                            </div>
                        </section>
                    </section>
                </div>
                @endforeach
            </div>
        </article>
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