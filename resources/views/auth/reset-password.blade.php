@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reset-password-form');
        form.addEventListener('submit', function(event) {
            // Reset error messages
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach(function(errorMessage) {
                errorMessage.remove();
            });

            // Validate email
            const emailInput = document.getElementById('email');
            if (!isValidEmail(emailInput.value)) {
                showError(emailInput, 'Inserisci un indirizzo email valido.');
                event.preventDefault();
                return;
            }

            // Validate password
            const passwordInput = document.getElementById('password');
            if (passwordInput.value.length < 8) {
                showError(passwordInput, 'La password deve contenere almeno 8 caratteri.');
                event.preventDefault();
                return;
            }

            // Validate password confirmation
            const passwordConfirmInput = document.getElementById('password-confirm');
            if (passwordInput.value !== passwordConfirmInput.value) {
                showError(passwordConfirmInput, 'Le password non corrispondono.');
                event.preventDefault();
                return;
            }
        });

        // Helper function to display error message
        function showError(input, message) {
            const errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback';
            errorElement.innerText = message;
            input.classList.add('is-invalid');
            input.parentNode.appendChild(errorElement);
        }

        // Helper function to validate email format
        function isValidEmail(email) {
            // Regular expression for email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });
</script>
@endsection
