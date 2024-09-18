<?php
// TODO: Clase de Reservas para el sistema de gestión de viajes
require_once('../config/config.php');

class Reservas
{
    // Método para obtener todas las reservas
    public function todos() // select * from reservas, incluyendo los ids y los nombres de turista, destino y el costo final
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT r.reserva_id, r.turista_id, r.destino_id, r.fecha_reserva, r.numero_personas, r.costo_final,
                          t.nombre AS turista_nombre, d.nombre AS destino_nombre 
                   FROM `reservas` r 
                   JOIN `turistas` t ON r.turista_id = t.turista_id 
                   JOIN `destinos` d ON r.destino_id = d.destino_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener una reserva específica por ID
    public function uno($reserva_id) // select * from reservas where reserva_id = $reserva_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT r.reserva_id, r.turista_id, r.destino_id, r.fecha_reserva, r.numero_personas, r.costo_final,
                          t.nombre AS turista_nombre, d.nombre AS destino_nombre, d.costo AS destino_costo
                   FROM `reservas` r 
                   JOIN `turistas` t ON r.turista_id = t.turista_id 
                   JOIN `destinos` d ON r.destino_id = d.destino_id 
                   WHERE r.reserva_id = $reserva_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar una nueva reserva
    public function insertar($turista_id, $destino_id, $fecha_reserva, $numero_personas, $costo_final) // insert into reservas (turista_id, destino_id, fecha_reserva, numero_personas, costo_final)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `reservas`(`turista_id`, `destino_id`, `fecha_reserva`, `numero_personas`, `costo_final`) 
                       VALUES ('$turista_id', '$destino_id', '$fecha_reserva', '$numero_personas', '$costo_final')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Retorna el ID insertado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para actualizar una reserva
    public function actualizar($reserva_id, $turista_id, $destino_id, $fecha_reserva, $numero_personas, $costo_final) // update reservas set turista_id = $turista_id, destino_id = $destino_id, fecha_reserva = $fecha_reserva, numero_personas = $numero_personas, costo_final = $costo_final where reserva_id = $reserva_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `reservas` SET 
                       `turista_id`='$turista_id', 
                       `destino_id`='$destino_id', 
                       `fecha_reserva`='$fecha_reserva', 
                       `numero_personas`='$numero_personas',
                       `costo_final`='$costo_final' 
                       WHERE `reserva_id` = $reserva_id";
            if (mysqli_query($con, $cadena)) {
                return $reserva_id; // Retorna el ID actualizado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar una reserva
    public function eliminar($reserva_id) // delete from reservas where reserva_id = $reserva_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `reservas` WHERE `reserva_id` = $reserva_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Éxito
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
