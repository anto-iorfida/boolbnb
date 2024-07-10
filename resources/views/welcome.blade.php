@extends('layouts.app')

@section('content')

<div class="jumbotron mb-4 rounded-3" style="overflow: hidden;">
    <div class="container text-center">
        <div class="">
            <img src="https://cdn.discordapp.com/attachments/1253278465843531788/1255827880026574902/Logo_Bool_bb.png?ex=667e8c5a&is=667d3ada&hm=3ec1d15ebb0333dfc7329c9fcd0c6ddf6f1a532447df88dc143ff1e2c3f51084&" class="img-fluid" alt="Logo Bool BnB" style="width:350px">
        </div>
        <h1 class="display-5 fw-bold" style="color: #333;">Benvenuti su Bool BnB</h1>
        <p class="col-md-8 fs-4 mx-auto" style="color: #333;">Bool BnB offre alloggi unici da tutto il mondo. Che tu stia cercando un accogliente cottage o una lussuosa villa, Bool BnB ti connette con il posto perfetto per il tuo prossimo viaggio.</p>
    </div>
</div>


<style>
    body, html {
        margin: 0;
        overflow: hidden;
    }

    .jumbotron {
        background-size: cover;
        background-position: center;
        height:100vh;
    }
    .content {
        padding: 50px 0;
    }

    .content p {
        font-size: 1.2rem;
    }
</style>

@endsection
