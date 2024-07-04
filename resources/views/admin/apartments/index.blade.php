@extends('layouts.admin')
@section('content')
<h2 class="fs-4 text-secondary">I tuoi appartamenti</h2>
@if (session('apartments_deleted'))
    <div class="mess-info">Progetto eliminato con successo!</div>
@endif
<p>In questa pagina puoi visualizzare i tuoi appartamenti caricati su BoolB&B</p>
<div class="row">
    <div class="col-11 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Appartamenti inseriti</h5>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($apartments->isEmpty())
                        <div class="text-center">
                            <p class="mb-4">Non hai ancora inserito alcun appartamento.</p>
                            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Crea subito un annuncio ed entra nel mondo BoolB&B
                            </a>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Indirizzo</th>
                                    <th scope="col">Prezzo</th>
                                    <th scope="col">Visibilità</th>
                                    <th scope="col">Visualizzazioni</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartments as $apartment)
                                    <tr>
                                        <td>{{ $apartment->title }}</td>
                                        <td>{{ $apartment->address }}</td>
                                        <td>{{ $apartment->price }}</td>
                                        <td>{{ $apartment->visibility_text }}</td>
                                        <td>{{ $apartment->views_count }}</td>
                                        <td>
                                            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Visiona
                                            </a>
                                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Modifica
                                            </a>
                                            <a type="button" class="btn btn-sm btn-danger js-confirm-delete"
                                                data-apartment-id="{{ $apartment->slug }}"
                                                data-apartment-title="{{ $apartment->title }}">
                                                <i class="fas fa-trash"></i> Elimina
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Sezione per i messaggi ricevuti -->
    <div class="row mt-4">
        <div class="col-11 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Messaggi Ricevuti</h5>
                <div class="card-body">
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

<!-- Modal di Conferma -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma Eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare l'appartamento: <strong id="apartment-title"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form id="delete-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="modal-confirm-deletion" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    setTimeout(function () {
        let messageElement = document.querySelectorAll('.mess-info');
        messageElement.forEach(function(element) {
            element.classList.add('fade-out');
        });
    }, 3000); // 3 secondi
</script>












