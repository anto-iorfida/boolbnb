@extends('layouts.admin')
@section('content')
    <!-- Section for received messages -->
    <div class="row mt-4">
        <div class="col-11 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Messaggi Ricevuti</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>MESSAGGI RICEVUTI: {{ $messageCount }}</strong>
                    </div>
                    @if ($messages->isEmpty())
                        <p class="text-center">Non hai ancora ricevuto nessun messaggio.</p>
                    @else
                        @foreach ($messages as $message)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $message->name_lastname }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $message->email_sender }}</h6>
                                    <p class="card-text">{{ $message->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
