@extends('layouts.admin')

@section('content')
    @if (session('apartments_create'))
        <div class="alert alert-success">Progetto creato con successo!</div>
    @endif

    @if (session('apartments_edit'))
        <div class="alert alert-success">Progetto modificato con successo!</div>
    @endif

    <div class="container p-5">

        <div class="row">
            <h1>{{ $apartment->title }}</h1>

            @if ($apartment->thumb)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->title }}">
                </div>
            @endif


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

            @if ($apartment->description)
                <div class="mb-2">
                    <strong>Descrizione: </strong>
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

            <!-- Mappa -->

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

    <style>
        /* width */
        body::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        body::-webkit-scrollbar-track {
            background-color: #gray;
        }

        /* Handle */
        body::-webkit-scrollbar-thumb {
            background-color: gray;
            border-radius: 6px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background-color: #0D6EFD;
        }

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

        .rounded {
            border-radius: 0.25rem;
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
