@if(isset($documento))
<div class="modal fade" id="editarDocumentoModal" tabindex="-1" aria-labelledby="editarDocumentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Cambiado a modal-lg para mayor espacio -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarDocumentoModalLabel">Editar Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarDocumentoForm" action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('fecha', $documento->fecha) }}" required>
                                @error('fecha')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nro_carta" class="form-label">Número de Carta:</label>
                                <input type="text" id="nro_carta" name="nro_carta" class="form-control" value="{{ old('nro_carta', $documento->nro_carta) }}" required>
                                @error('nro_carta')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="procedencia" class="form-label">Procedencia:</label>
                                <input type="text" id="procedencia" name="procedencia" class="form-control" value="{{ old('procedencia', $documento->procedencia) }}" required>
                                @error('procedencia')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="detalle" class="form-label">Detalle:</label>
                                <textarea id="detalle" name="detalle" class="form-control">{{ old('detalle', $documento->detalle) }}</textarea>
                                @error('detalle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nombre_archivo" class="form-label">Nombre del Archivo:</label>
                                <input type="text" id="nombre_archivo" name="nombre_archivo" class="form-control" value="{{ old('nombre_archivo', $documento->nombre_archivo) }}" required>
                                @error('nombre_archivo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="repositorio" class="form-label">Archivo:</label>
                                <input type="file" id="repositorio" name="repositorio" class="form-control">
                                @if($documento->repositorio)
                                    <p>Archivo actual: <a href="{{ route('documentos', basename($documento->repositorio)) }}" target="_blank">{{ basename($documento->repositorio) }}</a></p>
                                @endif
                                @error('repositorio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Actualizar Documento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
    <p>No se encontró el documento para editar.</p>
@endif
