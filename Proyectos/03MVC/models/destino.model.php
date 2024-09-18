<?php
// TODO: Clase de Destinos para el sistema de gestión de viajes
require_once('../config/config.php');

class Destinos
{
    public function buscar($nombre) // select * from destinos where nombre='$nombre'
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `destinos` WHERE `nombre`='$nombre'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from destinos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `destinos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($destino_id) // select * from destinos where destino_id = $destino_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `destinos` WHERE `destino_id` = $destino_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $pais, $descripcion, $costo) // insert into destinos (nombre, pais, descripcion, costo) values ($nombre, $pais, $descripcion, $costo)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `destinos`(`nombre`, `pais`, `descripcion`, `costo`) 
                       VALUES ('$nombre', '$pais', '$descripcion', '$costo')";
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

    public function actualizar($destino_id, $nombre, $pais, $descripcion, $costo) // update destinos set nombre = $nombre, pais = $pais, descripcion = $descripcion, costo = $costo where destino_id = $destino_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `destinos` SET 
                       `nombre`='$nombre',
                       `pais`='$pais',
                       `descripcion`='$descripcion',
                       `costo`='$costo' 
                       WHERE `destino_id` = $destino_id";
            if (mysqli_query($con, $cadena)) {
                return $destino_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($destino_id) // delete from destinos where destino_id = $destino_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `destinos` WHERE `destino_id`= $destino_id";
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
