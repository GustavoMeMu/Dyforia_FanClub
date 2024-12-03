<?php 
if (isset($_SESSION['usuario'])) {
    header("location: inicio");
    exit;
}
?>
<head> <link rel="stylesheet" href="./public/css/registro_vista.css"></head>
<form class="w-50 p-5" id="login-form">
        <div class="text-center mb-5 c-user">
            <img src="./public/css/img/Dyzforia pagina.jpg" alt="" style="width: 60%;">
            
        </div>
        <div class="input-group mt-3">
            <i class="bi bi-person-fill input-group-text fs-2"></i>
            <input type="email" id="email-id" class="form-control fs-4" placeholder="email" name="email" required>
        </div>
        <div class="input-group mt-3">
            <i class="bi bi-lock-fill input-group-text fs-2"></i>
            <input type="password" id="pass-id" class="form-control fs-4" placeholder="contraseña" name="pass" required>
        </div>
        <div class="mt-5 c-button">
            <button type="button" id="btn-saludar" class="btn w-100 fs-4" style="background-color: grey">Ingresar</button>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <p class="text" style="color:black;">¿No tienes una cuenta?</p> 
            <a href="registro" class="text-primary mx-3" style="font-size: 1.5rem;">Crear</a>
        </div>
    </form>

    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/main.js"></script>