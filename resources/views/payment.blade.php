<x-app-layout>
<form method="POST" action="{{ route('payment')}}">
@csrf
    <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}">
        Update Payment Method
    </button>
</form>

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
            console.log('eureka');
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
            console.log('eureka2');
        }
    });
</script>