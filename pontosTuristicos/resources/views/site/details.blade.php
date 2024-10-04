<h1>Explorador {{ $explorer->name }}</h1>

<ul>
    <li>Nome: {{ $explorer->name }}</li>
    <li>Idade: {{ $explorer->idade }}</li>
    <h5 style="margin-bottom: 2.5px">Localização</h5>
    <li>Latitude: {{ $explorer->latitude }}</li>
    <li>Longitude: {{ $explorer->longitude }}</li>
</ul>

<form action="{{ route('explorers.destroy', $explorer->id) }}" method="POST">
    @csrf()
    @method('DELETE')
    <button type="submit">Deletar Explorador</button>
</form>
