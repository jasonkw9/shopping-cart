@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>{{ __('Payment') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method = "post" action = "{{route('process')}}" id="form">
            {{ csrf_field() }}
                <input id="card-holder-name" type="text">

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>

                <button id="card-button">
                    Process Payment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51HPPqEIo2PkdQxebUoZR31YU9ajZlh2g9ylaJ2Ox2oPl2OZTVHb8Ut3FfutGBvl5riaPjcQV8ClWmzMFKtOdiaEj00gP8RJ4Nj');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );

    if (error) {
        alert(error.message);
    } else {
        var payment_id = paymentMethod.id;
        createPayment(payment_id);
    }
});

var form = document.getElementById('form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
});

function createPayment(payment_id) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'payment_id');
    hiddenInput.setAttribute('value',payment_id);
    form.appendChild(hiddenInput);
    // Submit the form

    form.submit();

}
</script>
@endsection
