<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

//TODO: controlador de destinos para el sistema de gestión de viajes

require_once('../models/destino.model.php');
error_reporting(0);
$destinos = new Destinos();

switch ($_GET["op"]) {
    //TODO: operaciones de destinos

    case 'buscar': // Procedimiento para buscar destinos por nombre
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Destination name not specified."]);
            exit();
        }
        $texto = $_POST["texto"];
        $datos = array();
        $datos = $destinos->buscar($texto);
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos': // Procedimiento para cargar todos los destinos
        $datos = array();
        $datos = $destinos->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un destino por ID
        if (!isset($_POST["destino_id"])) {
            echo json_encode(["error" => "Destination ID not specified."]);
            exit();
        }
        $destino_id = intval($_POST["destino_id"]);
        $datos = array();
        $datos = $destinos->uno($destino_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un destino en la base de datos
        if (!isset($_POST["nombre"]) || !isset($_POST["pais"]) || !isset($_POST["descripcion"]) || !isset($_POST["costo"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $pais = $_POST["pais"];
        $descripcion = $_POST["descripcion"];
        $costo = $_POST["costo"];

        $datos = array();
        $datos = $destinos->insertar($nombre, $pais, $descripcion, $costo);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un destino
        if (!isset($_POST["destino_id"]) || !isset($_POST["nombre"]) || !isset($_POST["pais"]) || !isset($_POST["descripcion"]) || !isset($_POST["costo"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $destino_id = intval($_POST["destino_id"]);
        $nombre = $_POST["nombre"];
        $pais = $_POST["pais"];
        $descripcion = $_POST["descripcion"];
        $costo = $_POST["costo"];

        $datos = array();
        $datos = $destinos->actualizar($destino_id, $nombre, $pais, $descripcion, $costo);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un destino
        if (!isset($_POST["destino_id"])) {
            echo json_encode(["error" => "Destination ID not specified."]);
            exit();
        }
        $destino_id = intval($_POST["destino_id"]);
        $datos = array();
        $datos = $destinos->eliminar($destino_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
