<?php

// Incluir archivo de conexión
require_once './app/config/conexion.php';

// Verifica si se hace una solicitud POST para obtener los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['metodo']) && $_POST['metodo'] === 'obtener_datos') {
    try {
        // Crear una instancia de la clase Conexion para obtener la conexión
        $conexion = new Conexion();
        $db = $conexion->obtener_conexion();

        // Consulta para obtener los productos
        $query = "SELECT id_producto, producto, precio, cantidad FROM t_productos";
        $stmt = $db->prepare($query);
        $stmt->execute();

        // Obtener los datos
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Enviar los datos en formato JSON
        echo json_encode($productos);
    } catch (Exception $e) {
        // Si hay un error, enviamos el error en formato JSON
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit; // Finaliza el script para evitar cargar el HTML innecesariamente
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Dinámica de Productos</title>
    <div class="card">
        <img src="./public/css/img/estadio Dyzforia.jpg" alt="Producto 6" class="card-image" style="width: 35%; margin-left:32%;">
        <P style="color: #fff; font-size:xxlarge;">Procura llegar antes al evento para alcanzar tus boletos</P>
        <div class="card-info">
        </div>
    </div>
    <style>
        /* Cambiar el color de fondo de los encabezados */
        #myTable thead tr {
            background-color: #d4af37;
            /* Dorado */
            color: #f5f5f5;
            /* Texto blanco plateado */
            font-weight: bold;
        }

        /* Modificar el estilo de las filas */
        #myTable tbody tr {
            background-color: #e5e4e2;
            /* Plateado claro */
            color: #333;
            /* Texto gris oscuro */
        }

        /* Estilo para las filas al pasar el mouse */
        #myTable tbody tr:hover {
            background-color: #f5f5dc;
            /* Dorado claro */
            color: #000;
            /* Texto negro */
        }

        /* Estilo para las celdas */
        #myTable td {
            padding: 8px;
            text-align: center;
            border: 1px solid #c5b358;
            /* Borde dorado oscuro */
        }
    </style>
</head>

<body>
<input type="text" value="<?=$_SESSION['usuario']['rol']?>" id="adm">    

    <h1>Lista de Productos</h1>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">Zona</th>
                <th scope="col">Precio</th>
                <th scope="col">Disponibilidad</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="tabla_productos">
            <!-- Los datos se cargarán dinámicamente aquí -->
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tbody = document.querySelector('#tabla_productos');

            // Función para cargar datos desde el servidor
            const cargarDatos = () => {
                fetch('', { // Realiza la solicitud al mismo archivo
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'metodo=obtener_datos' // Se indica qué acción realizar en el servidor
                    })
                    .then(response => response.json()) // Convierte la respuesta a JSON
                    .then(data => {
                        console.log(data);
                        
                        tbody.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos datos
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(producto => {
                                // Agregar una nueva fila para cada producto
                                const fila = `
                                <tr>
                                    <td>${producto.id_producto}</td>
                                    <td>${producto.producto}</td>
                                    <td>${producto.precio}</td>
                                    <td>${producto.cantidad}</td>
                                </tr>
                            `;
                                tbody.innerHTML += fila;
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="4">No se encontraron productos</td></tr>';
                        }
                    })
                    // .catch(error => console.error('Error al obtener los datos:', error));
            };

            // Cargar los datos cuando la página se cargue
            cargarDatos();
        });
        
    </script>
</body>

</html>