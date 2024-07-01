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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row edit">
                <div class="mb-3 col-12 col-md-6">
                    <label for="title" class="form-label"><strong>Titolo appartamento *</strong></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_rooms" class="form-label"><strong>Numero di Stanze *</strong></label>
                    <input type="number" class="form-control @error('number_rooms') is-invalid @enderror" id="number_rooms"
                        name="number_rooms" value="{{ old('number_rooms') }}" min="0">
                    @error('number_rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_beds" class="form-label"><strong>Numero di Letti *</strong></label>
                    <input type="number" class="form-control @error('number_beds') is-invalid @enderror" id="number_beds"
                        name="number_beds" value="{{ old('number_beds') }}" min="0">
                    @error('number_beds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="number_baths" class="form-label"><strong>Numero di Bagni</strong></label>
                    <input type="number" class="form-control" id="number_baths" name="number_baths"
                        value="{{ old('number_baths') }}" min="0">
                    @error('number_baths')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="square_meters" class="form-label"><strong>Metri Quadrati</strong></label>
                    <input type="number" class="form-control " id="square_meters" name="square_meters"
                        value="{{ old('square_meters') }}" min="0">
                    @error('square_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="thumb" class="form-label @error('thumb') is-invalid @enderror"><strong>Immagine copertina
                            appartamento *</strong></label>
                    <input class="form-control" type="file" id="thumb" name="thumb">
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="address" class="form-label"><strong>Indirizzo *</strong></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address') }}" autocomplete="off">
                    <div id="addressSuggestions" class="list-group"></div>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="images" class="form-label @error('images') is-invalid @enderror"><strong>Altre immagini dell'appartamento</strong></label>
                    <input class="form-control" type="file" id="images" name="images[]" multiple>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="price" class="form-label"><strong>Prezzo *</strong></label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price') }}" min="0">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-12">
                    <label for="description" class="form-label"><strong>Descrizione *</strong></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 mt-4">
                    <label for="checkbox"><strong>Servizi *</strong></label>
                    <div class="row mb-3 mt-3 p-3">
                        @foreach ($services as $service)
                            <div class="form-check col-6">
                                <input @checked(in_array($service->id, old('services', []))) class="form-check-input" type="checkbox"
                                    name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}">
                                <label class="form-check-label" for="service-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="visibility" class="form-label"><strong>Visibilità *</strong></label>
                    <select class="form-control @error('visibility') is-invalid @enderror" id="visibility"
                        name="visibility">
                        <option value="1" {{ old('visibility') == '1' ? 'selected' : '' }}>Visibile</option>
                        <option value="0" {{ old('visibility') == '0' ? 'selected' : '' }}>Non Visibile</option>
                    </select>
                    @error('visibility')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Hidden fields for latitude and longitude -->
            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
            <button type="submit" class="btn btn-primary mb-5">Crea Appartamento</button>
        </form>
    </div>
@endsection
@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.0/services/services-web.min.js"></script>
@endsection
