import './bootstrap';
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

/*
function loadEditForm(id) {
    fetch(`/documentos/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Rellenar los campos del formulario con los datos del documento
        
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('nro_carta').value = data.nro_carta;
            document.getElementById('procedencia').value = data.procedencia;
            document.getElementById('nombre_archivo').value = data.nombre_archivo;
            document.getElementById('detalle').value = data.detalle;
            document.getElementById('editarDocumentoForm').action = `/documentos/${data.id}`;
            document.getElementById('editardocumentoForm').method = 'POST'; // Asegúrate de que el método sea POST
            
            // Mostrar el modal
            var myModal = new bootstrap.Modal(document.getElementById('editarDocumentoModal'));
            myModal.show();
        })
    .catch(error => console.error('Error:', error));
    }*/