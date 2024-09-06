<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentoController extends Controller
{
    // Guardar nuevo documento
    public function store(Request $request)
    {
        $this->validateDocumento($request);

        // Subir el archivo y obtener la ruta
        $path = $request->file('repositorio')->store('public/documentos');

        // Crear el documento en la base de datos
        $documento = Documento::create([
            'fecha' => $request->fecha,
            'nro_carta' => $request->nro_carta,
            'procedencia' => $request->procedencia,
            'detalle' => $request->detalle,
            'nombre_archivo' => $request->nombre_archivo,
            'repositorio' => $path
        ]);

        // Logear el documento creado
        Log::info('Documento creado:', $documento->toArray());

        // Redireccionar con un mensaje de éxito
        return back()->with('success', 'Documento creado exitosamente.');
    }

    // Mostrar la tabla de documentos
    public function index(Request $request)
    {
        $query = Documento::query();

        // Aplicar filtros de búsqueda si se envían
        if ($request->filled('nro_carta')) {
            $query->where('nro_carta', 'like', '%' . $request->input('nro_carta') . '%');
        }

        if ($request->filled('procedencia')) {
            $query->where('procedencia', 'like', '%' . $request->input('procedencia') . '%');
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->input('fecha'));
        }

        // Obtener los documentos filtrados
        $documentos = $query->get();

        return view('layouts.tabla', compact('documentos'));
    }

    // Mostrar la página de bienvenida
    public function showAdmission()
{
    $documentos = Documento::all();
    // Si necesitas mostrar un documento específico para editar, pásalo aquí
    // Por ejemplo, el primer documento:
    $documento = Documento::first(); // O encuentra el documento que necesitas
    return view('welcome', compact('documentos', 'documento'));
}

    // Editar documento
    public function edit($id)
{
    $documento = Documento::findOrFail($id);
    return response()->json($documento);
}

    // Actualizar documento existente
    public function update(Request $request, $id)
    {
        $this->validateDocumento($request);

        $documento = Documento::findOrFail($id);

        // Subir nuevo archivo si se proporciona
        if ($request->hasFile('repositorio')) {
            // Eliminar el archivo anterior si existe
            if ($documento->repositorio) {
                Storage::delete($documento->repositorio);
            }

            // Subir el archivo nuevo
            $path = $request->file('repositorio')->store('public/documentos');
            $documento->repositorio = $path;
        }

        // Actualizar los demás datos
        $documento->update($request->except('repositorio'));

        // Guardar cambios
        $documento->save();

        // Redirigir con mensaje de éxito
        return back()->with('success', 'Documento actualizado exitosamente.');
    }

    // Eliminar documento
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return redirect()->route('welcome')->with('success', 'Documento eliminado exitosamente');
    }

    // Método para validar el formulario de documentos
    protected function validateDocumento(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'nro_carta' => 'required|string|max:255',
            'procedencia' => 'required|string|max:255',
            'detalle' => 'nullable|string',
            'nombre_archivo' => 'required|string|max:255',
            'repositorio' => 'nullable|file|mimes:jpg,jpeg,png,pdf'
        ]);
    }
}

