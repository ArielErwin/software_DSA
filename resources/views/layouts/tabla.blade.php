<!-- resources/views/layouts/tabla.blade.php -->
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        });
    </script>
@endif
<div style="overflow-x:auto;">
    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-title">
                <th>ID</th>
                <th>Fecha</th>
                <th>Nro Carta</th>
                <th>Procedencia</th>
                <th>Detalle</th>
                <th>Nombre Archivo</th>
                <th>Repositorio</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>
                    <td>{{ $documento->fecha }}</td>
                    <td>{{ $documento->nro_carta }}</td>
                    <td>{{ $documento->procedencia }}</td>
                    <td>{{ $documento->detalle }}</td>
                    <td>{{ $documento->nombre_archivo }}</td>
                    <td><a href="{{ Storage::url($documento->repositorio) }}" target="_blank">Ver archivo</a></td>
                    <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            
                            
                            <button class="btn btn-editar" data-id="{{ $documento->id }}">Editar</button>


                                <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                </tr>
            @endforeach
    </tbody>
</table>
</div>

