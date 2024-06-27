@extends('layouts.admin')

@section('content')

    <div class="h-100  color-bg-container">
        <div class="container py-3 ">
            <h2 class="text-center">Crea Nuovo Appartamento</h2>

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

            <form action="{{ route('admin.apartments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="title" class=" form-label fw-bold">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="number_rooms" class=" form-label fw-bold">Numero di Stanze</label>
                        <input type="number" class="form-control @error('number_rooms') is-invalid @enderror"
                            id="number_rooms" name="number_rooms" value="{{ old('number_rooms') }}">
                        @error('number_rooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="number_beds" class=" form-label fw-bold">Numero di Letti</label>
                        <input type="number" class="form-control @error('number_beds') is-invalid @enderror"
                            id="number_beds" name="number_beds" value="{{ old('number_beds') }}">
                        @error('number_beds')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="number_baths" class=" form-label fw-bold">Numero di Bagni</label>
                        <input type="number" class="form-control @error('number_baths') is-invalid @enderror"
                            id="number_baths" name="number_baths" value="{{ old('number_baths') }}">
                        @error('number_baths')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="square_meters" class=" form-label fw-bold">Metri Quadrati</label>
                        <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                            id="square_meters" name="square_meters" value="{{ old('square_meters') }}">
                        @error('square_meters')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="thumb" class=" form-label fw-bold">URL Immagine</label>
                        <input type="url" class="form-control @error('thumb') is-invalid @enderror" id="thumb"
                            name="thumb" value="{{ old('thumb') }}">
                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="address" class=" form-label fw-bold">Indirizzo</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="longitude" class=" form-label fw-bold">Longitudine</label>
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                            name="longitude" value="{{ old('longitude') }}">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="latitude" class=" form-label fw-bold">Latitudine</label>
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                            name="latitude" value="{{ old('latitude') }}">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="price" class=" form-label fw-bold">Prezzo</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="visibility" class=" form-label fw-bold">Visibilità</label>
                        <select class="form-control @error('visibility') is-invalid @enderror" id="visibility"
                            name="visibility">
                            <option value="1" {{ old('visibility') == '1' ? 'selected' : '' }}>Visibile</option>
                            <option value="0" {{ old('visibility') == '0' ? 'selected' : '' }}>Non Visibile</option>
                        </select>
                        @error('visibility')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12">
                        <label for="description" class=" form-label fw-bold">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-5">Crea Appartamento</button>
            </form>
        </div>
    </div>
@endsection




