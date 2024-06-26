@extends('layouts.admin')
@section('content')
    <h1>Tutti gli Appartamenti</h1>
    {{-- @if (session('apartment_deleted'))
        <div class="mess-info">Progetto eliminato con successo!</div>
    @endif --}}
   <div class="row">
     <div class="col-8">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="selectAllCheckbox">
                    </th>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Indirizzo</th>
                    <th>Numero letti</th>
                    <th>Immagine</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>
                            <input type="checkbox" class="deleteCheckbox" name="apartment_ids[]" value="{{ $apartment->id }}">
                        </td>
                        <td>{{ $apartment->id }}</td>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->number_beds}}</td>
                        <td>{{ $apartment->thumb}}</td>
                        <td>{{ $apartment->price}}</td>
                        <td>
                            <div class="icon-colum d-flex gap-3">
    
                                <div>
                                    <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->slug]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
    
                                <div>
                                    <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
    
                                <div>
                                    <form id="delete-form-{{ $apartment->slug }}"
                                        action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" data-apartment-name="{{ $apartment->name }}" class="js-delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </div>
    
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
     </div>
   </div>
    <button type="submit" id="deleteSelectedButton">Elimina Selezionati</button>
@endsection
