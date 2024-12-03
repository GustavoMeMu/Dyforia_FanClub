const validar_usuario = (event) => {
    event.preventDefault(); // Evitar el comportamiento por defecto

    let email = document.getElementById('email-id').value;
    let pass = document.getElementById('pass-id').value;

    if (email === "" || pass === "") {
        Swal.fire({
            icon: "error",
            title: "Por favor completa todos los campos.",
            timer: 1000,
            showConfirmButton: false
        });
        return;
    }

    let data = new FormData();
    data.append("email", email);
    data.append("pass", pass);
    data.append("metodo", "login_datos"); // Método para login
    
    fetch("app/controller/obtener_datos_usuario.php", {
        method: "POST",
        body: data
    }).then(response => response.json())
    .then(async respuesta => {
        if (respuesta[0] === 1) {
            await Swal.fire({
                icon: "success",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
            window.location = "inicio";
        } else {
            Swal.fire({
                icon: "error",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
        }
    }).catch(error => {
        Swal.fire({
            icon: "error",
            title: "Error en la conexión.",
            timer: 1000,
            showConfirmButton: false
        });
    });
};

const registrar_usuario = (event) => {
    event.preventDefault();

    let nombre = document.getElementById('nombre').value;
    let apellido = document.getElementById('apellido').value;
    let email = document.getElementById('email').value;
    let pass = document.getElementById('pass').value;

    if (nombre === "" || apellido === "" || email === "" || pass === "") {
        Swal.fire({
            icon: "error",
            title: "Todos los campos son obligatorios.",
            timer: 1000,
            showConfirmButton: false
        });
        return;
    }

    let data = new FormData();
    data.append("nombre", nombre);
    data.append("apellido", apellido);
    data.append("email", email);
    data.append("pass", pass);
    data.append("metodo", "registro_datos");

    fetch("app/controller/obtener_datos_usuario.php", {
        method: "POST",
        body: data
    }).then(response => response.json())
    .then(async respuesta => {
        if (respuesta[0] === 1) {
            await Swal.fire({
                icon: "success",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
            window.location = "login";
        } else {
            Swal.fire({
                icon: "error",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
        }
    }).catch(error => {
        Swal.fire({
            icon: "error",
            title: "Error en la conexión.",
            timer: 1000,
            showConfirmButton: false
        });
    });
};
const actualizar_usuario = (event) => {
    event.preventDefault(); 

    let nombre = document.getElementById("editNombre").value;
    let apellido = document.getElementById("editApellido").value;
    let email = document.getElementById("editEmail").value;
    let password = document.getElementById("editPassword").value;

    if (nombre === "" || apellido === "" || email === "") { // Validación de campos
        Swal.fire({
            icon: "error",
            title: "Todos los campos son obligatorios.",
            timer: 1000,
            showConfirmButton: false
        });
        return;
    }

    let data = new FormData();
    data.append("nombre", nombre);
    data.append("apellido", apellido);
    data.append("email", email);
    if (password) data.append("pass", password); // Solo agregar si hay nueva contraseña
    data.append("metodo", "editar_datos");

    fetch("app/controller/obtener_datos_usuario.php", {
        method: "POST",
        body: data
    }).then(response => response.json())
    .then(async respuesta => {
        if (respuesta[0] === 1) {
            await Swal.fire({
                icon: "success",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: "error",
                title: `${respuesta[1]}`,
                timer: 1000,
                showConfirmButton: false
            });
        }
    });
};


window.addEventListener('DOMContentLoaded', () => {
    const btnLogin = document.getElementById('btn-saludar');
    if (btnLogin) {
        btnLogin.addEventListener('click', validar_usuario);
    }

    const btnRegistrar = document.getElementById('btn-registrar');
    if (btnRegistrar) {
        btnRegistrar.addEventListener('click', registrar_usuario);
    }
    const btnactualizar = document.getElementById('guardarCambios');
    if (btnactualizar) {
        btnactualizar.addEventListener('click', actualizar_usuario);
    }
});
