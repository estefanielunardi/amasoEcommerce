<x-app-layout>
            <img class="w-full" src="./image/cover.jpeg">

        <div class="md:container md:mx-auto p-8 flex justify-center text-8l font-bold">
        <div class="textManifiesto"> 
        <p class="textManifiesto text-center font-bold">MANIFIESTO
        <br>
         Nuestros alimentos tienen orígenes cercanos, la relación con nuestros proveedores está basada en la vertiente humana por encima de la comercial.
        <br>
        Ponemos el foco en el origen de los alimentos, siempre respetando su temporalidad.
        Tenemos una relación con nuestros proveedores que va más allá de la comercial.  
        <br>
        Creamos valor económico, medioambiental y social; contribuimos al bienestar y al progreso de las generaciones presentes y futuras.</p>
        </div>
       
        </div>
        <div class= "container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                @foreach ($products as $product)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                        <article class="overflow-hidden rounded-lg">
                        
                        <div class="relative">
                            <img alt="Placeholder" class="w-full" src="{{$product->image}}">
                                    @if ($product->stock < $product->sold)
                                    <div class="custom-number-input h-10 w-32 absolute bottom-2 right-1">
                                        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                            <button data-action="decrement" class="bg-opacity-60 bg-green-200 text-white hover:bg-green-400 h-full w-20 rounded-l-2xl cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                            </button>
                                            <input type="number" class="bg-opacity-30 border-transparent outline-none focus:outline-none text-center w-12 bg-green-600 font-semibold text-md   md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                                            <button data-action="increment" class="bg-opacity-60 bg-opacity-20 bg-green-200 text-white hover:bg-green-400 h-full w-20 rounded-r-2xl cursor-pointer outline-none">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @else
                                        <p class="text-green-600">Sold Out</p>
                                    @endif
                         </div>

                            <header class="font-bold text-xl mb-2">
                                <div class="px-6 py-4">
                                    {{$product->name}}
                                </div>
                                <div class="px-6 py-4 text-sm">
                                   <a href="#">Productor:  {{$product->artisan}} </a> 
                                </div>
                                <div class="ml-2 text-grey-darker text-base">
                                    {{$product->description}}
                                </div>
                            </header>
                            <div class="px-4 py-4 md:px-10">
                                <p class="py-4"> {{$product->price}} €</p>
                                <div class="flex flex-wrap pt-8 justify-around">
                                    
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            {!! $products->links() !!}
        </div>
</x-app-layout>
   