<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Facades\Response;


Route::get('/', [DocumentoController::class, 'showAdmission'])->name('welcome');

// Ruta para mostrar el formulario
Route::get('/formulario', function () {
    return view('layouts.formulario'); // Suponiendo que 'formulario' es la vista donde está el formulario
});


// Ruta para almacenar los documentos
Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');

// Ruta para ver documentos
Route::get('/documentos/{filename}', function ($filename) {
    $path = storage_path('app/documentos/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    return Response::make($file, 200)->header("Content-Type", $type);
})->name('documentos');



// Ruta para mostrar la tabla de documentos
Route::get('/tabla', [DocumentoController::class, 'index'])->name('tabla');

// Ruta para mostrar el formulario de edición
Route::get('/documentos/{id}/edit', [DocumentoController::class, 'edit'])->name('documentos.edit');

// Ruta para actualizar un documento
Route::put('/documentos/{id}', [DocumentoController::class, 'update'])->name('documentos.update');

Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');

