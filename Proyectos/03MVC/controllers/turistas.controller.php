<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

//TODO: controlador de turistas para el sistema de gestión de viajes

require_once('../models/turistas.model.php');
error_reporting(0);
$turistas = new Turistas();

switch ($_GET["op"]) {
    //TODO: operaciones de turistas

    case 'buscar': // Procedimiento para buscar turistas por nombre
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Tourist name not specified."]);
            exit();
        }
        $texto = $_POST["texto"];
        $datos = array();
        $datos = $turistas->buscar($texto);
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos': // Procedimiento para cargar todos los turistas
        $datos = array();
        $datos = $turistas->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un turista por ID
        if (!isset($_POST["turista_id"])) {
            echo json_encode(["error" => "Tourist ID not specified."]);
            exit();
        }
        $turista_id = intval($_POST["turista_id"]);
        $datos = array();
        $datos = $turistas->uno($turista_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un turista en la base de datos
        if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"]) || !isset($_POST["telefono"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];

        $datos = array();
        $datos = $turistas->insertar($nombre, $apellido, $email, $telefono);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un turista
        if (!isset($_POST["turista_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"]) || !isset($_POST["telefono"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $turista_id = intval($_POST["turista_id"]);
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];

        $datos = array();
        $datos = $turistas->actualizar($turista_id, $nombre, $apellido, $email, $telefono);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un turista
        if (!isset($_POST["turista_id"])) {
            echo json_encode(["error" => "Tourist ID not specified."]);
            exit();
        }
        $turista_id = intval($_POST["turista_id"]);
        $datos = array();
        $datos = $turistas->eliminar($turista_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
