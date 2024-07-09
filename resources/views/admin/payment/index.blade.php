@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="container-payment-empty">
    </div>

    <div class="container-payment-form">
        <h2>Inserisci un metodo di pagamento</h2>
        <div id="dropin-container"></div>

        <form id="payment-form" action="{{ route('admin.payment.checkoutSucceeded') }}" method="POST">
            @csrf
            <input type="hidden" name="payment_Method_Nonce" id="nonce">
            <input type="hidden" name="sponsor_id" value="{{ $sponsor ? $sponsor->id : '' }}">

            @if ($sponsor)
            <div>
                <h2>Dettagli dello Sponsor</h2>
                <p>Nome: {{ $sponsor->name }}</p>
                <p>Id: {{ $sponsor->id }}</p>
                <p>Durata: {{ $sponsor->duration }} ore</p>
                <p>Prezzo: {{ $sponsor->price }}</p>
            </div>
            @else
            <p>Nessuno sponsor trovato per l'ID specificato.</p>
            @endif

            <div class="form-group">
                <label for="amount">Prezzo</label>
                <input type="number" class="form-control rounded-pill" id="amount" name="amount" value="{{ $sponsor->price }}" readonly>
            </div>

           <div class="w-100 row justify-content-center">
             <div class="col-12 col-md-2">
                <button type="submit" class=" w-100 btn btn-primary mt-5 rounded-pill px-5 d-flex justify-content-center" id="submit-payment">Acquista</button>
             </div>
           </div>
        </form>
    </div>
</div>

<!-- Braintree Client SDK -->
<script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let form = document.querySelector('#payment-form');
        let button = document.querySelector('#submit-payment');

        braintree.dropin.create({
            authorization: 'sandbox_pgnyxwzg_v8v2d8ds6x49rzj5',
            container: '#dropin-container'
        }, function (err, instance) {
            if (err) {
                console.error(err);
                return;
            }

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    });
</script>
@endsection


