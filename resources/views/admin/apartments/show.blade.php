@extends('layouts.admin')

@section('content')
    @if (session('apartments_create'))
        <div class="alert alert-success">Progetto creato con successo!</div>
    @endif

    @if (session('apartments_edit'))
        <div class="alert alert-success">Progetto modificato con successo!</div>
    @endif

    <div class="card p-5 mb-2">
        <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @foreach($apartment->albums as $key => $album)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key + 1 }}" aria-label="Slide {{ $key + 2 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @if ($apartment->thumb && file_exists(public_path('storage/' . $apartment->thumb)))
                        <img src="{{ asset('storage/' . $apartment->thumb) }}" class="d-block w-100" alt="{{ $apartment->title }}">
                    @else
                        <img src="{{ $apartment->thumb }}" class="d-block w-100" alt="{{ $apartment->title }}">
                    @endif
                </div>
                @foreach($apartment->albums as $album)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $album->image) }}" class="d-block w-100" alt="Immagine appartamento">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        <div class="card-body">
            <h2 class="fs-4 text-secondary">Titolo: {{ $apartment->title }}</h2>
            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <strong>Slug:</strong> {{ $apartment->slug }}
                        </div>
                        <div class="mb-2">
                            <strong>Data di Creazione:</strong> {{ $apartment->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="mb-2">
                            <strong>Data di Modifica:</strong> {{ $apartment->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="mb-2">
                        <button id="toggleCardsButton" class="btn btn-primary">
                            <i class="fa-solid fa-money-bill-trend-up"></i> Sponsorizza il tuo appartamento
                        </button>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex d-none" id="cardsContainer">
                            @foreach ($sponsor as $singleSponsor)
                                <div class="card text-center me-2 mb-2" style="min-width: 200px;">
                                    <div class="card-header">
                                        {{ $singleSponsor->name }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Prezzo: {{ $singleSponsor->price }}</h5>
                                        <p class="card-text">Durata: {{ $singleSponsor->duration }} ore</p>
                                        <a href="#" class="btn btn-primary">Attiva</a>
                                    </div>
                                    <div class="card-footer text-body-secondary"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="section mb-4">
                    <div class="mb-2">
                        <strong>Servizi:</strong>
                        <br />
                        @if (count($apartment->services) > 0)
                            @foreach ($apartment->services as $service)
                                {{ $service->name }}@if (!$loop->last), @endif
                            @endforeach
                        @else
                            nessuno
                        @endif
                    </div>
                </div>

                @if ($apartment->description)
                    <div class="mb-2">
                        <strong>Descrizione:</strong>
                        <p>{{ $apartment->description }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Visualizzazioni:</strong> {{ $apartment->views_count }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Numero di Camere:</strong> {{ $apartment->number_rooms }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Numero di Letti:</strong> {{ $apartment->number_beds }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Numero di Bagni:</strong> {{ $apartment->number_baths ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Metri Quadrati:</strong> {{ $apartment->square_meters ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="pe-2">
                        <strong>Indirizzo:</strong> {{ $apartment->address }}
                    </div>
                </div>

                <!-- Mappa -->
                <div id="map" class="rounded mb-4"></div>

                <div class="me-2">
                    <strong>Prezzo:</strong> {{ number_format($apartment->price, 2) }} €
                </div>

                <div class="me-2">
                    <strong>Visibilità:</strong> {{ $apartment->visibility ? 'Visibile' : 'Non Visibile' }}
                </div>

                <div class="d-flex justify-content-between my-4">
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Indietro
                    </a>
                    <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i> Modifica
                    </a>
                </div>
            </div>
        </div>
    </div>

<style>

        .card-title {
            font-size: 1.75rem;
            font-weight: bold;
        }

        .card-body strong {
            color: #495057;
        }

        .section {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .card-footer .btn {
            margin: 0 5px;
        }

        #cardsContainer {
            display: none;
        }

        #map {
            height: 400px;
            width: 100%;
            border: 1px solid #dee2e6;
        }

        .alert {
            margin-bottom: 20px;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>

@endsection

@section('scripts')
    <!-- Librerie di TomTom -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tt.setProductInfo('Your App Name', 'Your App Version');

            let map = tt.map({
                key: 'tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc',
                container: 'map',
                center: [{{ $apartment->longitude }}, {{ $apartment->latitude }}],
                zoom: 15
            });

            let marker = new tt.Marker()
                .setLngLat([{{ $apartment->longitude }}, {{ $apartment->latitude }}])
                .addTo(map);
        });

    </script>
@endsection
