@extends('layouts.app')

@section('content')
    <main>
        <div class=" my-wrap pt-5">
            <div class="my-container-register">
                <div class="row w-100  justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row d-flex align-items-center">
                                        <div class="col-12 col-md-12 col-lg-4">
                                            <div class="img-logo-register">
                                                <img src="{{ Vite::asset('resources/img/logo-boolbnb.png') }}" class="img-fluid" alt="Logo Bool BnB" >
                                            </div>
                                            <div>
                                                <p class="fs-6">
                                                    Registrati per avere accesso al nostro sito
                                                    <span class="color-bnb">BOOLBNB</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <h3 class="text-center">Welcome</h3>
                                            <div class="mb-4 row">
                                                  <div class=" col-md-12 d-flex justify-content-center">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        placeholder="Enter Name and Lastname"
                                                        autocomplete="name" autofocus>
                                                    
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <div class=" col-md-12 d-flex justify-content-center">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                         placeholder="Enter Email"
                                                        autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <div class=" col-md-12 d-flex justify-content-center">
                                                    <input id="date_birth" type="date"
                                                        class="form-control @error('date_birth') is-invalid @enderror"
                                                        name="date_birth" value="{{ old('date_birth') }}" required
                                                         placeholder="Password..."
                                                        autocomplete="date_birth" autofocus>

                                                    @error('date_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <div class=" col-md-12 d-flex justify-content-center">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Password..."
                                                        name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-5 row">
                                                <div class=" col-md-12 d-flex justify-content-center">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" required autocomplete="new-password"
                                                        placeholder="Confirm Password..."
                                                        >
                                                </div>
                                            </div>
                                            <div class="mb-4 row mb-0">
                                                <div class=" col-md-12 d-flex justify-content-center">
                                                    <button type="submit" class="my-btn">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<style>
    .my-wrap {
        width: 100%;
        margin: 0 auto;
        height: calc(100vh - 86px);
        background-color: #4B53D0;
    }
    .my-container-register{
        width: 70%;
        margin: 0 auto;
    }
    .img-logo-register img{
        max-width: 100%;
    }
</style>
