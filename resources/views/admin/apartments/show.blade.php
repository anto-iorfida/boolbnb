@extends('layouts.admin')
@section('content')
    {{-- @if (session('apartments_create'))
        <div class="mess-info">Progetto creato con successo!</div>
    @endif --}}

    {{-- @if (session('apartments_edit'))
        <div class="mess-info">Progetto modificato con successo!</div>
    @endif --}}
<div class="card">

    @if ($apartment->thumb)
        <div>
            <img style="width: 400px;border-radius:20px" src="https://www.welcomekado.com/wp-content/uploads/2018/10/affittare-casa-vacanza.jpg" class="card-img-top" alt="{{ $apartment->title }}">
        </div>
    @endif
    <div class="card-body">
        <h2 class="card-title">Titolo: {{ $apartment->title }}</h2>

        <div>
            <strong>Slug:</strong> {{ $apartment->slug }}
        </div>

        <div>
            <strong>Data di Creazione:</strong> {{ $apartment->created_at }}
        </div>
        <div>
            <strong>Data di Modifica:</strong> {{ $apartment->updated_at }}
        </div>

        @if ($apartment->description)
            <p><strong>Descrizione: </strong>{{ $apartment->description }}</p>
        @endif

        <div>
            <strong>Numero di Camere:</strong> {{ $apartment->number_rooms }}
        </div>

        <div>
            <strong>Numero di Letti:</strong> {{ $apartment->number_beds}}
        </div>

        <div>
            <strong>Numero di Bagni:</strong> {{ $apartment->number_baths}}
        </div>

        <div>
            <strong>MQ2:</strong> {{ $apartment->square_meters }}
        </div>

        <div>
            <strong>Indirizzo:</strong> {{ $apartment->address }}
        </div>

        <div>
            <strong>Longitutidine:</strong> {{ $apartment->longitude}}
        </div>

        <div>
            <strong>Latitudine:</strong> {{ $apartment->latitude }}
        </div>
        <div>
            <strong>Prezzo:</strong> {{ $apartment->price}}
        </div>
    </div>


    <div class="icon-show">
        <div><a href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-arrow-left"></i></a></div>
        <div><a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"><i
                    class="fa-solid fa-pen-to-square"></i></a></div>
    </div>
</div>
@endsection