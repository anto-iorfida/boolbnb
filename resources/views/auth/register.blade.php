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
                                        </div>
                                        <div class="mb-4">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                            <div id="password-error" class="invalid-feedback d-flex justify-content-center"></div>
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
            const minDate = new Date(currentDate.getFullYear() - maxAge, currentDate.getMonth(), currentDate.getDate() + 1); // Aggiunto +1 per evitare che una data 120 anni fa sia valida
            const maxDate = new Date(currentDate.getFullYear() - minAge, currentDate.getMonth(), currentDate.getDate());

            let errorMessage = '';

            // Calcolo dell'età
            const age = currentDate.getFullYear() - dateOfBirth.getFullYear();
            const birthDateThisYear = new Date(currentDate.getFullYear(), dateOfBirth.getMonth(), dateOfBirth.getDate());

            if (birthDateThisYear > currentDate) {
                age--;
            }

            // Validazione data di nascita
            if (dateOfBirth > currentDate || dateOfBirth < minDate) {
                errorMessage = 'La data di nascita deve essere valida e l\'età deve essere compresa tra ' + minAge + ' e ' + maxAge + ' anni.';
            }

            // Validazione lunghezza password
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password-confirm');
            if (passwordField.value.length < 8 || confirmPasswordField.value.length < 8) {
                errorMessage += ' Le password devono contenere almeno 8 caratteri.';
            }

            // Validazione password e conferma password identiche
            if (passwordField.value !== confirmPasswordField.value) {
                errorMessage += ' Le password non corrispondono.';
            }

            // Mostra il messaggio di errore appropriato
            if (errorMessage) {
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

            return true;
        });
    </script>
@endsection
