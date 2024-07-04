@extends('layouts.admin')
@section('content')
    <h1>Cestino</h1>
    <div class="row mt-5">
        <div class="col-11 mb-4 mb-lg-0">
            @if ($apartments->isEmpty())
                <h2>Non ci sono appartamenti nel cestino</h2>
            @endif
            @if (!$apartments->isEmpty())
                <div class="card">
                    <h5 class="card-header">Appartamenti cestinati</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Titolo</th>
                                        <th scope="col">Indirizzo</th>
                                        <th scope="col">Visualizzazioni</th>
                                        <th scope="col">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apartments as $apartment)
                                        <tr>
                                            <td>{{ $apartment->title }}</td>
                                            <td>{{ $apartment->address }}</td>
                                            <td>{{ $apartment->views_count }}</td>
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    {{-- restore Form --}}
                                                    <div>
                                                        @if ($apartment->trashed())
                                                            <form
                                                                action="{{ route('admin.garbages.restore', $apartment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fa-solid fa-recycle"></i>
                                                                    Ripristina
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        {{-- Permanent Delete Form --}}
                                                        <form
                                                            action="{{ route('admin.garbages.forcedelete', $apartment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                                Permanently Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex align-items-center justify-content-center ">
                                <form action="{{ route('admin.garbages.restoreall') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success ">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Recupera tutti
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
