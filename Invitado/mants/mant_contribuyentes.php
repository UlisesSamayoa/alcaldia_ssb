<?php
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once "../../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.
if (isset($_POST['send_insert'])) {
    $nombre = $_POST['nombre'];
    $nis = $_POST['nis'];
    $nic = $_POST['nic'];
    $medidor = $_POST['medidor'];
    $municipio = $_POST['municipio'];
    $unicom = $_POST['unicom'];
    $direccion = $_POST['direccion'];

    $conn->insertar(
        "cliente( nombres, nic, nis,medidor,unicom,municipio,direccion)",
        "'$nombre','$nic','$nis','$medidor','$unicom','$municipio','$direccion'"
    );
    echo '<script>alert("Registro INGRESADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=contribuyentes.php')</script>";
} elseif (isset($_POST['send_insert2'])) {
?>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    echo "<style> body{background:#000 !important;} </style>";
    $archivo = $_FILES['archivo']['name'];
    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        if ($tipo == "vnd.ms-excel" | $tipo == "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            echo ' <div style="text-align: center !important; color:#fff;">
            <br>
            <h3 style="color: #fff;">El archivo ingresado no puede ser procesado...</h3>
            <h5 style="color: #fff;">Por favor verifique si es un archivo EXCEL...</h5>
        <div style="text-align: left !important; margin-left:45%;">';
            echo "<br><a href='../index.php?x=contribuyentes.php' class='btn bg-primary text-white'>Regresar</a> <br><br></div> </div>";
        } else {
            if (move_uploaded_file($temp, '../excel_clientes/' . $archivo)) {
                chmod('../excel_clientes/' . $archivo, 0777);
                $rutaArchivo = '../excel_clientes/' . $archivo;
                $documento = IOFactory::load($rutaArchivo);
                $hojaDeProductos = $documento->getSheet(0);
                $numeroMayorDeFila = $hojaDeProductos->getHighestRow(); // Numérico
                $letraMayorDeColumna = $hojaDeProductos->getHighestColumn(); // Letra
                $numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna);
                $con = 1;
                $ingresado = 2;
                $existentes[] = "";
                $con_ex = 1;
                $con_final = 1;
                $nic2 = null;
                $periododb = "";
                for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {
                    $medidor_excel = $hojaDeProductos->getCellByColumnAndRow(1, $indiceFila);
                    $nic_excel = $hojaDeProductos->getCellByColumnAndRow(2, $indiceFila);
                    $nis_excel = $hojaDeProductos->getCellByColumnAndRow(3, $indiceFila);
                    $nombre_excel = $hojaDeProductos->getCellByColumnAndRow(4, $indiceFila);
                    $direccion_excel = $hojaDeProductos->getCellByColumnAndRow(5, $indiceFila);
                    $municipio_excel = $hojaDeProductos->getCellByColumnAndRow(6, $indiceFila);
                    $unicom_excel = $hojaDeProductos->getCellByColumnAndRow(7, $indiceFila);
                    $consulta_nic = $conn->busquedaFree("SELECT nic FROM cliente where nic = '$nic_excel'");
                    $todos[$indiceFila - 1] = $nic_excel;
                    foreach ($consulta_nic as $datos_nic) {
                        $nic2 = $datos_nic['nic'];
                    }
                    if ($nic2 == $nic_excel) {
                            
                    }else{
                        if($con_final <1001){
                            $conn->insertar(
                                "cliente(medidor,nic,nis,nombres,direccion,municipio,unicom)",
                                "'$medidor_excel','$nic_excel','$nis_excel','$nombre_excel','$direccion_excel','$municipio_excel','$unicom_excel'");
                        }
                        
                        $ingresado = 1;
                        $con_final++;
                    }
                   
                }
                if ($ingresado == 1) {
                    echo '<script>alert("Registro INGRESADO con exito");</script>';
                    echo " <script>window.location.replace('../index.php?x=contribuyentes.php')</script>";
                }else{
                    echo '<script>alert("No se encontraron nuevos CONTRIBUYENTES");</script>';
                    echo " <script>window.location.replace('../index.php?x=contribuyentes.php')</script>";
                }
            } else {
            }
        }
    }
} elseif (isset($_POST['send_dl'])) {
    ?>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/shadowbox/shadowbox.css">
    <script type="text/javascript" src="../css/shadowbox/shadowbox.js"></script>
    <div id="id03" class="w3-modal" style="display: block;">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px;">
            <div class="w3-center"><br>

                <p>¿Esta seguro de eliminar este registro?</p>
            </div>
            <form class="w3-container" method="post" action="mant_contribuyentes.php">
                <div class="w3-section">
                    <div style="text-align: center;">
                        <input type='hidden' name='id_us2' value="<?php echo $_POST['id_us']; ?>">
                        <a href="../index.php?x=contribuyentes.php" class="w3-button w3-red w3-section w3-padding" style="text-align: center;">NO</a>
                        <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="SI" name="si_dl">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php


} elseif (isset($_POST['si_dl'])) {
    $id_del = $_POST['id_us2'];
    $conn->borrar("cliente", "id_cliente = $id_del");
    echo '<script>alert("Registro ELIMINADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=contribuyentes.php')</script>";
} elseif (isset($_POST['send_update'])) {
?>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    </head>
    <!-- Fin de los estilos del Modal -->
    <!-- Activar el MODAL al CARGAR el sitio completo -->
    <style>
        #id01 {
            display: block;
        }
    </style>
    <!-- Inicio de Modal de Actualizar -->
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:1000px">
                <form class="w3-container" enctype="multipart/form-data" method="post" action="mant_contribuyentes.php">
                    <?php

                    $id_update = $_POST['id_us'];
                    //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
                    $busqueda = $conn->busquedaFree("SELECT * from cliente
                    where id_cliente = $id_update");
                    foreach ($busqueda as $datos1) {
                        $id = $datos1['id_cliente'];
                        $nombre = $datos1["nombres"];
                        $direccion = $datos1['direccion'];
                        $nic = $datos1['nic'];
                        $nis = $datos1['nis'];
                        $medidor = $datos1['medidor'];
                        $municipio = $datos1['municipio'];
                        $unicom = $datos1['unicom'];
                    }
                    ?>
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                            <b><?php echo $nombre; ?></b>
                            </div>
                            <!-- Formulario izquierdo -->
                            <div class="row g-3">

                                <!-- Formulario central -->
                                <div class="col-md-6 col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
                                            <label for="firstName" class="form-label">Nombres*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $nombre; ?>" name="nombre" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">NIC*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $nic; ?>" name="nic" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Medidor*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $medidor; ?>" name="medidor" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">NIS*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $nis; ?>" name="nis" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Unicom*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $unicom; ?>" name="unicom" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Municipio*</label>
                                            <input type="text" class="form-control" id="firstName" value="S SEBASTIAN SALITRILLO" readonly name="municipio" required>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="firstName" class="form-label">Dirección*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $direccion; ?>" name="direccion" required>
                                        </div>

                                        <div class="col-sm-12">
                                            <br>
                                            <input type="submit" class="form-control text-white bg-primary" name="send_update2" value="Actualizar">
                                        </div>
                                        <br>
                </form>
            </div>
        </div>
        </main>
    </div>
    <form class="w3-container" method="post" action="../index.php?x=perfil_contribuyentes.php">
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <input type="hidden" name="id_perfil" Value="<?php echo $id; ?>">
            <input type="submit" class="w3-button  w3-red w3-section w3-padding" value="Cancelar">
        </div>
    </form>
<?php

} elseif (isset($_POST['send_update2'])) {
    $id_update = $_POST['id_update'];
    $nombre = $_POST['nombre'];
    $nis = $_POST['nis'];
    $nic = $_POST['nic'];
    $medidor = $_POST['medidor'];
    $municipio = $_POST['municipio'];
    $unicom = $_POST['unicom'];
    $direccion = $_POST['direccion'];

    $consulta = $conn->actualizar("cliente", "nombres='$nombre',nic='$nic',medidor='$medidor',nis='$nis',municipio='$municipio',direccion='$direccion',unicom='$unicom'", "id_cliente=$id_update");
    echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=contribuyentes.php')</script>";
}

?>