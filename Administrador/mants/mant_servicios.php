<?php
require_once "../../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.
if (isset($_POST['send_insert'])) {
    $nombre = $_POST['nombre'];
    $relevancia = $_POST['relevancia'];
    $servicio = $_POST['servicio'];
    $descripcion = $_POST['descripcion'];
    $indicaciones = $_POST['indicaciones'];
    $requerimientos = $_POST['requerimientos'];
    $usuario = $_COOKIE['cod'];
    $conn->insertar(
        "producto( nombre_producto, descripcion_producto, indicaciones_producto, requerimientos_producto, relevancia, id_servicio,id_usuario)",
        "'$nombre','$descripcion','$indicaciones','$requerimientos','$relevancia','$servicio','$usuario'"
    );
    echo '<script>alert("Registro INGRESADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=servicios.php')</script>";
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
            <form class="w3-container" method="post" action="mant_servicios.php">
                <div class="w3-section">
                    <div style="text-align: center;">
                        <input type='hidden' name='id_us2' value="<?php echo $_POST['id_us']; ?>">
                        <a href="../index.php?x=servicios.php" class="w3-button w3-red w3-section w3-padding" style="text-align: center;">NO</a>
                        <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="SI" name="si_dl">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php


} elseif (isset($_POST['si_dl'])) {
    $id_del = $_POST['id_us2'];
    $conn->borrar("producto", "id_producto = $id_del");
    echo '<script>alert("Registro ELIMINADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=servicios.php')</script>";
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
                <form class="w3-container" enctype="multipart/form-data" method="post" action="mant_servicios.php">
                    <?php

                    $id_update = $_POST['id_us'];
                    //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
                    $busqueda = $conn->busquedaFree("SELECT id_producto,nombre_producto,descripcion_producto,indicaciones_producto,
                    requerimientos_producto,relevancia,id_servicio from producto
                    WHERE id_producto  = $id_update");
                    foreach ($busqueda as $datos1) {
                        $id = $datos1['id_producto'];
                        $nombre = $datos1["nombre_producto"];
                        $descripcion_producto = $datos1['descripcion_producto'];
                        $indicaciones_producto = $datos1['indicaciones_producto'];
                        $requerimientos_producto = $datos1['requerimientos_producto'];
                        $relevancia = $datos1['relevancia'];
                        $id_servicio = $datos1['id_servicio'];
                      
                    }
                    ?>
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h1><?php echo $nombre ?></h1>
                            </div>
                            <!-- Formulario izquierdo -->
                            <div class="row g-3">

                                <!-- Formulario central -->
                                <div class="col-md-6 col-lg-12">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
                                            <label for="firstName" class="form-label">Nombre Estudio*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $nombre; ?>" name="nombre" required>
                                        </div>
                                        <div class="col-sm-6">

                                            <label for="firstName" class="form-label">Relevancia*</label>
                                            <input type="number" name="relevancia" min="1" max="5" class="form-control" id="firstName" value="<?php echo $relevancia; ?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="lastName" class="form-label">Descripción</label>
                                            <textarea class="form-control" id="firstName" name="descripcion" required cols="120" rows="3">  <?php echo $descripcion_producto; ?></textarea>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="lastName" class="form-label">Servicio</label>
                                            <select name="servicio" id="" class="form-control" id="firstName">
                                                <?php
                                                require_once "../../Clases/BD.php";
                                                $conn = new baseD();
                                                $consulta = $conn->busqueda("servicios");

                                                foreach ($consulta as $datos) {
                                                    $id_ser = $datos['id_servicios'];
                                                    $nombre_ser = $datos['nombre_servicio'];


                                                    if ($id_ser == $id_servicio) {
                                                ?>
                                                        <option value="<?php echo $id_ser; ?>" selected><?php echo $nombre_ser; ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $id_ser; ?>"><?php echo $nombre_ser; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="firstName" class="form-label">Indicaciones</label>
                                            <textarea class="form-control" id="firstName" name="indicaciones" required cols="120" rows="4">  <?php echo $indicaciones_producto; ?></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="firstName" class="form-label">Requerimientos</label>
                                            <textarea class="form-control" id="firstName" name="requerimientos" required cols="120" rows="4">  <?php echo $requerimientos_producto; ?></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <input type="submit" class="form-control text-white bg-primary" name="send_update2" value="Actualizar">
                                    </div>
                                    <br>
                </form>
            </div>
        </div>
        </main>
    </div>
    <form class="w3-container" method="post" action="../index.php?x=perfil_servicios.php">
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <input type="hidden" name="id_perfil" Value="<?php echo $id; ?>">
            <input type="submit" class="w3-button  w3-red w3-section w3-padding" value="Cancelar">
        </div>
    </form>
<?php

} elseif (isset($_POST['send_update2'])) {
    $id_update = $_POST['id_update'];
    $nombre = $_POST['nombre'];
    $relevancia = $_POST['relevancia'];
    $servicio = $_POST['servicio'];
    $descripcion = $_POST['descripcion'];
    $indicaciones = $_POST['indicaciones'];
    $requerimientos = $_POST['requerimientos'];
    $usuario = $_COOKIE['cod'];
    $consulta = $conn->actualizar("producto", "nombre_producto='$nombre',descripcion_producto='$descripcion',indicaciones_producto='$indicaciones',requerimientos_producto='$requerimientos',relevancia='$relevancia',id_servicio='$servicio',id_usuario='$usuario'", "id_producto=$id_update");
    echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=servicios.php')</script>";
}

?>