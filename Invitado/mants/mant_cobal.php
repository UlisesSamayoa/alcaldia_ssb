<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../css/style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/shadowbox/shadowbox.css">
<script type="text/javascript" src="../css/shadowbox/shadowbox.js"></script>
<style>
    body {
        background: #000;
    }
</style>
<?php
require_once "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once "../../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.
if (isset($_POST['send_insert'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if ($tipo == "vnd.ms-excel" | $tipo == "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            echo ' <div style="text-align: center !important; color:#fff;">
            <br>
            <h3 style="color: #fff;">El archivo ingresado no puede ser procesado...</h3>
            <h5 style="color: #fff;">Por favor verifique si es un archivo EXCEL...</h5>
        <div style="text-align: left !important; margin-left:45%;">';
            echo "<br><a href='../index.php?x=contribuyentes.php' class='btn bg-primary text-white'>Regresar</a> <br><br></div> </div>";
        } else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, '../excel_cobal/' . $archivo)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('../excel_cobal/' . $archivo, 0777);
                //Mostramos el mensaje de que se ha subido co éxito


                $rutaArchivo = '../excel_cobal/' . $archivo;
                $documento = IOFactory::load($rutaArchivo);
                # Calcular el máximo valor de la fila como entero, es decir, el
                # límite de nuestro ciclo
                $hojaDeProductos = $documento->getSheet(0);
                $numeroMayorDeFila = $hojaDeProductos->getHighestRow(); // Numérico
                $letraMayorDeColumna = $hojaDeProductos->getHighestColumn(); // Letra
                # Convertir la letra al número de columna correspondiente
                $numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna);

?>
                <?php
                // Recorrer filas; comenzar en la fila 2 porque omitimos el encabezado
                $con = 1;
                $ingresado = 2;
                ?>
                <div style="text-align: center !important; color:#fff;">
                    <br>
                    <h3 style="color: #fff;">Los siguentes NIC, NO EXISTEN en la base de datos...</h3>
                    <h5 style="color: #fff;">Por favor ingresar al sistema(En caso de no mostrar NIC, solo de clic en Regresar)...</h5>
                    <div style="text-align: left !important; margin-left:45%;">

            <?php
                $existentes[] = "";
                $con_ex = 1;
                $con_final = 1;
                $periododb = "";
                $usu = $_COOKIE['cod'];
                for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {

                    $nic = $hojaDeProductos->getCellByColumnAndRow(1, $indiceFila);
                    $unicom = $hojaDeProductos->getCellByColumnAndRow(2, $indiceFila);
                    $cta_alcal = $hojaDeProductos->getCellByColumnAndRow(3, $indiceFila);
                    $fecha_pago = $hojaDeProductos->getCellByColumnAndRow(4, $indiceFila);
                    $aseo = $hojaDeProductos->getCellByColumnAndRow(5, $indiceFila);
                    $alumbrado = $hojaDeProductos->getCellByColumnAndRow(6, $indiceFila);
                    $desechos_soli = $hojaDeProductos->getCellByColumnAndRow(7, $indiceFila);
                    $otros = $hojaDeProductos->getCellByColumnAndRow(8, $indiceFila);
                    $financiera = $hojaDeProductos->getCellByColumnAndRow(9, $indiceFila);
                    $pavimento = $hojaDeProductos->getCellByColumnAndRow(10, $indiceFila);
                    $fondo_fiesta = $hojaDeProductos->getCellByColumnAndRow(11, $indiceFila);
                    $lugar_cobro = $hojaDeProductos->getCellByColumnAndRow(12, $indiceFila);
                    $periodo = $hojaDeProductos->getCellByColumnAndRow(13, $indiceFila);
                    $total = $hojaDeProductos->getCellByColumnAndRow(14, $indiceFila);
                    $nis = $hojaDeProductos->getCellByColumnAndRow(15, $indiceFila);

                    $consulta_nic = $conn->busquedaFree("SELECT cliente.id_cliente,nic FROM cliente WHERE cliente.nic = '$nic'");
                    $todos[$indiceFila - 1] = $nic;

                    foreach ($consulta_nic as $datos_nic) {
                        $id_client = $datos_nic['id_cliente'];
                        $nic2 = $datos_nic['nic'];
                        $existentes[$indiceFila - 1] = $nic2;
                        $con_ex = ($indiceFila - 1);

                        $consulta_periodo = $conn->busquedaFree("SELECT cobal.periodo FROM cliente INNER JOIN cobal ON cliente.id_cliente = cobal.id_cliente 
                    WHERE cobal.nic = '$nic' and cobal.periodo = '$periodo' ");
                        foreach ($consulta_periodo as $datos_pe) {
                            $periododb = $datos_pe['periodo'];
                        }
                        if ($periododb != $periodo | $periododb == "") {
                            if ($nic2 != "") {
                                $conn->insertar(
                                    "cobal(unicom,cuenta_alcaldia,aseo,alumbrado,desechos_solidos,otros_conceptos,cuenta_pendiente,pavimento,
                                    fondo_fiesta,periodo,fecha_pago,nic,nis,total,id_cliente,id_usuario)",
                                    "'$unicom','$cta_alcal','$aseo','$alumbrado','$desechos_soli','$otros','$financiera','$pavimento',
                                    '$fondo_fiesta','$periodo','$fecha_pago','$nic','$nis','$total','$id_client','$usu'"
                                );
                                $ingresado = 1;
                            } else {
                            }
                        }
                    }
                    if ($existentes[] = "") {
                    } else {
                        if ($existentes[$con_ex] == $todos[$indiceFila - 1]) {
                        } else {
                            $no_existen[$indiceFila - 1] = $todos[$indiceFila - 1];
                            echo "Columna #" . $con_final . " =  " .  $no_existen[$indiceFila - 1] . "<br>";
                        }
                    }

                    $con++;
                    $con_final++;
                }
                echo "<br><a href='../index.php?x=cobal.php' class='btn bg-primary text-white'>Regresar</a> <br><br></div> </div>";
                //FIN DEL FOR 
                if ($ingresado == 1) {
                    echo '<script>alert("Registro INGRESADO con exito");</script>';
                }
            } else {
            }
        }
    }
} elseif (isset($_POST['send_dl'])) {
            ?>

            <div id="id03" class="w3-modal" style="display: block;">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px;">
                    <div class="w3-center"><br>

                        <p>¿Esta seguro de eliminar este registro?</p>
                    </div>
                    <form class="w3-container" method="post" action="mant_cobal.php">
                        <div class="w3-section">
                            <div style="text-align: center;">
                                <input type='hidden' name='id_us2' value="<?php echo $_POST['id_us']; ?>">
                                <a href="../index.php?x=cobal.php" class="w3-button w3-red w3-section w3-padding" style="text-align: center;">NO</a>
                                <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="SI" name="si_dl">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php


    } elseif (isset($_POST['si_dl'])) {
        $id_del = $_POST['id_us2'];
        $conn->borrar("cobal", "id_cobal = $id_del");
        echo '<script>alert("Registro ELIMINADO con exito");</script>';
        echo " <script>window.location.replace('../index.php?x=cobal.php')</script>";
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
                        <form class="w3-container" enctype="multipart/form-data" method="post" action="mant_cobal.php">
                            <?php

                            $id_update = $_POST['id_us'];
                            //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
                            $busqueda = $conn->busquedaFree("SELECT * from cobal
                    where id_cobal = $id_update");
                            foreach ($busqueda as $datos1) {
                                $id =  $datos1['id_cobal'];
                                $nic =  $datos1['nic'];
                                $nis = $datos1['nis'];
                                $unicom =  $datos1['unicom'];
                                $alcaldia =  $datos1['cuenta_alcaldia'];
                                $periodo = $datos1['periodo'];
                                $fecha_pago = $datos1['fecha_pago'];
                                $aseo =  $datos1['aseo'];
                                $alumbrado = $datos1['alumbrado'];
                                $solidos = $datos1['desechos_solidos'];
                                $pavimento = $datos1['pavimento'];
                                $fiesta = $datos1['fondo_fiesta'];
                                $otros = $datos1['otros_conceptos'];
                                $pendiente =  $datos1['cuenta_pendiente'];
                                $total =  $datos1['total'];
                            }
                            ?>
                            <div class="container">
                                <main>
                                    <div class="py-5 text-center">
                                    </div>
                                    <!-- Formulario izquierdo -->
                                    <div class="row g-3">

                                        <!-- Formulario central -->
                                        <div class="col-md-6 col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
                                                    <label for="firstName" class="form-label">NIC*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $nic; ?>" name="nic" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">NIS*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $nis; ?>" name="nis" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">UNICOM*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $unicom; ?>" name="unicom" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Cuenta alcaldia*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $alcaldia; ?>" name="alcaldia" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Periodo*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $periodo; ?>" name="periodo" required>   
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Fecha Pago*</label>
                                                    <input type="date" class="form-control" id="firstName" Value="<?php echo $fecha_pago; ?>" name="fecha" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Alumbrado*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $alumbrado; ?>" name="alumbrado" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Aseo*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $aseo; ?>" name="aseo" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Desechos solidos*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $solidos; ?>" name="solidos" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Pavimento*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $pavimento; ?>" name="pavimento" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Fondo fiesta*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $fiesta; ?>" name="fiesta" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Otros conceptos*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $otros; ?>" name="otros" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Cuenta pendiente*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $pendiente; ?>" name="pendiente" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="firstName" class="form-label">Total*</label>
                                                    <input type="text" class="form-control" id="firstName" Value="<?php echo $total; ?>" name="total" required>
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
            <form class="w3-container" method="post" action="../index.php?x=perfil_usuarios.php">
                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <input type="hidden" name="id_perfil" Value="<?php echo $id; ?>">
                    <input type="submit" class="w3-button  w3-red w3-section w3-padding" value="Cancelar">
                </div>
            </form>
        <?php

    } elseif (isset($_POST['send_update2'])) {
        $id_update = $_POST['id_update'];
        $nic2 =  $_POST['nic'];
        $nis2 = $_POST['nis'];
        $unicom2 =  $_POST['unicom'];
        $alcaldia2 =  $_POST['alcaldia'];
        $periodo2 = $_POST['periodo'];
        $fecha_pago2 = $_POST['fecha'];
        $aseo2 =  $_POST['aseo'];
        $alumbrado2 = $_POST['alumbrado'];
        $solidos2 = $_POST['solidos'];
        $pavimento2 = $_POST['pavimento'];
        $fiesta2 = $_POST['fiesta'];
        $otros2 = $_POST['otros'];
        $pendiente2 =  $_POST['pendiente'];
        $total2 =  $_POST['total'];
        $consulta = $conn->actualizar("cobal", "nic='$nic2',nis='$nis2',unicom='$unicom2',cuenta_alcaldia='$alcaldia2',periodo='$periodo2',fecha_pago='$fecha_pago2'
        ,aseo='$aseo2',alumbrado='$alumbrado2',desechos_solidos='$solidos2',pavimento='$pavimento2',fondo_fiesta='$fiesta2',otros_conceptos='$otros2',cuenta_pendiente='$pendiente2',total='$total2'", "id_cobal=$id_update");
        echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
        echo " <script>window.location.replace('../index.php?x=cobal.php')</script>";
    }

        ?>