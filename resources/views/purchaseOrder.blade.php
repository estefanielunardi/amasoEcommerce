<x-app-layout>
    <section class="flex justify-center mt-16">
        <h1 class="title pb-8">Selecciona una dirección de envío</h1>
    </section>

    <section class="container md:container md:mx-auto flex justify-center">
        <div class="box-border bg-white h-128 w-96">
            <form method="POST" action="{{ route('purchase') }}">
                @method('PUT')
                @csrf
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="direction" class="font-serif">{{ __('Dirección postal') }}</label>
                    <input type="text" id="direction" placeholder="Calle, número, piso, puerta" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="direction" required autocomplete="direction" autofocus>
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="location" class="font-serif">{{ __('Localidad/Provincia') }}</label>
                    <input type="text" id="location" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="location" required autocomplete="location" autofocus>
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="postal" class="font-serif">{{ __('Código postal') }}</label>
                    <input type="number" id="postal" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="postal" required autocomplete="postal" autofocus>
                </div>

                <section class="mt-16 text-center pb-8">
                    <h1 class="flex justify-center title">Metodo de pago</h1>
                    <h3 class="flex justify-center greenAmaso">Tarjeta de crédito o débito</h3>
                </section>
                <section class="container md:container md:mx-auto flex justify-center">
                    <div class="box-border bg-white h-128 w-96">
                        <form>
                            <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="card" class="font-serif">{{ __('Número de tarjeta') }}</label>
                                <input placeholder="sin espacios ni simbolos" id="card" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="card" required autocomplete="card" autofocus>
                            </div>
                            <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="name" class="font-serif">{{ __('Titular de la tarjeta') }}</label>
                                <input type="text" id="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="name" required autocomplete="name" autofocus>
                            </div>
                            <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="nombre" class="font-serif">{{ __('Fecha de vencimiento') }}</label>
                                <input type="text" required pattern="([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)(0[1-9]|[12]\d|3[01])" placeholder="dd/mm/yy" id="date" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="date" required autocomplete="date" autofocus>
                            </div>

                    </div>
                </section>
                <section class="flex justify-center mt-10">
                    <h1 class="title pb-8">Revisa tu pedido</h1>
                </section>
                <section>
                    <div>
                        <div class="flex flex-col w-full justify-center">
                            <div class="flex flex-col w-full">
                                @foreach ($products as $product)
                                <div class="flex flex-row mb-3">
                                    <div class="flex flex-row justify-center pl-4 pt-5 greenLightBg text-white rounded-md w-full h-16 justify-between">
                                        <div class="flex flex-row justify-start">
                                            <p class="">{{$product->name}}</p>
                                        </div>
                                        <div class="flex flex-row justify-end">
                                            <p class="px-1">{{$product->amount}} Ud.</p>
                                            <p class="px-2">{{number_format($product->price / 100, 2)}} €</p>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>

                        </div>
                        <div class="flex justify-center pt-8">
                            <h2 class=" greenAmaso text-lg font-bold">Total: {{number_format($total, 2)}} €</h2>
                        </div>
                        <div class="flex justify-center p-4">
                            <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4 rounded-xl shadow-md">Tramitar Pedido</button>
                        </div>
            </form>
        </div>
    </section>
</x-app-layout>