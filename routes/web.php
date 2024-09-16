<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

// Redirige a la página de login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});
// Ruta principal del proyecto después de iniciar sesión (puedes personalizar esto)
route::get('/welcome', [DocumentoController::class, 'showAdmission'])->middleware('auth')->name('welcome');
// Ruta para mostrar la admisión solo si el usuario está autenticado
Route::middleware(['auth'])->group(function () {

    // Ruta para mostrar el formulario
    Route::get('/formulario', function () {
        return view('layouts.formulario'); 
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

    // Ruta para eliminar un documento
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');

});
 // Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

// Rutas para la edición del perfil
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// Rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
