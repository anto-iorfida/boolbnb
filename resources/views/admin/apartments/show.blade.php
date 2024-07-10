@extends('layouts.admin')
@section('content')
    @if (session('apartments_create'))
        <div class="mess-info">Appartamento creato con successo!</div>
    @endif
    @if (session('apartments_edit'))
        <div class="mess-info">Appartamento modificato con successo!</div>
    @endif
    <div class="container mb-2">
        <div class="row">
            <div class="container">
                <h1 class="text-secondary">{{ $apartment->title }}</h1>
                <div class="mt-3">
                    <h4>Immagine di copertina</h4>
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
                    <div class="row">
                        @foreach ($apartment->albums as $album)
                            @if ($apartment->album && file_exists(public_path('storage/' . $apartment->album)))
                                {{-- @dump('ciao') --}}
                                <div class="col-4 col-md-4  d-inline">
                                    <img src="{{ asset('storage/' . $album->image) }}" class="img-fluid rounded-4"
                                        style="min-height: 400px;width:auto;object-fit:contain">
                                </div>
                            @else
                                {{-- @dump($album) --}}
                                <div class="col-4 col-md-4  d-inline">
                                    <img src="{{ asset('storage/' . $album->image) }}" class="img-fluid rounded-4">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row my-4">
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

                <div class="mb-4">
                    {{-- chi lo tocca lo ammazzo by mattia --}}
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed ms-bg-primary rounded-pill" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <strong><i class="fa-solid fa-money-bill-trend-up"></i> Sponsorizza il tuo
                                        appartamento</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body d-block d-lg-flex justify-content-evenly border border-0">
                                    @foreach ($sponsor as $singleSponsor)
                                        <div class="card text-center mb-2" style="min-width: 200px;">
                                            <div class="card-header">
                                                <strong>{{ $singleSponsor->name }}</strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-title fs-5">Durata: {{ $singleSponsor->duration }} ore
                                                </div>
                                                <div class="card-text">Prezzo: {{ $singleSponsor->price }}</div>
                                            </div>
                                            <div class="card-footer text-body-secondary">
                                                <a href="{{ route('admin.payment', ['sponsor_id' => $singleSponsor->id, 'id_apartment' => $apartment->id]) }}"
                                                    class="btn btn-success">Acquista</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- fine accordion --}}
                </div>

                <div class="section mb-4">
                    <div class="mb-2">
                        <strong>Servizi:</strong>
                        <br />
                        @if (count($apartment->services) > 0)
                            <div class="row my-3">
                                @foreach ($apartment->services as $service)
                                    <div class="col-6">
                                        <div>{{ $service->name }}@if (!$loop->last)
                                                <span><i class="{{ $service->icon }}"></i></span>
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
                    <strong>Visibilità:</strong> {{ $apartment->visibility ? 'Visibile' : 'Non Visibile' }}
                </div>
                {{--  --}}
                <div class="col my-4">
                    <div class="card">
                        <div class="card m-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <!-- <img class="img-fluid" src="img/stats.jpeg" alt=""> -->
                                    <canvas id="myChart" width="300" height="150"></canvas>

                                    <p>Messaggi e Visualizzazioni</p>
                                    <p>Lista statistiche</p>
                                </li>
                                <li class="list-group-item">Marzo: </br>Messaggi= 12 Visualizzazioni= 100</li>
                                <li class="list-group-item">Aprile:</br> Messaggi= 15 Visualizzazioni= 110</li>
                                <li class="list-group-item">Maggio:</br> Messaggi= 20 Visualizzazioni= 100</li>
                                <li class="list-group-item">Giugno:</br> Messaggi= 16 Visualizzazioni= 150</li>
                                <li class="list-group-item">Luglio:</br> Messaggi= 25 Visualizzazioni= 180</li>

                            </ul>
                        </div>
                    </div>
                </div>
                {{--  --}}
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
        .ms-bg-primary {
            background-color: rgb(101, 159, 230)
        }

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


            // Inizializzazione del grafico
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio'],
                        datasets: [{
                            label: 'Messaggi',
                            data: [12, 15, 20, 16, 25],
                            backgroundColor: 'rgba(101, 159, 230, 0.5)', // Azzurro
                            borderColor: 'rgba(101, 159, 230, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Visualizzazioni',
                            data: [100, 110, 100, 150, 180],
                            backgroundColor: 'rgba(255, 99, 132, 0.5)', // Rosso
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                grid: {
                                    display: false // Imposta display: false per rimuovere la griglia dell'asse y
                                },
                                beginAtZero: true,
                                // min: 0,
                                // max: 2000,
                                // stepSize: 200,
                                // callback: function(value, index, values) {
                                //     return value + ' €';
                                // }
                            },
                            x: {
                                grid: {
                                    display: false // Imposta display: false per rimuovere la griglia dell'asse x
                                }
                            }
                        
                    
                    }
                }
            });
        });
    </script>
@endsection
