<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

//TODO: controlador de reservas para el sistema de gestión de viajes

require_once('../models/reserva.model.php');
error_reporting(0);
$reservas = new Reservas();

switch ($_GET["op"]) {
    //TODO: operaciones de reservas

    case 'todos': // Procedimiento para cargar todas las reservas, con nombres de turistas y destinos
        $datos = array();
        $datos = $reservas->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener una reserva por ID
        if (!isset($_POST["reserva_id"])) {
            echo json_encode(["error" => "Reservation ID not specified."]);
            exit();
        }
        $reserva_id = intval($_POST["reserva_id"]);
        $datos = array();
        $datos = $reservas->uno($reserva_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar una reserva en la base de datos
        if (!isset($_POST["turista_id"]) || !isset($_POST["destino_id"]) || !isset($_POST["fecha_reserva"]) || !isset($_POST["numero_personas"]) || !isset($_POST["costo_final"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $turista_id = $_POST["turista_id"];
        $destino_id = $_POST["destino_id"];
        $fecha_reserva = $_POST["fecha_reserva"];
        $numero_personas = $_POST["numero_personas"];
        $costo_final = $_POST["costo_final"];

        $datos = array();
        $datos = $reservas->insertar($turista_id, $destino_id, $fecha_reserva, $numero_personas, $costo_final);
        echo json_encode($datos);
        break;

        case 'actualizar': // Procedimiento para actualizar una reserva
            if (!isset($_POST["reserva_id"]) || !isset($_POST["turista_id"]) || !isset($_POST["destino_id"]) || !isset($_POST["fecha_reserva"]) || !isset($_POST["numero_personas"])  || !isset($_POST['costo_final'])) {
                echo json_encode(["error" => "Missing required parameters."]);
                exit();
            }
        
            $reserva_id = intval($_POST["reserva_id"]);
            $turista_id = $_POST["turista_id"];
            $destino_id = $_POST["destino_id"];
            $fecha_reserva = $_POST["fecha_reserva"];
            $numero_personas = $_POST["numero_personas"];
            $costo_final = $_POST["costo_final"]; // Corregido
        
            $datos = array();
            $datos = $reservas->actualizar($reserva_id, $turista_id, $destino_id, $fecha_reserva, $numero_personas, $costo_final);
            echo json_encode($datos);
            break;
        

    case 'eliminar': // Procedimiento para eliminar una reserva
        if (!isset($_POST["reserva_id"])) {
            echo json_encode(["error" => "Reservation ID not specified."]);
            exit();
        }
        $reserva_id = intval($_POST["reserva_id"]);
        $datos = array();
        $datos = $reservas->eliminar($reserva_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
