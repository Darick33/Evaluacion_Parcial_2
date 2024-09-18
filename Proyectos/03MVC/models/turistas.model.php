<?php
// TODO: Clase de Turistas para el sistema de gestión de viajes
require_once('../config/config.php');

class Turistas
{
    public function buscar($nombre) // select * from turistas where nombre='$nombre'
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `turistas` WHERE `nombre`='$nombre'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
    public function todos() // select * from turistas
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `turistas`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($turista_id) // select * from turistas where turista_id = $turista_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `turistas` WHERE `turista_id` = $turista_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $email, $telefono) // insert into turistas (nombre, apellido, email, telefono) values ($nombre, $apellido, $email, $telefono)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `turistas`(`nombre`, `apellido`, `email`, `telefono`) 
                       VALUES ('$nombre', '$apellido', '$email', '$telefono')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($turista_id, $nombre, $apellido, $email, $telefono) // update turistas set nombre = $nombre, apellido = $apellido, email = $email, telefono = $telefono where turista_id = $turista_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `turistas` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `email`='$email',
                       `telefono`='$telefono' 
                       WHERE `turista_id` = $turista_id";
            if (mysqli_query($con, $cadena)) {
                return $turista_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($turista_id) // delete from turistas where turista_id = $turista_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `turistas` WHERE `turista_id`= $turista_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
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
