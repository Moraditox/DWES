@extends('layouts.app')

@section('title', 'Agregar Centro Cívico')

@section('content')
<div class="container">
    <h1>Agregar Centro Cívico</h1>
    <form action="{{ route('centros.store') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2">
        <input type="text" name="direccion" placeholder="Dirección" class="form-control mb-2">
        <input type="text" name="telefono" placeholder="Teléfono" class="form-control mb-2">
        <input type="text" name="horario" placeholder="Horario" class="form-control mb-2">
        <input type="file" name="foto" class="form-control mb-2">
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
