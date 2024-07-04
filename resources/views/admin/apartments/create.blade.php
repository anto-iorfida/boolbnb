@extends('layouts.admin')
@section('content')
    <div class="container py-3">
        <h2 class="fs-4 text-secondary">Inserisci nuovo appartamento</h2>

        <div class="alert alert-light" role="alert">
            <small>I campi con * vicino sono obbligatori</small>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="errorMessages" class="alert alert-danger" style="display: none;">
            <ul id="errorList"></ul>
        </div>
        <form id="apartmentForm" enctype="multipart/form-data">
            @csrf
            <div class="row edit">
                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label"><strong>Titolo appartamento *</strong></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    <div class="invalid-feedback" id="titleError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_rooms" class="form-label"><strong>Numero di Stanze *</strong></label>
                    <input type="number" class="form-control" id="number_rooms" name="number_rooms"
                        value="{{ old('number_rooms') }}" min="0">
                    <div class="invalid-feedback" id="number_roomsError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_beds" class="form-label"><strong>Numero di Letti *</strong></label>
                    <input type="number" class="form-control" id="number_beds" name="number_beds"
                        value="{{ old('number_beds') }}" min="0">
                    <div class="invalid-feedback" id="number_bedsError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_baths" class="form-label"><strong>Numero di Bagni</strong></label>
                    <input type="number" class="form-control @error('number_baths') is-invalid @enderror" id="number_baths"
                        name="number_baths" value="{{ old('number_baths') }}" min="1">
                    @error('number_baths')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="square_meters" class="form-label"><strong>Metri Quadrati</strong></label>
                    <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                        id="square_meters" name="square_meters" value="{{ old('square_meters') }}" min="0">
                    @error('square_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="thumb" class="form-label"><strong>Immagine copertina appartamento</strong></label>
                    <input type="file" class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                        name="thumb">
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="address" class="form-label"><strong>Indirizzo *</strong></label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                        autocomplete="off">
                    <div id="addressSuggestions" class="list-group"></div>
                    <div class="invalid-feedback" id="addressError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="images" class="form-label"><strong>Altre immagini dell'appartamento *</strong></label>
                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images"
                        name="images[]" multiple>
                    <div class="invalid-feedback" id="imagesError"></div>
                </div>
                <div class="mb-3 col-12">
                    <label for="description" class="form-label"><strong>Descrizione *</strong></label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    <div class="invalid-feedback" id="descriptionError"></div>
                </div>
                <div class="mb-3 mt-4">
                    <label for="checkbox"><strong>Servizi</strong></label>
                    <div class="row row-cols-4 mb-3 mt-3 p-3  g-3">
                        @foreach ($services as $service)
                            <div class="col">
                                <div class="form-check ">
                                    <label class="form-check-label " for="service-{{ $service->id }}">
                                        <div> <i class="{{ $service->icon }}"></i></div>
                                      <div>  {{ $service->name }}</div>
                                    </label>
                                    <input @checked(in_array($service->id, old('services', [])))
                                        class="btn btn-primary @error('services') is-invalid @enderror" type="checkbox"
                                        name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="invalid-feedback" id="servicesError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="visibility" class="form-label"><strong>Visibilità *</strong></label>
                    <select class="form-control" id="visibility" name="visibility">
                        <option value="1" {{ old('visibility') == '1' ? 'selected' : '' }}>Visibile</option>
                        <option value="0" {{ old('visibility') == '0' ? 'selected' : '' }}>Non Visibile</option>
                    </select>
                    <div class="invalid-feedback" id="visibilityError"></div>
                </div>
            </div>

            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
            <button type="button" id="validateBtn" class="btn btn-primary mb-5">Crea Appartamento</button>
        </form>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/services/services-web.min.js"></script>
    {{-- axios cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Quando il documento è caricato completamente
        document.addEventListener('DOMContentLoaded', function () {
            // Seleziona il form con l'ID 'apartmentForm'
            const form = document.getElementById('apartmentForm');
            // Seleziona il bottone con l'ID 'validateBtn'
            const validateBtn = document.getElementById('validateBtn');

            // Aggiunge un evento di click al bottone 'validateBtn'
            validateBtn.addEventListener('click', function () {
                // Chiama la funzione per pulire eventuali errori di validazione visualizzati
                clearValidationErrors();

                // Invia i dati del form all'endpoint di validazione usando Axios
                axios.post('{{ route('api.validate.apartment') }}', new FormData(form))
                    .then(response => {
                        // Se la validazione ha successo, logga un messaggio di conferma
                        console.log('Dati del form validati con successo.');

                        // Imposta l'azione del form per inviare i dati all'endpoint di salvataggio
                        form.action = '{{ route('admin.apartments.store') }}';
                        form.method = 'POST';
                        // Invia il form
                        form.submit();
                    })
                    .catch(error => {
                        // Se la risposta ha uno status 422, significa che ci sono errori di validazione
                        if (error.response.status === 422) {
                            // Ottieni gli errori di validazione dal server
                            const errors = error.response.data.errors;
                            // Chiama la funzione per visualizzare gli errori di validazione
                            displayValidationErrors(errors);
                        } else {
                            // Se c'è un altro tipo di errore, logga l'errore nella console
                            console.error('Errore durante la validazione dei dati:', error);
                        }
                    });
            });

            // Funzione per pulire gli errori di validazione visualizzati
            function clearValidationErrors() {
                // Rimuove la classe 'is-invalid' da tutti gli input che la contengono
                form.querySelectorAll('.is-invalid').forEach(input => {
                    input.classList.remove('is-invalid');
                });
                // Pulisce il testo di tutti gli elementi con la classe 'invalid-feedback'
                form.querySelectorAll('.invalid-feedback').forEach(errorFeedback => {
                    errorFeedback.textContent = '';
                });
            }

            // Funzione per visualizzare gli errori di validazione
            function displayValidationErrors(errors) {
                // Per ogni campo con errori
                Object.keys(errors).forEach(field => {
                    // Se il campo è 'services', gestisci l'errore in modo personalizzato
                    if (field === 'services') {
                        const errorMessage = 'Seleziona almeno un servizio.';
                        const errorFeedback = document.getElementById(`${field}Error`);
                        // Se esiste un elemento di feedback degli errori
                        if (errorFeedback) {
                            // Imposta il testo dell'elemento di feedback degli errori
                            errorFeedback.textContent = errorMessage;
                        }
                        // Trova tutti gli input di tipo checkbox per i servizi e aggiungi loro la classe 'is-invalid'
                        const serviceCheckboxes = form.querySelectorAll('input[name="services[]"]');
                        serviceCheckboxes.forEach(checkbox => {
                            checkbox.classList.add('is-invalid');
                        });
                    } else {
                        // Altrimenti, gestisci l'errore come di consueto
                        const errorMessage = errors[field][0];
                        const errorFeedback = document.getElementById(`${field}Error`);
                        // Se esiste un elemento di feedback degli errori
                        if (errorFeedback) {
                            // Imposta il testo dell'elemento di feedback degli errori
                            errorFeedback.textContent = errorMessage;
                            // Trova il campo di input corrispondente
                            const inputField = document.getElementById(field);
                            // Se esiste un campo di input
                            if (inputField) {
                                // Aggiungi la classe 'is-invalid' al campo di input
                                inputField.classList.add('is-invalid');
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection

