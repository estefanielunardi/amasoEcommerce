<div class=" px-1 w-full flex flex-col p-6 sm:w-1/2 lg:w-1/3">
    <section class="w-72 h-96 shadow-lg rounded-xl">
        <header class="h-48 overflow-hidden">
            <img alt="Placeholder" class="rounded-xl rounded-b-none object-fill w-full" src="{{ asset('storage') .'/'. $product->image}}">
        </header>

        <section class="px-4">
            <div class="block py-2">
                <h2 class="productTitle">{{$product->name}}</h2>
                <h3 class="productProductor">Productor: {{$product->artisans->name}}</h3>
            </div>
            <div class="block py-1 h-12 overflow-auto">
                <p class="productDescription">
                    {{$product->description}}
                </p>
            </div>
            <div class="block py-2 flex items-center justify-around">
                @if ($product->stock > $product->sold)
                <p class="inline-block productPrice">{{number_format($product->price / 100,2)}} €</p>
                <div class="grid justify-items-center">
                    <p class="text-xs">Añadir al carrito:</p>
                    <div class="flex flex-row h-9 w-full rounded-lg relative bg-transparent mt-1 vollkorn">
                        <form action="{{ route('removeProductCart' , $product->id) }}" method="POST">
                            <button data-action="decrement" type="submit" class="counter greenLightBg beigeLight h-full w-9 rounded-l-2xl cursor-pointer outline-none">
                                <span class="m-auto text-2xl font-thin text-white">-</span>
                                @method('DELETE')
                                {{ csrf_field() }}
                            </button>
                        </form>
                        <input type="number" class="counter border-transparent outline-none focus:outline-none text-center w-10 greenAmasoBg font-semibold text-xl  md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                        <button data-action="increment" class="counter  greenLightBg  beigeLight  h-full w-9 rounded-r-2xl cursor-pointer outline-none">
                            <span class="m-auto text-2xl font-thin text-white">
                                <a href="{{ route('cartAddProduct' , $product->id) }}">+</a>
                            </span>
                        </button>
                    </div>
                </div>
                @else
                <p class="text-lg beigeAmasoBg p-1 mt-4 leading-4">Producto agotado</p>
                @endif
            </div>
        </section>
    </section>
</div>

