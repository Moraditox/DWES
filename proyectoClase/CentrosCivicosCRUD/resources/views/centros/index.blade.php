@extends('layouts.app')

@section('title', 'Lista de Centros Cívicos')

@section('content')
<div class="container">
    <h1 class="mb-3">Centros Cívicos</h1>
    <a href="{{ route('centros.create') }}" class="btn btn-primary">Agregar Centro</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($centros as $centro)
            <tr>
                <td>{{ $centro->nombre }}</td>
                <td>{{ $centro->direccion }}</td>
                <td>{{ $centro->telefono }}</td>
                <td>{{ $centro->horario }}</td>
                <td>
                    <a href="{{ route('centros.edit', $centro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
