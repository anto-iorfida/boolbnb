@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Tutti gli Appartamenti</h1>
    <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary mb-3">Crea Nuovo Appartamento</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Indirizzo</th>
                <th>Numero letti</th>
                <th>Prezzo</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apartments as $apartment)
            <tr>
                <td>{{ $apartment->id }}</td>
                <td>{{ $apartment->title }}</td>
                <td>{{ $apartment->address }}</td>
                <td>{{ $apartment->number_beds }}</td>
                <td>{{ $apartment->price }}</td>
                <td>
                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="btn btn-success">
                            <i class="fas fa-eye"></i> Visualizza
                        </a>
                        <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifica
                        </a>
                        <button type="button" class="btn btn-danger js-confirm-delete" data-apartment-id="{{ $apartment->id }}" data-apartment-title="{{ $apartment->title }}">
                            <i class="fas fa-trash"></i> Elimina
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal di Conferma -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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