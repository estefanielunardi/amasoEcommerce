<x-app-layout>
    <header> 
        <h1 class="title ">Tu Carrito</h1>
    </header>
    <section>
        @if (count($products) === 0)
        <section class="p-12 w-full h-96 content-center flex-wrap flex justify-center">
            <p class="beigeAmaso text-xl text-center">
                Aún no has comprado ningun producto! ¿Que estas esperando?
            </p>
        </section>
        @endif
        <section>
            @foreach($products as $product)
            <article class="flex flex-row pb-5 h-20 items-center">
                <form method="POST" action="{{ route('removeProductCart', $product->id) }}">
                    <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
                        <x-slot name="trigger">
                            <button type="button" @click="on = true" class="text-xl font-bold greenAmaso mt-2 px-4 py-8 rounded-xl">
                                X
                            </button>
                        </x-slot>
                        ¿Está seguro de que desea eliminar este producto del carrito?
                    </x-modal>
                    @method('DELETE')
                    {{ csrf_field() }}
                </form>
                <div class="flex flex-row static items-center greenLightBg text-white rounded-md h-14 w-80">
                    <div class="flex flex-row">
                        <div class="hidden md:contents w-14 h-14 overflow-hidden rounded-xl m-1">
                            <img class="object-fill h-full" src="{{ asset('storage') .'/'. $product->image}}" />
                        </div>
                        <p class="text-xs px-3">{{$product->name}}</p>
                    </div>
                    <div class="flex flex-row w-52 absolute right-4 justify-between">
                        <p>Counter</p>
                        <p class="">{{$product->amount}} Ud.</p>
                        <p class="">{{number_format($product->price / 100, 2)}} €</p>
                    </div>
                </div>
            </article>
            @endforeach
        </section>

                       <!--<div class="flex flex-row justify-end">
                            <div class="flex flex-row h-9 w-full rounded-lg relative bg-transparent mt-1 exo">
                                <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                                    <button data-action="decrement" type="submit" class="counter greenLightBg beigeLight h-full w-9 rounded-l-2xl cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin text-white">-</span>
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </button>
                                </form>
                                <input type="number" max="{{$product->stock}}" class="counter border-transparent outline-none focus:outline-none text-center w-10 greenAmasoBg font-semibold text-xl  md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="{{$product->amount}}"></input>
                                @if($product->stock > $product->amount)
                                <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-9 rounded-r-2xl cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin text-white">
                                        <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
                                    </span>
                                </button>
                                @else
                                <p class="text-sm p-2">Agotado</p>
                                @endif
                            </div>
                        </div>-->
                  
        
        <div class="flex justify-end p-4 pr-24"">
                <h2 class=" greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
        </div>
        <form method="GET" action="{{ route('purchaseOrder') }}">
            <div class="flex justify-end p-4 pr-10">
                <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Pagar</button>
            </div>
        </form>
    

</x-app-layout>