@extends('admin.layouts.app')

@section('title', "Editar a Dúvida {$support->subject}")

@section('header')
<h1 class="text-lg text-black-500">Dúvida {{ $support->subject }}</h1>
@endsection

@section('content')
<form action="{{ route('supports.update', $support->id) }}" method="POST"> {{-- por padrão a routa só aceita POST --}}
    @method('PUT') {{-- especifica o CRUD q será feito --}}
    @include('admin.supports.partials.form', [
        'support' => $support
    ])
</form>
@endsection

