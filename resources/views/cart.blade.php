<x-app-layout>
<h1 class="tuCarritoTitle">Tu Carrito</h1>
    <section>
        <div>
            <div class="flex flex-col p-10 justify-center">
                <div class="flex flex-col w-full mt-10">
                    <div class="greenAmaso w-full flex flex-row justify-end">
                        <p class="p-4">Ud.</p>
                        <p class="p-4">Precio</p>
                    </div>    
                    @foreach ($products as $product)    
                    <div class="flex flex-row" >
                    <form method="POST" action="{{ route('removeProductCart', $product->id) }}">
                        <x-modal title="¿Eliminar producto?" submit-label="Eliminar">
                            <x-slot name="trigger">
                                <button type="button" @click="on = true" class="text-l greenAmaso mt-2 px-4 py-8 rounded-xl">
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
                                <img class="w-16 rounded"src="{{ asset('storage') .'/'. $product->image}}"/>    
                                <p class="p-4">{{$product->name}}</p>  
                            </div>
                            <div class="flex flex-row justify-end"> 
                                <p class="p-4">{{$product->amount}}</p>    
                                <p class="p-4">{{number_format($product->price / 100, 2)}} €</p>                       
                            </div>
                        </div>
                    </div>            
                    @endforeach
                </div>
           
            </div>
            <div class="flex justify-end p-4 pr-24"">
                <h2 class="greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
            </div>
            <form>
                <div class="flex justify-end p-4 pr-10">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">Tramitar Pedido</button>
                </div>
            </form>
        </div>
    </section>

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