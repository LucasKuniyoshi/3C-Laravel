<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exploradores</title>
</head>

<h1>Principais Exploradores</h1>

<a href="{{ route('explorers') }}">Adicionar explorador</a>

<table>
    <thead>
        <th>Nome</th>
        <th>idade</th>
    </thead>
    <tbody>
        @foreach($explorers as $explorer)
            <tr>
                <td>{{ $explorer->name }}</td>
                <td>{{ $explorer->idade }}</td>
                <td>></td>
            </tr>
        @endforeach
    </tbody>
</table>
