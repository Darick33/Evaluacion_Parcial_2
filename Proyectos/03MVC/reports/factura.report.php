<?php
require("fpdf/fpdf.php");
require_once("../models/factura.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$factura = new Factura();

if (isset($_GET['idFactura'])) {
    $id = $_GET['idFactura'];

// $datosFacura= $factura->uno($id);


    
    // Configurar fuente y encabezado
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(0, 8, "Empresa XYZ", 0, 1, 'L');
    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(0, 10, "Factura No. 001-001-000000001", 0, 1, 'R');
    $pdf->SetFont("Arial", "", 12);

    $datosFacura  =  mysqli_fetch_assoc($factura->uno($id));

    $pdf->Cell(0, 10, $datosFacura["Fecha"], 0, 1, 'R');
    
    
    
    
    
    $pdf->SetFont("Arial", "", 9);
    $pdf->Cell(0, 6, "RUC: 1234567690", 0, 1, 'L');
    $pdf->Cell(0, 6, "Direccion: Calle Falsa 123, Quito, Ecuador", 0, 1, 'L');
    $pdf->Cell(0, 6, "Telefono: +593 999 999 999", 0, 1, 'L');
    $pdf->Cell(0, 6, "Email: info@example.com", 0, 1, 'L');
    
    
    // Información del cliente
    $pdf->SetFont("Arial", "B", 9);
    
    $pdf->Cell(0, 10, "Datos del Cliente", 0, 1, 'L');
    $pdf->SetFont("Arial", "", 9);
    
    $pdf->Cell(0, 6, "Nombre: " . $datosFacura["Nombres"], 0, 1, 'L');
    $pdf->Cell(0, 6, "Cedula/RUC:". $datosFacura["Cedula"], 0, 1, 'L');
    $pdf->Cell(0, 6, "Direccion:". $datosFacura["Direccion"], 0, 1, 'L');
    $pdf->Cell(0, 6, "Telefono: ". $datosFacura["Telefono"], 0, 1, 'L');
    $pdf->Ln(10);
    
    // Configurar fuente para tabla
    $pdf->SetFont("Arial", "B", 10);
    
    // Tabla de productos con bordes grises
    $pdf->SetDrawColor(192, 192, 192); // Color gris claro para las líneas
    $pdf->Cell(40, 7, 'Descripcion', 1);
    $pdf->Cell(20, 7, 'Cantidad', 1);
    $pdf->Cell(40, 7, 'Precio Unitario', 1);
    $pdf->Cell(40, 7, 'Subtotal', 1);
    $pdf->Cell(20, 7, 'IVA (12%)', 1);
    $pdf->Cell(30, 7, 'Total', 1);
    $pdf->Ln();
    
    // Datos de productos
    $productos = [
        ["Producto 1", 2, "$1,000.00", "$2,000.00", "$12.00", "$2,000.00"],
        ["Producto 2", 1, "$1,500.00", "$1,500.00", "$18.00", "$1,500.00"],
        ["Producto 3", 3, "$500.00", "$1,500.00", "$6.00", "$1,500.00"]
    ];
    
    $pdf->SetFont("Arial", "", 10);
    
    foreach ($productos as $item) {
        $pdf->Cell(40, 7, $item[0], 1);
        $pdf->Cell(20, 7, $item[1], 1);
        $pdf->Cell(40, 7, $item[2], 1);
        $pdf->Cell(40, 7, $item[3], 1);
        $pdf->Cell(20, 7, $item[4], 1);
        $pdf->Cell(30, 7, $item[5], 1);
        $pdf->Ln();
    }
    
    // Totales alineados a la izquierda y con líneas grises
    $pdf->Ln(10);
    if (isset($datosFacura["Sub_total"]) && isset($datosFacura["Sub_total_iva"]) && isset($datosFacura["Valor_IVA"])) {
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'Subtotal', 1, 0, 'L');
        $pdf->Cell(40, 7, $datosFacura["Sub_total"], 1, 1, 'L');
        
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'SUB TOTAL IVA (15%)', 1, 0, 'L');
        $pdf->Cell(40, 7, $datosFacura["Sub_total_iva"], 1, 1, 'L');
        
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'IVA (15%)', 1, 0, 'L');
        $pdf->Cell(40, 7, $datosFacura["Valor_IVA"], 1, 1, 'L');
    } else {
        $pdf->Cell(0, 10, "Error: Datos incompletos en la factura.", 0, 1, 'L');
    }
    
    
    // Información de pago con estilo y alineación izquierda
    $pdf->Ln(10);
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(0, 10, "Forma de pago: Transferencia Bancaria", 0, 1, 'L');
    $pdf->SetFont("Arial", "", 10);
    $pdf->Cell(0, 10, "Cuenta Bancaria: Banco Pichincha, Cta: 123456789", 0, 1, 'L');
    $pdf->SetFont("Arial", "I", 10);
    $pdf->Cell(0, 10, "Nota: Gracias por su compra.", 0, 1, 'L');
    
    // Salida del PDF
        // Enviar encabezado para descarga del archivo
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="factura.pdf"');
        $pdf->Output();
}else{
       
    // Configurar fuente y encabezado
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(0, 8, "Empresa XYZ", 0, 1, 'L');
    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(0, 10, "Factura No. 001-001-000000001", 0, 1, 'R');
    $pdf->SetFont("Arial", "", 12);


    $pdf->Cell(0, 10, '15/09/2024', 0, 1, 'R');
    
    
    
    
    
    $pdf->SetFont("Arial", "", 9);
    $pdf->Cell(0, 6, "RUC: 1234567690", 0, 1, 'L');
    $pdf->Cell(0, 6, "Direccion: Calle Falsa 123, Quito, Ecuador", 0, 1, 'L');
    $pdf->Cell(0, 6, "Telefono: +593 999 999 999", 0, 1, 'L');
    $pdf->Cell(0, 6, "Email: info@example.com", 0, 1, 'L');
    
    
    // Información del cliente
    $pdf->SetFont("Arial", "B", 9);
    
    $pdf->Cell(0, 10, "Datos del Cliente", 0, 1, 'L');
    $pdf->SetFont("Arial", "", 9);
    
    $pdf->Cell(0, 6, "Nombre: " . 'Juan Perez', 0, 1, 'L');
    $pdf->Cell(0, 6, "Cedula/RUC:". '123456', 0, 1, 'L');
    $pdf->Cell(0, 6, "Direccion:". 'Calle 123', 0, 1, 'L');
    $pdf->Cell(0, 6, "Telefono: ". '123456789', 0, 1, 'L');
    $pdf->Ln(10);
    
    // Configurar fuente para tabla
    $pdf->SetFont("Arial", "B", 10);
    
    // Tabla de productos con bordes grises
    $pdf->SetDrawColor(192, 192, 192); // Color gris claro para las líneas
    $pdf->Cell(40, 7, 'Descripcion', 1);
    $pdf->Cell(20, 7, 'Cantidad', 1);
    $pdf->Cell(40, 7, 'Precio Unitario', 1);
    $pdf->Cell(40, 7, 'Subtotal', 1);
    $pdf->Cell(20, 7, 'IVA (12%)', 1);
    $pdf->Cell(30, 7, 'Total', 1);
    $pdf->Ln();
    
    // Datos de productos
    $productos = [
        ["Producto 1", 2, "$1,000.00", "$2,000.00", "$12.00", "$2,000.00"],
        ["Producto 2", 1, "$1,500.00", "$1,500.00", "$18.00", "$1,500.00"],
        ["Producto 3", 3, "$500.00", "$1,500.00", "$6.00", "$1,500.00"]
    ];
    
    $pdf->SetFont("Arial", "", 10);
    
    foreach ($productos as $item) {
        $pdf->Cell(40, 7, $item[0], 1);
        $pdf->Cell(20, 7, $item[1], 1);
        $pdf->Cell(40, 7, $item[2], 1);
        $pdf->Cell(40, 7, $item[3], 1);
        $pdf->Cell(20, 7, $item[4], 1);
        $pdf->Cell(30, 7, $item[5], 1);
        $pdf->Ln();
    }
    
    // Totales alineados a la izquierda y con líneas grises
    $pdf->Ln(10);
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'Subtotal', 1, 0, 'L');
        $pdf->Cell(40, 7, '122.33', 1, 1, 'L');
        
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'SUB TOTAL IVA (15%)', 1, 0, 'L');
        $pdf->Cell(40, 7, '33.5', 1, 1, 'L');
        
        $pdf->Cell(80); 
        $pdf->Cell(40, 7, 'IVA (15%)', 1, 0, 'L');
        $pdf->Cell(40, 7, '0.15', 1, 1, 'L');
    
    
    // Información de pago con estilo y alineación izquierda
    $pdf->Ln(10);
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(0, 10, "Forma de pago: Transferencia Bancaria", 0, 1, 'L');
    $pdf->SetFont("Arial", "", 10);
    $pdf->Cell(0, 10, "Cuenta Bancaria: Banco Pichincha, Cta: 123456789", 0, 1, 'L');
    $pdf->SetFont("Arial", "I", 10);
    $pdf->Cell(0, 10, "Nota: Gracias por su compra.", 0, 1, 'L');
    
    // Salida del PDF
    $pdf->Output();
}

