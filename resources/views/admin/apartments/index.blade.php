@extends('layouts.admin')

@section('content')
   
    <h2 class="fs-4 text-secondary">I tuoi appartamenti</h2>
    @if (session('apartments_deleted'))
        <div class="mess-info">Progetto eliminato con successo!</div>
    @endif
    <p>In questa pagina puoi visualizzare i tuoi appartamenti caricati su BoolB&B</p>

    <div class="row">
        <div class="col-12 col-xl-9 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Appartamenti inseriti</h5>
                <div class="card-body">
                    <div class="table-responsive">
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
                                                <i class="fas fa-eye"></i>
                                                Visiona
                                            </a>
                                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                                Modifica
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
                    </div>
                    <a href="rou" class="btn btn-block btn-light">View all</a>
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
