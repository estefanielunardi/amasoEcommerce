<x-app-layout>
    <section class="block pt-16 md:ml-20 ml-10 mr-10 ">
            <section class=" flex flex-col md:flex-row">
                <article class="flex justify-start pb-6">
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
                    <div class="container">
                        <x-star-ratting :midRate="$midRate" :votesCount="$votesCount" :product="$product"/>
                    </div>
                    </section>
                    @if(auth()->id() == $product->artisans->user_id)
                    <div class="flex flex-row">
                        <button class= "greenLightBg flex flex-row align-start text-sm text-white mt-2 px-3 py-2  rounded-xl shadow-md mr-14">               
                            <svg  width="24" height="24" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.0582 5.7376C21.3442 5.43197 21.6862 5.18819 22.0644 5.02048C22.4427 4.85277 22.8494 4.76449 23.2611 4.7608C23.6727 4.75711 24.0809 4.83808 24.4619 4.99897C24.8428 5.15987 25.189 5.39748 25.48 5.69794C25.7711 5.9984 26.0013 6.35568 26.1571 6.74895C26.313 7.14222 26.3915 7.56359 26.3879 7.98849C26.3843 8.41338 26.2988 8.83329 26.1363 9.2237C25.9739 9.61411 25.7377 9.96721 25.4416 10.2624L24.2125 11.5312L19.8291 7.0064L21.0582 5.7376ZM17.6374 9.2688L4.6499 22.6752V27.2H9.0333L22.0223 13.7936L17.6358 9.2688H17.6374Z" fill="white"/>
                            </svg> 
                            <a class= "text-sm pl-2 pt-1 exo" href="{{route('editProduct', $product->id) }}" method="get">
                                Editar producto
                            </a>             
                        </button>
                        <form class="" method="POST" action="{{ route('deleteProduct', $product->id) }}">
                            <x-modal title="¿Eliminar perfil?" submit-label="Eliminar">
                                <x-slot name="trigger">
                                    <button type="button" @click="on = true" class= "greenLightBg flex flex-row align-start text-sm text-white mt-2 px-3 py-2  rounded-xl shadow-md">
                                        <svg width="24" height="24"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <p class="text-sm pl-2 pt-1 exo">
                                            Eliminar Producto
                                        </p>
                                    </button>
                                </x-slot>
                                ¿Está seguro de que desea eliminar su perfil?
                            </x-modal>
                            @method('DELETE')
                            {{ csrf_field() }}
                        </form>
                    </div>
                    @endif
                </article>
            </section>
           
        <section class="lg:ml-20 ml-10 mt-4">
            <div class="flex flex-col ">
                @if(count($product->allergens) !== 0)
                <x-product.page.allergens :product=$product/>
                @endif
            </div>
        </section>
        <section>
            <div class="flex lg:ml-20 ml-10 mt-8 mr-10">
                <p class="block greenAmaso vollkorn text-md mb-10 font-light w-full lg:w-2/3 pb-5"> {{$product->description}} </p>
            </div>
        </section>
        <hr>
        <section class="lg:ml-20 ml-10 mr-10">
            <h2 class=" title pb-2 mt-8">Comentarios del producto</h2>
            <x-product.page.comments :comments=$comments :replies=$replies :product=$product/>           
        </section> 
</x-app-layout>


