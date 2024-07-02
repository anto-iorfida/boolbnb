@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form id="resend-verification-form" class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Your Email Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('resend-verification-form');
        form.addEventListener('submit', function(event) {
            // Reset error messages
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach(function(errorMessage) {
                errorMessage.remove();
            });

            // Validate email
            const emailInput = document.getElementById('email');
            if (!isValidEmail(emailInput.value)) {
                showError(emailInput, 'Please enter a valid email address.');
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
