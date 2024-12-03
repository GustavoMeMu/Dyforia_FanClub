<?php
require_once "../config/conexion.php";
session_start();

$expresion = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (isset($_SESSION['usuario'])) {
    header("location: ./index.php");
}

if ($_POST) {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['pass']) && !empty($_POST['pass'])) {

        if (is_numeric($_POST['nombre'])) {
            echo json_encode([0, "No puedes agregar números en el input nombre"]);
        } else if (is_numeric($_POST['apellido'])) {
            echo json_encode([0, "No puedes agregar números en el input apellido"]);
        } else if (!preg_match($expresion, $_POST['email'])) {
            echo json_encode([0, "No cumples con las especificaciones de un correo"]);
        } else {
            // Validar si el correo ya existe
            $email = $_POST['email'];
            $consulta = $conexion->prepare("SELECT * FROM t_usuarios WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                // Si ya existe, retornar error
                echo json_encode([0, "El correo electrónico ya está registrado"]);
            } else {
                // Insertar nuevo usuario
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $passw = $_POST['pass'];
                
                $insercion = $conexion->prepare("INSERT INTO t_usuarios (nombre,apellido,email,pass) 
                                                 VALUES (:nombre,:apellido,:email,:pass)");
                $insercion->bindParam(':nombre', $nombre);
                $insercion->bindParam(':apellido', $apellido);
                $insercion->bindParam(':email', $email);
                $insercion->bindParam(':pass', $passw);

                if ($insercion->execute()) {
                    echo json_encode([1, "Usuario registrado correctamente"]);
                } else {
                    echo json_encode([0, "Usuario NO registrado"]);
                }
            }
        }
    } else {
        echo json_encode([0, "No puedes dejar campos vacíos"]);
    }
}
?>
