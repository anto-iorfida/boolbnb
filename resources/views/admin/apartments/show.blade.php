@extends('layouts.admin')
@section('content')
    @if (session('apartments_create'))
        <div class="mess-info">Progetto creato con successo!</div>
    @endif

    @if (session('apartments_edit'))
        <div class="mess-info">Progetto modificato con successo!</div>
    @endif
    <div class="card mt-4">
        @if ($apartment->thumb)
            <div>
                <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->title }}">
            </div>
        @endif
        <div class="card-body">
            <h2 class="card-title mb-4">Titolo: {{ $apartment->title }}</h2>

            <div class="section mb-4">
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
                <div class="section mb-4">
                    <p><strong>Descrizione: </strong>{{ $apartment->description }}</p>
                </div>
            @endif

            <p><strong>Visualizzazioni:</strong> {{ $apartment->views_count }}</p>

            <div class="section mb-4">
                <div class="row">
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
                        <strong>MQ2:</strong> {{ $apartment->square_meters ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="section mb-4">
                <div class="mb-2">
                    <strong>Indirizzo:</strong> {{ $apartment->address }}
                </div>
            </div>

            <!-- Mappa -->
            <div id="map" style="height: 400px; width: 100%;"></div>

            <div class="section mb-4">
                <strong>Prezzo:</strong> {{ number_format($apartment->price, 2) }} €
            </div>

            <div class="section mb-4">
                <strong>Visibilità:</strong> {{ $apartment->visibility ? 'Visibile' : 'Non Visibile' }}
            </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Indietro
            </a>
            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}" class="btn btn-primary">
                <i class="fa-solid fa-pen-to-square"></i> Modifica
            </a>
        </div>
    </div>
    </div>

    <style>
        .card {
            border-radius: 20px;
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
        }
    </style>
@endsection

@section('scripts')
    <!--librerie di TomTom -->
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
