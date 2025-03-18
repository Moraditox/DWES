@extends('layouts.app')

@section('title', 'Editar Centro Cívico')

@section('content')
<div class="container">
    <h1>Editar Centro Cívico</h1>
    <form action="{{ route('centros.update', $centro->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ $centro->nombre }}" class="form-control mb-2">
        <input type="text" name="direccion" value="{{ $centro->direccion }}" class="form-control mb-2">
        <input type="text" name="telefono" value="{{ $centro->telefono }}" class="form-control mb-2">
        <input type="text" name="horario" value="{{ $centro->horario }}" class="form-control mb-2">
        <input type="file" name="foto" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
