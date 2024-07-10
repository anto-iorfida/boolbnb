@extends('layouts.admin')

@section('content')
    <div class="container p-3">
        <h2 class="fs-4 text-secondary">Modifica appartamento</h2>

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
                        <label for="title" class="form-label"><strong>Titolo appartamento</strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ $apartment->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_rooms" class="form-label"><strong>Numero di Stanze</strong></label>
                        <input type="number" class="form-control @error('number_rooms') is-invalid @enderror"
                            id="number_rooms" name="number_rooms" value="{{ $apartment->number_rooms }}" min="0">
                        @error('number_rooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_beds" class="form-label"><strong>Numero di Letti</strong></label>
                        <input type="number" class="form-control @error('number_beds') is-invalid @enderror"
                            id="number_beds" name="number_beds" value="{{ $apartment->number_beds }}" min="0">
                        @error('number_beds')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="number_baths" class="form-label"><strong>Numero di Bagni</strong></label>
                        <input type="number" class="form-control " id="number_baths" name="number_baths"
                            value="{{ $apartment->number_baths }}" min="0">
                        @error('number_baths')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3 col-12 ">
                        <label for="square_meters" class="form-label"><strong>Metri Quadrati</strong></label>
                        <input type="number" class="form-control " id="square_meters" name="square_meters"
                            value="{{ $apartment->square_meters }}" min="0">
                        @error('square_meters')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-12">
                        <label for="address" class="form-label"><strong>Indirizzo</strong></label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ $apartment->address }}" autocomplete="off">
                        <div id="addressSuggestions" class="list-group"></div>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-4">
                        <label for="checkbox"><strong>Servizi</strong></label>
                        <div class="row mb-3 mt-3 p-3 ">
                            @foreach ($services as $service)
                                <div class="form-check col-6 ">
                                    @if ($errors->any())
                                        {{-- Se cis sono errori di validazione vuol dire che l'utente ha gia inviato il form quindi controllo l'old --}}
                                        <input class="form-check-input" @checked(in_array($service->id, old('services', []))) type="checkbox"
                                            name="services[]" value="{{ $service->id }}"
                                            id="service-{{ $service->id }}">
                                    @else
                                        {{-- Altrimenti vuol dire che stiamo caricando la pagina per la prima volta quindi controlliamo la presenza del service nella collection che ci arriva dal db --}}
                                        <input class="form-check-input" @checked($apartment->services->contains($service)) type="checkbox"
                                            name="services[]" value="{{ $service->id }}"
                                            id="service-{{ $service->id }}">
                                    @endif

                                    <label class="form-check-label" for="service-{{ $service->id }}">
                                        {{ $service->name }} <i class="{{ $service->icon }}"></i>
                                    </label>
                                </div>
                            @endforeach
                            @error('services')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class=" mb-3 col-12 ">
                        <label for="visibility" class="form-label"><strong>Visibilità</strong></label>
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
                        <label for="thumb" class="form-label @error('thumb') is-invalid @enderror"><strong>Immagine
                                copertina appartamento</strong></label>
                        <input class="form-control mb-3" type="file" id="thumb" name="thumb">
                        {{-- @if ($apartment->thumb)
                            <div class="mt-2 image-edit">
                                <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->thumb }}">
                            </div>
                        @endif
                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                        @if ($apartment->thumb && file_exists(public_path('storage/' . $apartment->thumb)))
                            <div class="col-12 mb-4 d-block">
                                <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->title }}"
                                    class="img-fluid rounded-4" style="min-height: 400px;width:auto;object-fit:contain">
                            </div>
                        @else
                            <div class="mb-4 card" style='width: 100px; height: 100px;'>
                                <img src="{{ $apartment->thumb }}" alt="{{ $apartment->title }}"
                                    class="img-fluid rounded-4">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="images" class="form-label"><strong>Altre immagini dell'appartamento
                                *</strong></label>
                        <input type="file" class="form-control mb-3" id="images" name="images[]" multiple>
                        <div class="invalid-feedback" id="imagesError"></div>
                        {{-- @dump($apartment->albums) --}}
                        @if ($apartment->album)
                            <div class="mt-2 image-edit">
                                <img src="{{ asset('storage/' . $apartment->album) }}" alt="{{ $apartment->album }}">
                            </div>
                        @endif
                        <div class="col-4 col-md-4  d-inline" >
                            @foreach ($apartment->albums as $album)
                                @if ($apartment->album && file_exists(public_path('storage/' . $apartment->album)))
                                    <img src="{{ asset('storage/' . $album->image) }}" alt="{{ $apartment->title }}"
                                        class="img-fluid rounded-4"
                                        style='width: 100px;height: 100px'>
                                @else
                                    <img src="{{ $album->image }}" alt="{{ $apartment->title }}"
                                        class="img-fluid rounded-4" style='width: 100px;height: 100px'>
                                @endif
                            @endforeach
                        </div>


                        @error('thumb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" id="longitude" name="longitude" value="{{ $apartment->longitude }}">
                    <input type="hidden" id="latitude" name="latitude" value="{{ $apartment->latitude }}">

                </div>

                <div class=" mb-3 col-12 ">
                    <label for="description" class="form-label"><strong>Descrizione</strong></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $apartment->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mb-5">Salva Modifiche</button>
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary mb-5">Annulla</a>
                </div>


        </form>
    </div>
@endsection
