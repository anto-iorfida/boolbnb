@extends('layouts.admin')

@section('content')
    {{-- <div class="container">
            <h1 class="my-4">Tutti gli Appartamenti</h1>
            <div class="row">
                <div class="col-12 col-lg-10">
                    <table class="table table-bordered h-100">
                        <thead>
                            <tr>
                                
                                <th>Titolo</th>
                                <th>Indirizzo</th>
                                <th>Prezzo</th>
                                <th>Visibilità</th>
                                <th>Visualizzazioni</th>
                                <th>Azioni</th>
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
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}"
                                                class="btn btn-success">
                                                <i class="fas fa-eye"></i> Visualizza
                                            </a>
                                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i> Modifica
                                            </a>
                                            <button type="button" class="btn btn-danger js-confirm-delete"
                                                data-apartment-id="{{ $apartment->slug }}"
                                                data-apartment-title="{{ $apartment->title }}">
                                                <i class="fas fa-trash"></i> Elimina
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-5 col-lg-2">
                    <div class="card px-2 h-100">
                        <div class="text-center">
                            <h3 class="fs-4">Crea </h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary  py-2 px-3 mb-3">
                                <i class="fa-solid fa-plus fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  --}}

    <h1 class="h2">I tuoi appartamenti</h1>
    <p>This is the homepage of a simple admin interface which is part of a tutorial written on Themesberg</p>

    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-lg-0">
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
                                                Vedi
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
