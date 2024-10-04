<h1>Nova Localização de {{ $explorer->name }}</h1>

@if($errors->any())
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('explorers.update', $explorer->id) }}" method="POST">
    {{-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> --}}
    @csrf() {{-- CRIA O TOKEN AUTOMÁTICO --}}
    {{-- <input type="text" value="PUT" name="_method"> --}}
    @method('PUT')
    <input type="text" placeholder="Latitude" name="latitude" value="{{ $explorer->latitude }}">
    <input type="text" placeholder="Longitude" name="longitude" value="{{ $explorer->longitude }}">
    <button type="submit">Enviar</button>
</form>
