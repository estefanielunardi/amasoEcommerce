<x-app-layout>
    <header> 
        <h1 class="title py-12 pl-8 md:p-12">Tu Carrito</h1>
    </header>
    <section>
        @if (count($products) > 0)
            <section class="flex flex-col">
                @foreach($products as $product)
                <article class="flex flex-row h-20 items-center px-5 mb-5 md:ml-20 lg:ml-36 xl:ml-56">
                    
                    <div class="flex flex-row relative items-center rounded-md shadow-md greenLightBg text-white h-14 w-full md:w-3/4 md:h-20">
                        <div class="flex flex-row md:w-full w-32">
                            <a href="{{ route('productPage' , $product->id) }}"><p class="px-3 md:pl-5 text-sm md:text-lg ">{{$product->name}}</p></a>
                            {{-- <a href="{{ route('profile' , $product->artisans->id) }}"><p class="px-3 md:pl-5 text-sm md:text-lg ml-4">{{$product->artisans->id}}</p></a> --}}
                        </div>
                        <div class="flex text-sm flex-row w-44 md:w-48 absolute right-4 justify-between">
                            @if($product->stock > $product->amount)
                            <div class="flex flex-row justify-end">
                                <div class="flex flex-row h-6 w-full relative bg-transparent exo text-sm shadow-md">
                                    <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                                        <button data-action="decrement" type="submit" class="counter greenAmasoBg  h-full w-6 cursor-pointer outline-none">
                                            <span class="m-auto font-thin text-white">-</span>
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </button>
                                    </form>
                                    <input type="number" max="{{$product->stock}}" class="counter border-transparent outline-none focus:outline-none text-center w-6 greenLightBg md:text-basecursor-default flex items-center text-white outline-none" name="custom-input-number" value="{{$product->amount}}"></input>
                                    <button data-action="increment" class="counter  greenAmasoBg  h-full w-6 cursor-pointer outline-none">
                                        <span class="m-auto font-thin text-white">
                                            <a href="{{ route('cartIncrementProduct' , $product->id) }}">+</a>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            @else
                            <div class="flex flex-col relative">
                                <div class="flex flex-row justify-end">
                                    <div class="flex flex-row h-6 w-full relative bg-transparent exo text-sm shadow-md">
                                        <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                                            <button data-action="decrement" type="submit" class="counter greenAmasoBg  h-full w-6 cursor-pointer outline-none">
                                                <span class="m-auto font-thin text-white">-</span>
                                                @method('DELETE')
                                                {{ csrf_field() }}
                                            </button>
                                        </form>
                                        <input type="number" max="{{$product->stock}}" class="counter border-transparent outline-none focus:outline-none text-center w-6 greenLightBg md:text-basecursor-default flex items-center text-white outline-none" name="custom-input-number" value="{{$product->amount}}"></input>
                                        <button class="counter bg-gray-500  h-full w-6 cursor-pointer outline-none">
                                            <span class="m-auto font-thin text-white">
                                                <a href="">+</a>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-xs absolute top-6 left-2 md:left-1 md:text-sm md:top-7">¡Agotado!</p>
                            </div>
                            @endif
                            <p class="pt-1">{{$product->amount}} Ud.</p>
                            <p class="pt-1">{{number_format($product->price / 100, 2)}} €</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('deleteProductCart', $product->id) }}">
                        <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
                            <x-slot name="trigger">
                                <button type="button" @click="on = true" class="text-xl font-bold greenAmaso mt-2 px-3 py-8 rounded-xl">
                                    <svg class="delete-icon" height="18pt" viewBox="-47 0 512 512" width="18pt" xmlns="http://www.w3.org/2000/svg"><path d="m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0"/><path d="m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0"/><path d="m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0"/><path d="m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0"/></svg>
                                </button>
                            </x-slot>
                            ¿Está seguro de que desea eliminar este producto del carrito?
                        </x-modal>
                        @method('DELETE')
                        {{ csrf_field() }}
                    </form>
                </article>
                @endforeach
            <div class="flex justify-center pt-20">
                <x-cart.buttons.delete-all></x-cart.buttons.delete-all>
            </div>
                
            <div class="flex justify-center p-4 pt-20">
                <h2 class="greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
            </div>
            <div class="flex justify-center p-7">
                <form method="GET" action="{{ route('purchaseOrder') }}">
                    <div class="">
                        <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Pagar</button>
                    </div>
                </form>
            </div>
            </section>
        @else
            <section class="p-12 w-full h-96 content-center flex-wrap flex justify-center">
                <p class="beigeAmaso text-xl text-center">
                    ¡Aún no has añadido ningún producto! ¿Qué estás esperando?
                </p>
            </section>
        @endif
                  
        
    

</x-app-layout>