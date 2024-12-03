<head> <link rel="stylesheet" href="./public/css/registro_vista.css"></head>
<body class="d-flex justify-content-center align-items-center mt-5 p-3">
    <form action="./registro_vista.php" method="post" class="w-50 p-4 text-center">
        <div class="text-center mb-4 c-user">
            <img src="./public/css/img/Dyzforia pagina.jpg" alt="" style="width: 50%;">
            <h2 class="text d-inline-block mx-2">Registro</h2>
        </div>
        <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
            <i class="bi bi-person-fill fs-3 text-white mx-1"></i>
            <input type="text" class="form-control" placeholder="Ingrese su nombre" id="nombre" name="nombre" value="">
        </div>
        <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
            <i class="bi bi-person-fill fs-3 text-white mx-1"></i>
            <input type="text" class="form-control" placeholder="Ingrese su apellido" id="apellido" name="apellido" value="">
        </div>
        <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
            <i class="bi bi-envelope-fill fs-3 text-white mx-1"></i>
            <input type="email" class="form-control" placeholder="Ingrese su email" id="email" name="email" value="">
        </div>
        <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
            <i class="bi bi-lock-fill fs-3 text-white mx-1"></i>
            <input type="password" class="form-control" placeholder="Ingrese su contraseña" id="pass" name="pass" value="">
        </div>
        <div class="mt-3 c-button">
            <button type="button" id="btn-registrar" class="btn w-100 text-white fs-4">Registrar</button>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <a href="login" class="text-white mx-2">Iniciar Sesión</a>
        </div>
    </form>
    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/main.js"></script>