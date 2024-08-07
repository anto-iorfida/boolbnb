@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form id="reset-password-form" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="email-error" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript per validazione aggiuntiva
    document.getElementById('reset-password-form').addEventListener('submit', function(event) {
        const emailField = document.getElementById('email');
        const emailError = document.getElementById('email-error');

        let valid = true;

        // Reset dei messaggi di errore
        emailError.innerHTML = '';
        emailField.classList.remove('is-invalid');

        // Validazione email
        if (!isValidEmail(emailField.value)) {
            emailError.innerHTML = '<strong>Per favore, inserisci un indirizzo email valido.</strong>';
            emailField.classList.add('is-invalid');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    // Funzione per la validazione dell'email
    function isValidEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>
@endsection
