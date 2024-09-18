<?php
require("fpdf/fpdf.php");
require_once("../models/reserva.model.php");
require_once("../models/turistas.model.php");
require_once("../models/destino.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$reserva = new Reservas();
$turista = new Turistas();
$destino = new Destinos();

if (isset($_GET['reserva_id'])) {
    $id = $_GET['reserva_id'];

// $datosFacura= $reserva->uno($id);


    
$pdf->SetFont('Arial', 'B', 18);
$pdf->Ln(0); // Salta un poco hacia abajo después del encabezado
$pdf->Cell(0, 15, "Ficha de Reserva", 0, 1, 'C'); // Título centrado

// Línea horizontal para separar el encabezado
$pdf->Line(10, 25, 200, 25); // Línea horizontal
$pdf->Line(10, 60, 200, 60); // Línea horizontal
$pdf->Line(10, 110, 200, 110); // Línea horizontal
$pdf->Line(10, 115, 200, 115); // Línea horizontal
$pdf->Line(10, 170, 200, 170); // Línea horizontal

    $datosReserva  =  mysqli_fetch_assoc($reserva->uno($id));
    $datosTurista  =  mysqli_fetch_assoc($turista->uno($datosReserva["turista_id"]));
    $datosDestino  =  mysqli_fetch_assoc($destino->uno($datosReserva["destino_id"]));


    $pdf->SetFont('Arial', 'B', 15);
    // $pdf->Cell(0, 15, "Reserva", 0, 1, 'C'); // Título centrado
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Fecha de la Reserva:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10); // Normal para el contenido
    $pdf->Cell(0, 8, mb_convert_encoding($datosReserva["fecha_reserva"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Numero de Personas:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10); // Normal para el contenido
    $pdf->Cell(0, 8, mb_convert_encoding($datosReserva["numero_personas"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');


    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("NPrecio Final:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10); // Normal para el contenido
    $pdf->Cell(0, 8, mb_convert_encoding($datosReserva["costo_final"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');







    $pdf->Ln(10); // Salta un poco hacia abajo después del encabezado

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 15, "Datos Del turista", 0, 1, 'L'); // Título centrado

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Nombre:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10); // Normal para el contenido
    $pdf->Cell(0, 8, mb_convert_encoding($datosTurista["nombre"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    //apellido
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Apellido:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10); // Normal para el contenido
    $pdf->Cell(0, 8, mb_convert_encoding($datosTurista["apellido"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    //telefono
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Telefono:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosTurista["telefono"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    //email
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Email:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosTurista["email"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

    $pdf->Line(10, 50, 200, 50); // Línea horizontal

    //Destino
    $pdf->Ln(10); // Salta un poco hacia abajo después del encabezado

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 15, "Datos del Destino", 0, 1, 'L'); // Título centrado
    //nombre
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Nombre:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosDestino["nombre"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    //pais
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Pais:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosDestino["pais"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    //descripcion
    $pdf->SetFont('Arial', 'B', 10);    
    $pdf->Cell(40, 8, mb_convert_encoding("Descripcion:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosDestino["descripcion"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    //costo
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 8, mb_convert_encoding("Costo por persona:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, mb_convert_encoding($datosDestino["costo"], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');


    

    // Salida del PDF
        // Enviar encabezado para descarga del archivo
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="factura.pdf"');
        $pdf->Output();
}