<?php
session_start();
require_once("../config/dependencias.php");
require_once("../config/conexion.php");
ob_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    die(json_encode(['error' => 'No estás autorizado']));
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$pass = $_POST['pass'];

// Validar contraseña actual
$consulta = $conexion->prepare("SELECT pass FROM t_usuarios WHERE id_usuario = :id_usuario");
$consulta->bindParam(':id_usuario', $_SESSION['usuario']['id_usuario']);
$consulta->execute();
$resultado = $consulta->fetch(PDO::FETCH_ASSOC);

// Lógica para actualizar los datos en la base de datos
try {
    $consulta = $conexion->prepare("UPDATE t_usuarios SET nombre = :nombre, apellido = :apellido, email = :email, pass = :pass WHERE id_usuario = :id_usuario");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellido', $apellido);
    $consulta->bindParam(':email', $email);
    $consulta->bindParam(':pass', $pass); 
    $consulta->bindParam(':id_usuario', $_SESSION['usuario']['id_usuario']);
    $consulta->execute();

    // Actualizamos la sesión con los nuevos datos
    $_SESSION['usuario']['nombre'] = $nombre;
    $_SESSION['usuario']['apellido'] = $apellido;
    $_SESSION['usuario']['email'] = $email;

    // Respuesta JSON
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'No se pudo actualizar los datos.']);
}

ob_end_flush();
?>