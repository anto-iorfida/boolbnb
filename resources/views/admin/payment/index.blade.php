{{-- @extends('layouts.admin')

@section('content')
    <div class="container-payment-maxwidth">
        <div class="container-payment-empty">

        </div>

        <div class="container-payment-form">
            <h2> Inserisci un metodo di pagamento </h2>
            <div id="dropin-container">

            </div>
           <button type="button" class="btn btn-success" id="submit-button"> Conferma e attiva la promo </button>
            <form name="form" action="{{ route('admin.payment.process') }}" method="post">
                @csrf
                @method('POST')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="payment_Method_Nonce" id="nonce" placeholder=""
                            value="">
                    </div> 

           @if ($sponsor)
                <div>
                    <h2>Dettagli dello Sponsor</h2>
                    <p>Nome: {{ $sponsor->name }}</p>
                    <p>Id: {{ $sponsor->id}}</p>
                    <p>Durata: {{ $sponsor->duration }} ore</p>
                    <p>Prezzo: {{ $sponsor->price }}</p>
                    <!-- Altri dettagli dello sponsor se necessario -->
                </div>
            @else
                <p>Nessuno sponsor trovato per l'ID specificato.</p>
            @endif

            <form method="post" action="{{ route('admin.payment.process') }}">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="amount">Prezzo</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $sponsor->price }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nonce">Payment Method Nonce</label>
                    <div id="dropin-container"></div>
                    <input type="hidden" id="nonce" name="payment_method_nonce">
                </div>

                <button type="submit" class="btn btn-primary">Submit Payment</button>
            </form>

            

        </div>
    </div>

    <script>
        let button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: 'sandbox_pgnyxwzg_v8v2d8ds6x49rzj5',
            container: '#dropin-container'
        }, function(err, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection  --}}

@extends('layouts.admin')

@section('content')
<div class="container-payment-maxwidth">
    <div class="container-payment-empty">
    </div>

    <div class="container-payment-form">
        <h2>Inserisci un metodo di pagamento</h2>
        <div id="dropin-container"></div>

        <form id="payment-form" action="{{ route('admin.payment.process') }}" method="POST">
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
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $sponsor->price }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary" id="submit-payment">Submit Payment</button>
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


