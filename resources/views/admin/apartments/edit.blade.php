@extends('layouts.admin')

@section('content')
    <div class="container p-3">
        <h2 class="text-center">Modifica Appartamento</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row ">

                <div class=" mb-3 col-12 col-md-6">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ $apartment->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $apartment->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="number_rooms" class="form-label">Numero di Stanze</label>
                    <input type="number" class="form-control @error('number_rooms') is-invalid @enderror" id="number_rooms"
                        name="number_rooms" value="{{ $apartment->number_rooms }}">
                    @error('number_rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="number_beds" class="form-label">Numero di Letti</label>
                    <input type="number" class="form-control @error('number_beds') is-invalid @enderror" id="number_beds"
                        name="number_beds" value="{{ $apartment->number_beds }}">
                    @error('number_beds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="number_baths" class="form-label">Numero di Bagni</label>
                    <input type="number" class="form-control @error('number_baths') is-invalid @enderror" id="number_baths"
                        name="number_baths" value="{{ $apartment->number_baths }}">
                    @error('number_baths')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="square_meters" class="form-label">Metri Quadrati</label>
                    <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                        id="square_meters" name="square_meters" value="{{ $apartment->square_meters }}">
                    @error('square_meters')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="thumb" class="form-label">URL Immagine</label>
                    <input type="url" class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                        name="thumb" value="{{ $apartment->thumb }}">
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ $apartment->address }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="longitude" class="form-label">Longitudine</label>
                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                        name="longitude" value="{{ $apartment->longitude }}">
                    @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="latitude" class="form-label">Latitudine</label>
                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                        name="latitude" value="{{ $apartment->latitude }}">
                    @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="price" class="form-label">Prezzo</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ $apartment->price }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" mb-3 col-12 col-md-6">
                    <label for="visibility" class="form-label">Visibilità</label>
                    <select class="form-control @error('visibility') is-invalid @enderror" id="visibility"
                        name="visibility">
                        <option value="1" {{ $apartment->visibility == '1' ? 'selected' : '' }}>Visibile</option>
                        <option value="0" {{ $apartment->visibility == '0' ? 'selected' : '' }}>Non Visibile</option>
                    </select>
                    @error('visibility')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-5">Salva Modifiche</button>
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary mb-5">Annulla</a>
                </div>
            </div>

        </form>
    </div>
@endsection
