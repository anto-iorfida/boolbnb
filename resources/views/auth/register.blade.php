@extends('layouts.app')

@section('content')
    <main>
        <div class="my-wrap py-5">
            <div class="my-container-register">
                <div class="justify-content-center">
                    <div class="card p-5">
                        <div class="card-body">
                            <form id="register-form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="align-items-center">
                                    <div class="text-center mb-4">
                                        <div class="img-logo-register">
                                            <img src="{{ Vite::asset('resources/img/logo-boolbnb.png') }}"
                                                class="img-fluid" alt="Logo Bool BnB">
                                        </div>
                                        <p class="fs-6 mt-3">
                                            Registrati per avere accesso al nostro sito
                                            <span class="color-bnb">BOOLBNB</span>
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="text-center mb-4">Welcome</h3>
                                        <div class="mb-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required
                                                placeholder="Enter Name and Lastname" autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required
                                                placeholder="Enter Email" autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="date_birth" type="date"
                                                class="form-control @error('date_birth') is-invalid @enderror"
                                                name="date_birth" value="{{ old('date_birth') }}" required
                                                autocomplete="date_birth" autofocus>
                                            @error('date_birth')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password" required
                                                autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div id="password-length-error" class="invalid-feedback d-flex justify-content-center"></div>
                                        </div>
                                        <div class="mb-4">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                            <div id="password-match-error" class="invalid-feedback d-flex justify-content-center"></div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="my-btn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // JavaScript per validazione aggiuntiva
        document.getElementById('register-form').addEventListener('submit', function(event) {
            const dateOfBirthField = document.getElementById('date_birth');
            const dateOfBirth = new Date(dateOfBirthField.value);
            const currentDate = new Date();
            const minAge = 18;
            const maxAge = 120;
            const minDate = new Date(currentDate.getFullYear() - maxAge, currentDate.getMonth(), currentDate.getDate());
            const maxDate = new Date(currentDate.getFullYear() - minAge, currentDate.getMonth(), currentDate.getDate());

            let errorMessage = '';
            let dateError = false;

            // Validazione data di nascita
            if (dateOfBirth > currentDate) {
                errorMessage = 'La data di nascita non può essere nel futuro.';
                dateError = true;
            } else {
                let age = currentDate.getFullYear() - dateOfBirth.getFullYear();
                const birthDateThisYear = new Date(currentDate.getFullYear(), dateOfBirth.getMonth(), dateOfBirth.getDate());

                if (birthDateThisYear > currentDate) {
                    age--;
                }

                if (age < minAge) {
                    errorMessage = 'Devi avere almeno ' + minAge + ' anni.';
                    dateError = true;
                } else if (age > maxAge) {
                    errorMessage = 'Devi avere meno di ' + maxAge + ' anni.';
                    dateError = true;
                }
            }

            if (dateError) {
                const errorElement = document.createElement('div');
                errorElement.className = 'invalid-feedback d-flex justify-content-center';
                errorElement.innerHTML = '<strong>' + errorMessage + '</strong>';

                // Rimuovi eventuali messaggi di errore preesistenti
                const existingError = dateOfBirthField.nextElementSibling;
                if (existingError && existingError.classList.contains('invalid-feedback')) {
                    existingError.remove();
                }

                // Inserisci il messaggio di errore dopo l'elemento dateOfBirthField
                dateOfBirthField.parentNode.insertBefore(errorElement, dateOfBirthField.nextSibling);

                // Imposta il focus sul campo data di nascita
                dateOfBirthField.focus();

                // Impedisce l'invio del form
                event.preventDefault();
                return false;
            }

            // Validazione lunghezza password
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password-confirm');
            let passwordError = false;
            let passwordErrorMessage = '';

            if (passwordField.value.length < 8) {
                passwordErrorMessage = 'La password deve contenere almeno 8 caratteri.';
                passwordError = true;
            }

            if (passwordField.value !== confirmPasswordField.value) {
                passwordErrorMessage += ' Le password non corrispondono.';
                passwordError = true;
            }

            if (passwordError) {
                const passwordLengthErrorElement = document.getElementById('password-length-error');
                passwordLengthErrorElement.innerHTML = passwordErrorMessage.includes('8 caratteri') ? '<strong>' + passwordErrorMessage + '</strong>' : '';
                const passwordMatchErrorElement = document.getElementById('password-match-error');
                passwordMatchErrorElement.innerHTML = passwordErrorMessage.includes('non corrispondono') ? '<strong>' + passwordErrorMessage + '</strong>' : '';

                // Impedisce l'invio del form
                event.preventDefault();
                return false;
            }

            return true;
        });
    </script>
@endsection
