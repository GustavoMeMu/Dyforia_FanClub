<?php 
    if(isset($_REQUEST['view'])){
        $vista = $_REQUEST['view'];
        }
        else {
            $vista = "inicio";
        }
    $vista = $_REQUEST['view'];
    switch ($vista) {
        case "inicio":{
            require_once './views/home.php';       
            break;
        }
        case "login":{
            require_once './views/login.php';       
            break;
        }
        case "registro":{
            require_once './views/registro.php';       
            break;
        }
        case "inventario":{
            require_once './views/inventario.php';       
            break;
        }
        case "fechas_proximas":{
            require_once './views/fechas.php';
        break;
        }
        case "exclusivo":{
            require_once './views/exclusivo.php';
        break;
        }
        default:
        require_once './views/error.php';       
        
            break;
    }
    ?>