@extends('layouts.app')

@section('content')
    <main>
        <div class="my-wrap py-5">
            <div class="my-container-register ">
                <div class="justify-content-center">
                    <div class="card p-5">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="align-items-center">
                                    <div class="text-center mb-4">
                                        <div class="img-logo-register">
                                            <img src="{{ Vite::asset('resources/img/logo-boolbnb.png') }}"
                                                class="img-fluid" alt="Logo Bool BnB">
                                        </div>
                                        <p class="fs-6 mt-3">
                                            Registrati per avere accesso al nostro sito
                                            <span class="color-bnb">BOOLBNB</span>
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="text-center mb-4">Welcome</h3>
                                        <div class="mb-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required
                                                placeholder="Enter Name and Lastname" autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required
                                                placeholder="Enter Email" autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="date_birth" type="date"
                                                class="form-control @error('date_birth') is-invalid @enderror"
                                                name="date_birth" value="{{ old('date_birth') }}" required
                                                autocomplete="date_birth" autofocus>
                                            @error('date_birth')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password" required
                                                autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback d-flex justify-content-center" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="my-btn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection