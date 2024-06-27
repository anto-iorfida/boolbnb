<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <main class="d-flex align-items-center justify-content-center w-100" style="height: 100vh">
        <div>
            <h1 class="text-center h1-error ">Errore 404</h1>
            <div class="d-flex justify-content-center">
                <img src="https://cdn.discordapp.com/attachments/1253278465843531788/1255827880026574902/Logo_Bool_bb.png?ex=667e8c5a&is=667d3ada&hm=3ec1d15ebb0333dfc7329c9fcd0c6ddf6f1a532447df88dc143ff1e2c3f51084&" alt="">
            </div>
            <div>
                <p class="fs-3 ">Ritorna alla pagina homepage per continuare la tua esperienza sul nostro sito!</p>
            </div>
            <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-lg btn-primary">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a>
                </button>
                <button class="btn btn-lg btn-primary">
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">dashboard</a>
                </button>
            </div>
        </div>
    </main>
</body>

</html>