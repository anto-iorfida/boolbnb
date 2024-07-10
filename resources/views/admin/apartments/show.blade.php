@extends('layouts.admin')
@section('content')
    @if (session('apartments_create'))
        <div class="mess-info">Progetto creato con successo!</div>
    @endif
    @if (session('apartments_edit'))
        <div class="mess-info">Progetto modificato con successo!</div>
    @endif
    <div class="container-fluid  mb-2">
        <div class="">
            <div class="container">
                <h1 class=" text-secondary">Titolo: {{ $apartment->title }}</h1>
                <div class="  mb-2 ">
                    <h3>Immagine di copertina</h3>
                    @if ($apartment->thumb && file_exists(public_path('storage/' . $apartment->thumb)))
                        <div class="col-12 mb-4 d-block">
                            <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->title }}"
                                class="img-fluid rounded-4" style="min-height: 400px;width:auto;object-fit:contain">
                        </div>
                    @else
                        <div class="mb-4 card">
                            <img src="{{ $apartment->thumb }}" alt="{{ $apartment->title }}" class="img-fluid rounded-4">
                        </div>
                    @endif
                    <div class="row ">
                        @foreach ($apartment->albums as $album)
                            <div class="col-4 col-md-4  d-inline">
                                <img src="{{ asset('storage/' . $album->image) }}" alt="Immagine appartamento"
                                    class="img-fluid rounded-4">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="mb-2">
                            <strong class="fs-5">Slug:</strong> {{ $apartment->slug }}
                        </div>
                        <div class="mb-2">
                            <strong class="fs-5">Data di Creazione:</strong>
                            {{ $apartment->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="mb-2">
                            <strong class="fs-5">Data di Modifica:</strong>
                            {{ $apartment->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                <div class="section mb-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <strong class="fs-5  d-flex align-items-center gap-3"><i
                                            class="fa-solid fa-money-bill-trend-up"></i> Sponsorizza il tuo
                                        appartamento</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="d-block d-md-flex justify-content-center">
                                        @foreach ($sponsor as $singleSponsor)
                                            <div class="card text-center me-2 mb-2" style="min-width: 200px;">
                                                <div class="card-header">
                                                    <strong class="fs-5">{{ $singleSponsor->name }}</strong>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-title fs-5">Durata: {{ $singleSponsor->duration }} ore
                                                    </div>
                                                    <div class="card-text fs-5">Prezzo: {{ $singleSponsor->price }}</div>
                                                </div>
                                                <div class="card-footer text-body-secondary">
                                                    <a href="{{ route('admin.payment', ['sponsor_id' => $singleSponsor->id]) }}"
                                                        class="btn btn-success fs-5">Acquista</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mb-4">
                    <div class="mb-2">
                        <strong class="fs-5">Servizi:</strong>
                        <br />
                        @if (count($apartment->services) > 0)
                            <div class="row my-3">
                                @foreach ($apartment->services as $service)
                                    <div class="col-6">
                                        <div class="d-flex gap-2 align-items-center">{{ $service->name }}
                                            <i class="{{ $service->icon }}"></i>
                                            @if (!$loop->last)
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                nessuno
                        @endif
                    </div>
                </div>
                @if ($apartment->description)
                    <div class="mb-2">
                        <strong class="fs-5">Descrizione:</strong>
                        <p>{{ $apartment->description }}</p>
                    </div>
                @endif
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong class="fs-5">Visualizzazioni:</strong> {{ $apartment->views_count }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="fs-5">Numero di Camere:</strong> {{ $apartment->number_rooms }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="fs-5">Numero di Letti:</strong> {{ $apartment->number_beds }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="fs-5">Numero di Bagni:</strong> {{ $apartment->number_baths ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong class="fs-5">Metri Quadrati:</strong> {{ $apartment->square_meters ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="pe-2">
                        <strong class="fs-5">Indirizzo:</strong> {{ $apartment->address }}
                    </div>
                </div>
                <!-- Mappa -->
                <div id="map" class="rounded mb-4"></div>
                <div class="me-2">
                    <strong class="fs-5">Visibilità:</strong> {{ $apartment->visibility ? 'Visibile' : 'Non Visibile' }}
                </div>
                <div class="d-flex justify-content-between my-4">
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Indietro
                    </a>
                    <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                        class="btn btn-primary">
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
            border-bottom: 1px solid #DEE2E6;
            padding-bottom: 15px;
        }

        .card-footer {
            background-color: #F8F9FA;
            border-top: 1px solid #DEE2E6;
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
            border: 1px solid #DEE2E6;
        }

        .alert {
            margin-bottom: 20px;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        /* ---------------- */
        .card img {
            object-fit: cover;
            height: auto;
            width: 100%;
        }

        /* ---------------- */
        @media (max-width: 575.98px) {}
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
