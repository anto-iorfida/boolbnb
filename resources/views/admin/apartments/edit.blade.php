@extends('layouts.admin')

@section('content')
    <div class="container p-3">
        <h2 class="text-center mb-5">Modifica Appartamento</h2>

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

        <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row ">
                <div class="col-12 col-md-6">
                    <div class=" mb-3 col-12 ">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ $apartment->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_rooms" class="form-label">Numero di Stanze</label>
                        <input type="number" class="form-control @error('number_rooms') is-invalid @enderror"
                            id="number_rooms" name="number_rooms" value="{{ $apartment->number_rooms }}" min="0">
                        @error('number_rooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_beds" class="form-label">Numero di Letti</label>
                        <input type="number" class="form-control @error('number_beds') is-invalid @enderror"
                            id="number_beds" name="number_beds" value="{{ $apartment->number_beds }}" min="0">
                        @error('number_beds')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_baths" class="form-label">Numero di Bagni</label>
                        <input type="number" class="form-control " id="number_baths" name="number_baths"
                            value="{{ $apartment->number_baths }}" min="0">
                        @error('number_baths')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="square_meters" class="form-label">Metri Quadrati</label>
                        <input type="number" class="form-control " id="square_meters" name="square_meters"
                            value="{{ $apartment->square_meters }}" min="0">
                        @error('square_meters')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address') }}" autocomplete="off">
                        <div id="addressSuggestions" class="list-group"></div>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3 col-12 ">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-control @error('visibility') is-invalid @enderror" id="visibility"
                            name="visibility">
                            <option value="1" {{ $apartment->visibility == '1' ? 'selected' : '' }}>Visibile</option>
                            <option value="0" {{ $apartment->visibility == '0' ? 'selected' : '' }}>Non Visibile
                            </option>
                        </select>
                        @error('visibility')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3 col-12 ">
                        <label for="thumb" class="form-label @error('thumb') is-invalid @enderror">Immagine copertina
                            appartamento</label>
                        <input class="form-control" type="file" id="thumb" name="thumb">
                        @if ($apartment->thumb)
                            <div class="mt-2 image-edit">
                                <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->thumb }}">
                            </div>
                        @endif
                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3 col-12 ">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ $apartment->price }}" min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3 col-12 ">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $apartment->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <input type="hidden" id="longitude" name="longitude" value="{{ $apartment->longitude }}">
                <input type="hidden" id="latitude" name="latitude" value="{{ $apartment->latitude }}">

                <div>
                    <button type="submit" class="btn btn-primary mb-5">Salva Modifiche</button>
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary mb-5">Annulla</a>
                </div>
            </div>

        </form>
    </div>
@endsection
