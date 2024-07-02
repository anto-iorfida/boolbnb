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
                    <input type="number" class="form-control" id="number_rooms" name="number_rooms" value="{{ old('number_rooms') }}" min="0">
                    <div class="invalid-feedback" id="number_roomsError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_beds" class="form-label"><strong>Numero di Letti *</strong></label>
                    <input type="number" class="form-control" id="number_beds" name="number_beds" value="{{ old('number_beds') }}" min="0">
                    <div class="invalid-feedback" id="number_bedsError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_baths" class="form-label"><strong>Numero di Bagni</strong></label>

                    <input type="number" class="form-control" id="number_baths" name="number_baths" value="{{ old('number_baths') }}" min="0">
                    <div class="invalid-feedback" id="number_bathsError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="square_meters" class="form-label"><strong>Metri Quadrati</strong></label>
                    <input type="number" class="form-control" id="square_meters" name="square_meters" value="{{ old('square_meters') }}" min="0">
                    <div class="invalid-feedback" id="square_metersError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="thumb" class="form-label"><strong>Immagine copertina appartamento</strong></label>
                    <input class="form-control" type="file" id="thumb" name="thumb">
                    <div class="invalid-feedback" id="thumbError"></div>

                    <input type="number" class="form-control @error('number_baths') is-invalid @enderror" id="number_baths" name="number_baths" value="{{ old('number_baths') }}" min="1">
                    @error('number_baths')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="square_meters" class="form-label"><strong>Metri Quadrati</strong></label>
                    <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" value="{{ old('square_meters') }}" min="0">
                    @error('square_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="thumb" class="form-label"><strong>Immagine copertina appartamento</strong></label>
                    <input type="file" class="form-control @error('thumb') is-invalid @enderror" id="thumb" name="thumb">
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="address" class="form-label"><strong>Indirizzo *</strong></label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" autocomplete="off">
                    <div id="addressSuggestions" class="list-group"></div>
                    <div class="invalid-feedback" id="addressError"></div>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="images" class="form-label"><strong>Altre immagini dell'appartamento</strong></label>

                    <input class="form-control" type="file" id="images" name="images[]" multiple>
                    <div class="invalid-feedback" id="imagesError"></div>

                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3 col-12">
                    <label for="description" class="form-label"><strong>Descrizione *</strong></label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    <div class="invalid-feedback" id="descriptionError"></div>
                </div>
                <div class="mb-3 mt-4">
                    <label  for="checkbox"><strong>Servizi *</strong></label>
                    <div class="row mb-3 mt-3 p-3">
                        @foreach ($services as $service)
                            <div class="form-check col-6">
                                <input @checked(in_array($service->id, old('services', []))) class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
                                <label class="form-check-label" for="service-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
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
            <!-- Hidden fields for latitude and longitude -->
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
        // Aspetta che il documento sia completamente caricato prima di eseguire il codice.
document.addEventListener('DOMContentLoaded', function () {
    
    // Seleziona il modulo con l'ID 'apartmentForm' e lo assegna alla costante 'form'.
    const form = document.getElementById('apartmentForm');

    // Seleziona il pulsante con l'ID 'validateBtn' e lo assegna alla costante 'validateBtn'.
    const validateBtn = document.getElementById('validateBtn');

    // Aggiunge un gestore di eventi 'click' al pulsante 'validateBtn'.
    validateBtn.addEventListener('click', function () {
        
        // Chiama la funzione per rimuovere eventuali messaggi di errore di validazione esistenti.
        clearValidationErrors();

        // Invia una richiesta POST asincrona al percorso definito per validare i dati del form.
        axios.post('{{ route('api.validate.apartment') }}', new FormData(form))
            .then(response => {
                // Se la validazione ha successo, mostra un messaggio nella console.
                console.log('Dati del form validati con successo.');

                // Imposta l'azione del modulo al percorso di memorizzazione degli appartamenti.
                form.action = '{{ route('admin.apartments.store') }}';

                // Imposta il metodo del modulo su 'POST'.
                form.method = 'POST';

                // Invia il modulo.
                form.submit();
            })
            .catch(error => {
                // Se la risposta dell'errore ha un codice di stato 422 (errore di validazione),
                if (error.response.status === 422) {
                    // Estrae gli errori dalla risposta e chiama la funzione per mostrarli.
                    const errors = error.response.data.errors;
                    displayValidationErrors(errors);
                } else {
                    // Se c'è un altro tipo di errore, lo mostra nella console.
                    console.error('Errore durante la validazione dei dati:', error);
                }
            });
    });

    // Funzione per rimuovere i messaggi di errore di validazione esistenti dal modulo.
    function clearValidationErrors() {
        // Seleziona tutti gli input con la classe 'is-invalid' e rimuove questa classe.
        form.querySelectorAll('.is-invalid').forEach(input => {
            input.classList.remove('is-invalid');
        });
        // Seleziona tutti gli elementi con la classe 'invalid-feedback' e svuota il loro contenuto di testo.
        form.querySelectorAll('.invalid-feedback').forEach(errorFeedback => {
            errorFeedback.textContent = '';
        });
    }

    // Funzione per mostrare i messaggi di errore di validazione.
    function displayValidationErrors(errors) {
        // Itera attraverso gli errori e mostra il messaggio di errore per ciascun campo.
        Object.keys(errors).forEach(field => {
            // Ottiene il primo messaggio di errore per il campo.
            const errorMessage = errors[field][0];
            
            // Trova l'elemento di feedback dell'errore corrispondente al campo.
            const errorFeedback = document.getElementById(`${field}Error`);
            if (errorFeedback) {
                // Imposta il messaggio di errore nell'elemento di feedback.
                errorFeedback.textContent = errorMessage;
                
                // Trova l'input corrispondente al campo e aggiunge la classe 'is-invalid'.
                const inputField = document.getElementById(field);
                if (inputField) {
                    inputField.classList.add('is-invalid');
                }
            }
        });
    }
});

    </script>
@endsection
