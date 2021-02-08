<?php
require '../../fpdf/fpdf.php';
require '../../Clases/BD.php';
$conn = new baseD();
if (isset($_POST['contri_general'])) {
   
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de contribuyentes(Palabra Clave).', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(8, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(70, 10, 'Nombre', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Medidor', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIC', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIS', 1, 0, 'C', 1);
    $pdf->Cell(100, 10, 'Direccion', 1, 0, 'C', 1);
    $pdf->Cell(40, 10, 'Municipio', 1, 0, 'C', 1);
    $pdf->Cell(14, 10, 'Unicom', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
     $con_palabra = $conn->busquedaFree("SELECT * FROM cliente");
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(8, 6, $co, 1, 0, 'C');
            $pdf->Cell(70, 6, $datos_palabra['nombres'], 1, 0, 'L');
            $pdf->Cell(15, 6, $datos_palabra['medidor'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nic'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nis'], 1, 0, 'C');
            $pdf->Cell(100, 6, $datos_palabra['direccion'], 1, 0, 'L');
            $pdf->Cell(40, 6, $datos_palabra['municipio'], 1, 0, 'L');
            $pdf->Cell(14, 6, $datos_palabra['unicom'], 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(277, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
} elseif (isset($_POST['contri_palabra'])) {
    $palabra_us = $_POST['palabra'];
    //INICIO PDF
    $con_palabra = $conn->busquedaFree("SELECT * FROM cliente WHERE direccion like '%$palabra_us%' ");
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de contribuyentes(Palabra Clave).', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(5, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(70, 10, 'Nombre', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Medidor', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIC', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIS', 1, 0, 'C', 1);
    $pdf->Cell(100, 10, 'Direccion', 1, 0, 'C', 1);
    $pdf->Cell(40, 10, 'Municipio', 1, 0, 'C', 1);
    $pdf->Cell(14, 10, 'Unicom', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(5, 6, $co, 1, 0, 'C');
            $pdf->Cell(70, 6, $datos_palabra['nombres'], 1, 0, 'L');
            $pdf->Cell(15, 6, $datos_palabra['medidor'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nic'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nis'], 1, 0, 'C');
            $pdf->Cell(100, 6, $datos_palabra['direccion'], 1, 0, 'L');
            $pdf->Cell(40, 6, $datos_palabra['municipio'], 1, 0, 'L');
            $pdf->Cell(14, 6, $datos_palabra['unicom'], 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(274, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
} elseif (isset($_POST['cobal_general'])) {
    //INICIO PDF

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de Cobal.', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(5, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIC', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIS', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Unicom', 1, 0, 'C', 1);
    $pdf->Cell(23, 10, 'Ct_Alcaldia', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Periodo', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Fecha_Pago', 1, 0, 'C', 1);
    $pdf->Cell(13, 10, 'Aseo', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Alumbrado', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Desechos', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Pavimento', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Fiesta', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Otros', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Pendiente', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Total', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
    $con_palabra = $conn->busquedaFree("SELECT * FROM cobal");
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(5, 6, $co, 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nic'], 1, 0, 'L');
            $pdf->Cell(15, 6, $datos_palabra['nis'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['unicom'], 1, 0, 'C');
            $pdf->Cell(23, 6, $datos_palabra['cuenta_alcaldia'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['periodo'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['fecha_pago'], 1, 0, 'C');
            $pdf->Cell(13, 6, $datos_palabra['aseo'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['alumbrado'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['desechos_solidos'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['pavimento'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['fondo_fiesta'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['otros_conceptos'], 1, 0, 'L');
            $pdf->Cell(25, 6, $datos_palabra['cuenta_pendiente'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['total'], 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(282, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
} elseif (isset($_POST['cobal_periodo'])) {
    $periodo_us = $_POST['periodo'];
    //INICIO PDF

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de Cobal(Por periodo).', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(5, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIC', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIS', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Unicom', 1, 0, 'C', 1);
    $pdf->Cell(23, 10, 'Ct_Alcaldia', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Periodo', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Fecha_Pago', 1, 0, 'C', 1);
    $pdf->Cell(13, 10, 'Aseo', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Alumbrado', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Desechos', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Pavimento', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Fiesta', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Otros', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Pendiente', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Total', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
    $con_palabra = $conn->busquedaFree("SELECT * FROM cobal where periodo = '$periodo_us'");
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(5, 6, $co, 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nic'], 1, 0, 'L');
            $pdf->Cell(15, 6, $datos_palabra['nis'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['unicom'], 1, 0, 'C');
            $pdf->Cell(23, 6, $datos_palabra['cuenta_alcaldia'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['periodo'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['fecha_pago'], 1, 0, 'C');
            $pdf->Cell(13, 6, $datos_palabra['aseo'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['alumbrado'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['desechos_solidos'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['pavimento'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['fondo_fiesta'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['otros_conceptos'], 1, 0, 'L');
            $pdf->Cell(25, 6, $datos_palabra['cuenta_pendiente'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['total'], 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(282, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
} elseif (isset($_POST['cobal_fecha'])) {
    $fecha_us = $_POST['año'];
    //INICIO PDF

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de Cobal(Por periodo).', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(5, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIC', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'NIS', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Unicom', 1, 0, 'C', 1);
    $pdf->Cell(23, 10, 'Ct_Alcaldia', 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Periodo', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Fecha_Pago', 1, 0, 'C', 1);
    $pdf->Cell(13, 10, 'Aseo', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Alumbrado', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Desechos', 1, 0, 'C', 1);
    $pdf->Cell(22, 10, 'Pavimento', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Fiesta', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Otros', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Pendiente', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Total', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
    $con_palabra = $conn->busquedaFree("SELECT * FROM cobal where fecha_pago like '%$fecha_us%'");
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(5, 6, $co, 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['nic'], 1, 0, 'L');
            $pdf->Cell(15, 6, $datos_palabra['nis'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['unicom'], 1, 0, 'C');
            $pdf->Cell(23, 6, $datos_palabra['cuenta_alcaldia'], 1, 0, 'C');
            $pdf->Cell(15, 6, $datos_palabra['periodo'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['fecha_pago'], 1, 0, 'C');
            $pdf->Cell(13, 6, $datos_palabra['aseo'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['alumbrado'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['desechos_solidos'], 1, 0, 'L');
            $pdf->Cell(22, 6, $datos_palabra['pavimento'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['fondo_fiesta'], 1, 0, 'L');
            $pdf->Cell(20, 6, $datos_palabra['otros_conceptos'], 1, 0, 'L');
            $pdf->Cell(25, 6, $datos_palabra['cuenta_pendiente'], 1, 0, 'C');
            $pdf->Cell(25, 6, $datos_palabra['total'], 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(282, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
} elseif (isset($_POST['usuarios'])) {
    //INICIO PDF

    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('../../images/logo2.png', 5, 5, 30);
    $pdf->Cell(40);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(20);
    $pdf->Cell(120, 10, 'Reporte de Usuarios.', 0, 0, 'C');
    $pdf->Ln(30);
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(5, 10, '#', 1, 0, 'C', 1);
    $pdf->Cell(53, 10, 'Nombres', 1, 0, 'C', 1);
    $pdf->Cell(53, 10, 'Apellidos  ', 1, 0, 'C', 1);
    $pdf->Cell(49, 10, 'Correo / Usuario', 1, 0, 'C', 1);
    $pdf->Cell(25, 10, 'Tipo', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $co = 1;
    $con_palabra = $conn->busquedaFree("SELECT * FROM usuario WHERE id_usuario NOT IN(1)");
    if ($con_palabra == true) {
        foreach ($con_palabra as $datos_palabra) {
            $pdf->Cell(5, 6, $co, 1, 0, 'C');
            $pdf->Cell(53, 6, $datos_palabra['nombre_usuario'], 1, 0, 'L');
            $pdf->Cell(53, 6, $datos_palabra['apellido_usuario'], 1, 0, 'C');
            $pdf->Cell(49, 6, $datos_palabra['correo'], 1, 0, 'C');
            if ($datos_palabra['tipo'] == 1) {
                $tipo == "Invidato";
            } elseif ($datos_palabra['tipo'] == 2) {
                $tipo = "Encargado";
            } else {
                $tipo = "Administrador";
            }
            $pdf->Cell(25, 6, $tipo, 1, 1, 'C');
            $co++;
        }
    } else {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(185, 20, 'No se encontraron datos que coincidan con su solicitud.', 1, 1, 'C');
    }
    $pdf->Output();
    //FINAL PDF
}
