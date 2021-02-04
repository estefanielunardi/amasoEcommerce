<x-app-layout>
    <header> 
        <h1 class="title py-12 pl-8 md:p-12">Tu Carrito</h1>
    </header>
    <section>
        @if (count($products) === 0)
        <section class="p-12 w-full h-96 content-center flex-wrap flex justify-center">
            <p class="beigeAmaso text-xl text-center">
                Aún no has comprado ningun producto! ¿Que estas esperando?
            </p>
        </section>
        @endif
        <section class="flex flex-col">
            @foreach($products as $product)
            <article class="flex flex-row h-20 items-center px-5 mb-5 md:ml-20 lg:ml-36 xl:ml-56">
                <form method="POST" action="{{ route('removeProductCart', $product->id) }}">
                    <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
                        <x-slot name="trigger">
                            <button type="button" @click="on = true" class="text-xl font-bold greenAmaso mt-2 px-3 py-8 rounded-xl">
                                X
                            </button>
                        </x-slot>
                        ¿Está seguro de que desea eliminar este producto del carrito?
                    </x-modal>
                    @method('DELETE')
                    {{ csrf_field() }}
                </form>
                <div class="flex flex-row relative items-center rounded-md shadow-md greenLightBg text-white h-14 w-full md:w-3/4 md:h-20">
                    <div class="flex flex-row md:w-full w-32">
                        <p class="px-3 md:pl-5 text-sm md:text-lg ">{{$product->name}}</p>
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
                                        <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
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
            </article>
            @endforeach
        <div class="flex justify-center p-4 pt-20">
            <h2 class=" greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
        </div>
        <div class="flex justify-center p-7">
            <form method="GET" action="{{ route('purchaseOrder') }}">
                <div class="">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Pagar</button>
                </div>
            </form>
        </div>
        </section>
                  
        
    

</x-app-layout>