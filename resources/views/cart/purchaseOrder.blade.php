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
                    <input type="text" id="direction" placeholder="Calle, número, piso, puerta" value="{{$user->direction}}" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="direction" required autocomplete="direction" autofocus>
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="location" class="font-serif">{{ __('Localidad/Provincia') }}</label>
                    <input type="text" id="location" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" value="{{$user->location}}" name="location" required autocomplete="location" autofocus>
                </div>
                <!-- <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="postal" class="font-serif">{{ __('Código postal') }}</label>
                    <input type="number" id="postal" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10"value="{{$user->postal}}" name="postal" required autocomplete="postal" autofocus>
                </div> -->

                <section class="mt-16 text-center pb-8">
                    <h1 class="flex justify-center title">Metodo de pago</h1>
                    <h3 class="flex justify-center greenAmaso">Tarjeta de crédito o débito</h3>
                </section>
                <section class="container md:container md:mx-auto flex justify-center">
                    <div class="box-border bg-white h-128 w-96">
                        <form>
                            <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="cardholder" class="font-serif">{{ __('Titular de la tarjeta') }}</label>
                                <input type="text" id="card-holder-name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="cardholder" value="{{$user->cardholder}}" required autocomplete="cardholder" autofocus>
                            </div>
                            <div id="card-element">
                            </div>
                            <!-- <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="card" class="font-serif">{{ __('Número de tarjeta') }}</label>
                                <input placeholder="sin espacios ni simbolos" id="card" value="{{$user->card}}"class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="card" required autocomplete="card" autofocus>
                            </div>
                            <div class="flex flex-col my-4 text-xl greenAmaso">
                                <label for="nombre" class="font-serif">{{ __('Fecha de vencimiento') }}</label>
                                <input type="text"required pattern="([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)(0[1-9]|[12]\d|3[01])" placeholder="dd/mm/yy" id="date" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10" name="expiring" required autocomplete="date" autofocus>
                            </div> -->

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
                            <button type="submit" id="card-button" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4 rounded-xl shadow-md" data-secret="{{ $intent->client_secret }}">Tramitar Pedido</button>
                        </div>
            </form>
        </div>
    </section>
</x-app-layout>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        );

        if (error) {
            console.log(error);
        } else {
            console.log('success');
        }
    });

    cardButton.addEventListener('click', async (e) => {
        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: {
                    name: cardHolderName.value
                }
            }
        );

        if (error) {
            console.log(error);
        } else {
            console.log('success');
        }
    });

    paymentRequest.on('paymentmethod', function(ev) {

        stripe.confirmCardPayment(
            clientSecret, {
                payment_method: ev.paymentMethod.id
            }, {
                handleActions: false
            }
        ).then(function(confirmResult) {
            if (confirmResult.error) {

                ev.complete('fail');
            } else {

                ev.complete('success');

                if (confirmResult.paymentIntent.status === "requires_action") {

                    stripe.confirmCardPayment(clientSecret).then(function(result) {
                        if (result.error) {
                            console.log(result.error);
                        } else {
                            console.log('success');
                        }
                    });
                } else {
                    console.log('success');
                }
            }
        });
    });
</script>