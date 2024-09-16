import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

$(document).on('click', '.btn-editar', function() {
    var documentoId = $(this).data('id');
    loadEditForm(documentoId);
});

function loadEditForm(documentoId) {
    $.ajax({
        url: '/documentos/' + documentoId + '/edit',
        type: 'GET',
        success: function(data) {
            // Cargar los datos en el formulario
            $('#editarDocumentoForm #fecha').val(data.fecha);
            $('#editarDocumentoForm #nro_carta').val(data.nro_carta);
            $('#editarDocumentoForm #procedencia').val(data.procedencia);
            $('#editarDocumentoForm #detalle').val(data.detalle);
            $('#editarDocumentoForm #nombre_archivo').val(data.nombre_archivo);

            // Cambiar la acción del formulario para que use la ID correcta
            $('#editarDocumentoForm').attr('action', '/documentos/' + data.id);

            // Mostrar el modal
            $('#editarDocumentoModal').modal('show');
        },
        error: function(xhr) {
            console.error('Error al cargar el formulario de edición:', xhr);
        }
    });
}

