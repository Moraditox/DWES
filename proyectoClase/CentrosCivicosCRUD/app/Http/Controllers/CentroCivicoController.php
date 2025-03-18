<?php

namespace App\Http\Controllers;

use App\Models\CentroCivico;
use Illuminate\Http\Request;

class CentroCivicoController extends Controller
{
    // Mostrar la lista de centros cívicos
    public function index()
    {
        $centros = CentroCivico::all();
        return view('centros.index', compact('centros'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('centros.create');
    }

    // Guardar un nuevo centro cívico
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'horario' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:20',
        ]);

        CentroCivico::create($request->all());

        return redirect()->route('centros.index')->with('success', 'Centro Cívico creado correctamente.');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $centro = CentroCivico::findOrFail($id);
        return view('centros.edit', compact('centro'));
    }

    // Actualizar un centro cívico
    public function update(Request $request, $id)
    {
        $centro = CentroCivico::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'horario' => 'nullable|string|max:20',
            'foto' => 'nullable|string|max:20',
        ]);

        $centro->update($request->all());

        return redirect()->route('centros.index')->with('success', 'Centro Cívico actualizado correctamente.');
    }

    // Eliminar un centro cívico
    public function destroy($id)
    {
        CentroCivico::destroy($id);
        return redirect()->route('centros.index')->with('success', 'Centro Cívico eliminado.');
    }
}
