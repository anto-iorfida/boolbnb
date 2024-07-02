@extends('layouts.app')

@section('content')
    <div class="my-wrap my-login">
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center w-100 mb-3">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fa-regular fa-user fs-1"></i>
                                    <div>
                                        <h3 class="">Login</h3>
                                    </div>
                                </div>
                            </div>

                            <form id="login-form" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4 row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="E-Mail Address"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-check d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="my-btn-login">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
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
    </div>

    <script>
        // JavaScript per validazione aggiuntiva
        document.getElementById('login-form').addEventListener('submit', function(event) {
            var emailField = document.getElementById('email');
            var passwordField = document.getElementById('password');

            // Validazione email
            if (!isValidEmail(emailField.value)) {
                alert('Please enter a valid email address.');
                emailField.focus();
                event.preventDefault();
                return false;
            }

            // Validazione password
            if (passwordField.value.length < 6) { // Esempio: almeno 6 caratteri
                alert('Password must be at least 6 characters long.');
                passwordField.focus();
                event.preventDefault();
                return false;
            }

            return true;
        });

        // Funzione per la validazione dell'email (se necessario)
        function isValidEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    </script>
@endsection
