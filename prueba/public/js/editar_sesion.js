$(document).ready(function() {
    $('#btn-editar').on('click', function() {
        $.ajax({
            url: '/suits/unidad2/prueba/app/controller/obtener_datos_usuario.php', // Cambia la ruta según tu estructura
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Asignar los valores a los campos del modal
                    $('#editNombre').val(data.usuario.nombre);
                    $('#editApellido').val(data.usuario.apellido);
                    $('#editEmail').val(data.usuario.email);
                    $('#editPassword').val(data.usuario.pass); 
                } else {
                    alert('Error al obtener los datos del usuario.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición:", error);
                alert('Error al obtener los datos del usuario.');
            }
        });
    });

    $(document).on('click', '#guardarCambios', function(event) {
        console.log("Botón 'Guardar Cambios' clickeado");

        let nombre = $('#editNombre').val();
        let apellido = $('#editApellido').val();
        let email = $('#editEmail').val();
        let pass = $('#editPassword').val(); 

        console.log("Datos capturados:", {
            nombre: nombre,
            apellido: apellido,
            email: email,
            pass: pass,
        });

        // Validar campos
        if (!nombre || !apellido || !email || !pass) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        fetch('/suits/unidad2/prueba/app/controller/editar_sesion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nombre=${nombre}&apellido=${apellido}&email=${email}&pass=${pass}` // Cambié la forma de enviar los datos
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);

            if (data.success) {
                alert('Datos actualizados correctamente');
                
                // Confirmar si el usuario desea cerrar sesión
                if (confirm("¿Deseas cerrar sesión?")) {
                    // Cerrar sesión
                    fetch('/suits/unidad2/prueba/app/controller/cerrar_sesion.php', {
                        method: 'POST',
                    }).then(() => {
                        window.location.href = '/suits/unidad2/prueba/login.php';
                    });
                } else {
                    $('p.text-white.fs-2.m-0').text(email); 
                    $('#editarUsuarioModal').modal('hide'); // Cerrar modal
                }
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error("Error en la petición:", error);
            alert('Error al actualizar los datos.');
        });
    });
});
