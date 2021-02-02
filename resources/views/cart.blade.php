<x-app-layout>
    <h1 class="tuCarritoTitle">Tu Carrito</h1>
    <section>
        <div>
            <div class="flex flex-col p-10 justify-center">
                <div class="flex flex-col w-full mt-10">
                    @foreach ($products as $product)
                    <div class="flex flex-row">
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
                        <div class="flex flex-row justify-center m-2 p-4 greenLightBg text-white rounded-md w-full justify-between">
                            <div class="flex flex-row justify-start">
                                <img class="w-16 rounded" src="{{ asset('storage') .'/'. $product->image}}" />
                                <p class="p-4">{{$product->name}}</p>
                            </div>
                            <div class="flex flex-row justify-start">
                                <div class="flex flex-row h-9 w-full rounded-lg relative bg-transparent mt-1 exo">
                                    <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                                        <button data-action="decrement" type="submit" class="counter greenLightBg beigeLight h-full w-9 rounded-l-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin text-white">-</span>
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </button>
                                    </form>
                                    <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-10 greenAmasoBg font-semibold text-xl  md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="{{$product->amount}}"></input>
                                    <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-9 rounded-r-2xl cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin text-white">
                                            <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-row justify-end">
                                <p class="p-4">{{$product->amount}} Ud.</p>
                                <p class="p-4">{{number_format($product->price / 100, 2)}} €</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="flex justify-end p-4 pr-24"">
                <h2 class=" greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
            </div>
            <form method="GET" action="{{ route('purchaseOrder') }}">
                <div class="flex justify-end p-4 pr-10">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Pagar</button>
                </div>
            </form>
        </div>
    </section>

</x-app-layout>