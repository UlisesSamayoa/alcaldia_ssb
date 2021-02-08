<?php
require_once "../../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.
if (isset($_POST['send_insert'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $clave  = $_POST['clave1'];
    $tipo2 = $_POST['tipo'];

        $conn->insertar(
            "usuario( nombre_usuario, apellido_usuario, correo,clave,tipo)",
            "'$nombre','$apellido','$correo','$clave','$tipo2'"
        );
        echo '<script>alert("Registro INGRESADO con exito");</script>';
        echo " <script>window.location.replace('../index.php?x=usuarios.php')</script>";
   
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
            <form class="w3-container" method="post" action="mant_usuarios.php">
                <div class="w3-section">
                    <div style="text-align: center;">
                        <input type='hidden' name='id_us2' value="<?php echo $_POST['id_us']; ?>">
                        <a href="../index.php?x=usuarios.php" class="w3-button w3-red w3-section w3-padding" style="text-align: center;">NO</a>
                        <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="SI" name="si_dl">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php


} elseif (isset($_POST['si_dl'])) {
    $id_del = $_POST['id_us2'];
    $conn->borrar("usuario ", "id_usuario = $id_del");
    echo '<script>alert("Registro ELIMINADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=usuarios.php')</script>";
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
                <form class="w3-container" enctype="multipart/form-data" method="post" action="mant_usuarios.php">
                    <?php

                    $id_update = $_POST['id_us'];
                    //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
                    $busqueda = $conn->busquedaFree("SELECT * from usuario
                    where id_usuario = $id_update");
                    foreach ($busqueda as $datos1) {
                        $id = $datos1['id_usuario'];
                        $nombre_usuario = $datos1["nombre_usuario"];
                        $apellido_usuario = $datos1['apellido_usuario'];
                        $correo_usuario = $datos1['correo'];
                        $tipo = $datos1['tipo'];
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
                                            <label for="firstName" class="form-label">Nombre*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $nombre_usuario; ?>" name="nombre" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Apellido*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $apellido_usuario; ?>" name="apellido" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Correo / Usuario*</label>
                                            <input type="text" class="form-control" id="firstName" Value="<?php echo $correo_usuario; ?>" name="correo" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Tipo</label>
                                            <select name="tipo" class="form-control" id="firstName">
                                                <?php
                                                if ($tipo == 1) {
                                                ?>
                                                    <option value="3">Administrador</option>
                                                    <option value="2">Encargado</option>
                                                    <option value="1" selected>Invitado</option>
                                                <?php
                                                } elseif ($tipo == 2) {
                                                ?>
                                                    <option value="3">Administrador</option>
                                                    <option value="2" selected>Encargado</option>
                                                    <option value="1">Invitado</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="3" selected>Administrador</option>
                                                    <option value="2">Encargado</option>
                                                    <option value="1" >Invitado</option>
                                                <?php
                                                }
                                                ?>

                                            </select>
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
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $tipo2 = $_POST['tipo'];
    $consulta = $conn->actualizar("usuario", "nombre_usuario='$nombre',apellido_usuario='$apellido',correo='$correo',tipo='$tipo2'", "id_usuario=$id_update");
    echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=usuarios.php')</script>";
}elseif (isset($_POST['send_update3'])) {
    $id_update = $_POST['id_us'];
    $clave1 = $_POST['clave1'];
    $consulta = $conn->actualizar("usuario", "clave='$clave1'", "id_usuario=$id_update");
    echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
    echo " <script>window.location.replace('../index.php?x=usuarios.php')</script>";
}

?>
