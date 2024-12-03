<?php 
if (!isset($_SESSION['usuario']) ) {
    header("location: login");
    exit;
}

?>

<style>
/* Estilos generales */
body {
    background-color: #FFF8E1; /* Fondo claro */
    color: #5A4D3A; /* Texto en tono marrón claro */
}

/* Formularios */
.c-input {
    background-color: #FFF5CC; /* Fondo dorado claro */
    border: 1px solid #FFD700; /* Borde oro */
}

.c-input .form-control {
    background-color: #FFF8E1; /* Fondo más claro */
    color: #5A4D3A; /* Texto marrón claro */
}

.c-input .form-control:focus {
    border-color: #FFD700; /* Borde dorado */
    box-shadow: 0 0 5px rgba(255, 215, 0, 0.6); /* Resplandor dorado */
}

/* Botones */
.btn-success {
    background-color: #FFD700; /* Oro brillante */
    border: 1px solid #FFA000; /* Oro medio */
    color: #FFF; /* Texto blanco */
}

.btn-success:hover {
    background-color: #FFC107; /* Oro más suave */
    border-color: #FFD700; /* Oro brillante */
}

.btn-secondary {
    background-color: #FFC107; /* Oro medio */
    border: 1px solid #FFA000; /* Oro oscuro */
    color: #FFF; /* Texto blanco */
}

.btn-secondary:hover {
    background-color: #FFD700; /* Oro brillante */
}

.btn-danger {
    background-color: #E57373; /* Rojo claro */
    border-color: #C62828; /* Rojo oscuro */
}

.btn-danger:hover {
    background-color: #EF9A9A; /* Rojo más suave */
}

/* Tablas */
#myTable thead tr {
    background-color: #FFD700; /* Oro brillante */
    color: #FFF; /* Texto blanco */
}

#myTable tbody tr {
    background-color: #FFF8E1; /* Fondo claro */
    color: #5A4D3A; /* Texto marrón */
}

#myTable tbody tr:hover {
    background-color: #FFF5CC; /* Fondo dorado claro */
    color: #3E2723; /* Texto marrón oscuro */
}

#myTable td {
    padding: 8px;
    text-align: center;
    border: 1px solid #FFD700; /* Borde dorado */
}

/* Campos de búsqueda */
#myTable_filter input {
    background-color: #FFF8E1; /* Fondo claro */
    color: #5A4D3A; /* Texto marrón */
    border: 1px solid #FFD700; /* Borde dorado */
    padding: 5px;
    border-radius: 4px;
}

#myTable_filter input:focus {
    border-color: #FFC107; /* Oro medio */
    box-shadow: 0 0 5px rgba(255, 193, 7, 0.6); /* Resplandor dorado */
}

/* Modal */
.modal-content {
    background-color: #FFF5CC; /* Fondo dorado claro */
    color: #5A4D3A; /* Texto marrón */
}

.modal-header {
    background-color: #FFD700; /* Oro brillante */
    color: #FFF; /* Texto blanco */
}

.modal-footer .btn-secondary {
    background-color: #FFC107; /* Oro medio */
    color: #FFF; /* Texto blanco */
}

.modal-footer .btn-success {
    background-color: #FFD700; /* Oro brillante */
    border-color: #FFA000; /* Oro medio */
    color: #FFF; /* Texto blanco */
}

.modal-footer .btn-success:hover {
    background-color: #FFC107; /* Oro más suave */
}
</style>
<input type="text" value="<?=$_SESSION['usuario']['rol']?>" id="adm" hidden>
<div class="row justify-content-center">
    <div class="col-6 p-4">
        <form action="./index.php" method="post" class="p-4">
            <h2 class="text-center mb-4">Registrar Producto</h2>
            <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto" name="nombre_p" value="">
            </div>
            <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                <input type="text" class="form-control" id="precio" placeholder="Ingrese el precio del producto" name="precio_p" value="">
            </div>
            <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                <span class="input-group-text"><i class="bi bi-clipboard"></i></span>
                <input type="text" class="form-control" id="cantidad" placeholder="Ingrese la cantidad del producto" name="cantidad_p" value="">
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button type="button" id="btn-registrar-producto" class="btn btn-success fs-4 registrar_producto">Registrar producto</button>
            </div>
        </form>
    </div>
</div>

<table id="myTable" class="display">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="tabla_productos">
        <tr>
            <!-- Productos dinámicos -->
        </tr>
    </tbody>
</table>

<!-- Modal de Editar Usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Campos del formulario de edición -->
                <div class="mb-3">
                    <label for="editNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="editNombre" placeholder="Nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">
                </div>
                <div class="mb-3">
                    <label for="editApellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="editApellido" placeholder="Apellido" value="<?= $_SESSION['usuario']['apellido'] ?>">
                </div>
                <div class="mb-3">
                    <label for="editEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="editEmail" placeholder="Email" value="<?= $_SESSION['usuario']['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="editPassword" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="editPassword" placeholder="Contraseña Actual" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="guardarCambios">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Al abrir el modal, autocompletar los datos del usuario
    $('#editarUsuarioModal').on('show.bs.modal', function () {
        // Obtener los datos del usuario desde la sesión y asignarlos a los campos
        $('#editNombre').val("<?= $_SESSION['usuario']['nombre'] ?>");
        $('#editApellido').val("<?= $_SESSION['usuario']['apellido'] ?>");
        $('#editEmail').val("<?= $_SESSION['usuario']['email'] ?>");
    });
</script>
