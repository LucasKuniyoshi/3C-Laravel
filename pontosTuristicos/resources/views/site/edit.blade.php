<h1>Nova Localização de {{ $explorer->name }}</h1>

<form action="{{ route('explorers.update', $explorer->id) }}" method="POST">
    {{-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> --}}
    @csrf() {{-- CRIA O TOKEN AUTOMÁTICO --}}
    {{-- <input type="text" value="PUT" name="_method"> --}}
    @method('PUT');
    <input type="text" placeholder="Latitude" name="latitude" value="{{ $explorer->latitude }}">
    <textarea name="longitude" cols="30" rows="5" placeholder="Longitude">{{ $explorer->longitude }}</textarea>
    <button type="submit">Enviar</button>
</form>
