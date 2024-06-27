@extends('layouts.app')

@section('content')
    <main>
        <div class=" my-wrap pt-5">
            <div class="my-container-register">
                <div class="row w-100  justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="img-logo-register">
                                                <img src="https://cdn.discordapp.com/attachments/1253278465843531788/1255827880026574902/Logo_Bool_bb.png?ex=667e8c5a&is=667d3ada&hm=3ec1d15ebb0333dfc7329c9fcd0c6ddf6f1a532447df88dc143ff1e2c3f51084&" class="img-fluid" alt="Logo Bool BnB" style="width:350px">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="mb-4 row">
                                                <label for="name"
                                                    class="col-form-label text-md-right">{{ __('Name') }}</label>

                                                <div class="col-md-12">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <label for="email"
                                                    class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-12">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <label for="date_birth"
                                                    class=" col-form-label text-md-right">{{ __('Date Birth') }}</label>

                                                <div class="col-md-12">
                                                    <input id="date_birth" type="date"
                                                        class="form-control @error('date_birth') is-invalid @enderror"
                                                        name="date_birth" value="{{ old('date_birth') }}" required
                                                        autocomplete="date_birth" autofocus>

                                                    @error('date_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <label for="password"
                                                    class=" col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-12">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row">
                                                <label for="password-confirm"
                                                    class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                <div class="col-md-12">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>

                                            

                                            <div class="mb-4 row mb-0">
                                                <div class="col-md-12 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Register') }}
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
    }
</style>
