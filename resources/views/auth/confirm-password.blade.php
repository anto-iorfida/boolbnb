@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Conferma Password') }}</div>

                <div class="card-body">
                    {{ __('Per favore, conferma la tua password prima di continuare.') }}

                    <form id="password-confirm-form" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" pattern=".{8,}" title="La password deve contenere almeno 8 caratteri.">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="password-error" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Conferma Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Hai dimenticato la tua password?') }}
                                </a>
                                @endif
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
    document.getElementById('password-confirm-form').addEventListener('submit', function(event) {
        const passwordField = document.getElementById('password');
        const passwordError = document.getElementById('password-error');

        // Reset dei messaggi di errore
        passwordError.innerHTML = '';
        passwordField.classList.remove('is-invalid');

        // Validazione password
        if (passwordField.value.length < 8) { // Almeno 8 caratteri
            passwordError.innerHTML = '<strong>La password deve contenere almeno 8 caratteri.</strong>';
            passwordField.classList.add('is-invalid');
            event.preventDefault();
        }
    });
</script>
@endsection
