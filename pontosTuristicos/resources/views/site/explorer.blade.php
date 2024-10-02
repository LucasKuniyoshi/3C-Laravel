<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exploradores</title>
</head>
<body>
    <header>Adicionar Explorador</header>
    <section style="margin-top: 10px">
        <div>
            Insira os dados do Explorador:
        </div>

        <form action="{{ route('explorers.show') }}" method="POST">
            {{-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> --}}
            @csrf() {{-- CRIA O TOKEN AUTOMÁTICO --}}
            <input type="text" placeholder="Nome do explorador" name="name">
            <textarea name="idade" cols="30" rows="5" placeholder="Idade"></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>
</body>
</html>
