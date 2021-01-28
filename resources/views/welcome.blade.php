<x-app-layout>
    <img class="w-full" src="./image/cover.jpeg">

    <div class="md:container md:mx-auto p-8 flex justify-center text-8l font-bold">
        <div class="textManifiesto">
            <h3 class="textManifiesto text-center font-bold">MANIFIESTO
                <br>
                Nuestros alimentos tienen orígenes cercanos, la relación con nuestros proveedores está basada en la vertiente humana por encima de la comercial.
                <br>
                Ponemos el foco en el origen de los alimentos, siempre respetando su temporalidad.
                Tenemos una relación con nuestros proveedores que va más allá de la comercial.
                <br>
                Creamos valor económico, medioambiental y social; contribuimos al bienestar y al progreso de las generaciones presentes y futuras.
            </h3>
        </div>

    </div>
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
        
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                    <div class="beigeAmasoBg rounded-full fixed bottom-20 right-10 z-40 shadow-2xl buttomDesktop buttomPhone">
                        <svg class="beigeLight w-full text-center p-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </x-nav-link>
            </div>
            @foreach ($products as $product)
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <article class="overflow-hidden rounded-lg">

                    <div class="relative">
                        <img alt="Placeholder" class="w-full" src="{{ asset('storage') .'/'. $product->image}}">
                    </div>

                    <header class="font-bold text-xl mb-2">
                        <div class="px-6 py-4">
                            {{$product->name}}
                        </div>
                        <div class="px-6 py-4 text-sm">
                            <a href="/artisan/{{$product->artisans->slug}}">Productor: {{$product->artisans->name}} </a>
                        </div>
                        <div class="ml-2 text-grey-darker text-base">
                            {{$product->description}}
                        </div>
                    </header>
                    <div class="px-4 py-4 md:px-10">
                        <p class="py-4"> {{$product->price}} €</p>
                        <div class="relative">
                            @if ($product->stock > $product->sold)
                                <div class="custom-number-input h-12 w-32 absolute bottom-2 right-1">
                                    <p class="textManifiesto text-base font-bold">Añadir al carrito</p>                                
                                   <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                        <button data-action="decrement" class="counter greenLightBg beigeLight h-full w-20 rounded-l-2xl cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin">
                                                <a href="{{ route('removeProductCart' , $product->id) }}">-</a>
                                            </span>
                                        </button>
                                        <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-12 greenAmasoBg font-semibold text-md   md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                                        <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-20 rounded-r-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">
                                                <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
                                            </span>
                                        </button>
                                    </div>      
                                @else
                                <p class="greenAmaso">Sold Out</p>
                                @endif

                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        {!! $products->links() !!}
    </div>

    

</x-app-layout>