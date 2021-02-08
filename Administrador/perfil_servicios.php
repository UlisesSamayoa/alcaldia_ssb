<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil Paciente</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php
    require_once "../Clases/BD.php";
    $conn = new baseD();
    $cod_perfil = $_POST['id_perfil'];
    $consulta_paciente = $conn->busquedaFree("SELECT id_producto,nombre_producto,descripcion_producto,indicaciones_producto,
    requerimientos_producto,relevancia,servicios.nombre_servicio from producto
    inner join servicios on producto.id_servicio = servicios.id_servicios
    WHERE id_producto = $cod_perfil");
    foreach ($consulta_paciente as $datos1) {
        $id = $datos1['id_producto'];
        $nombre = $datos1["nombre_producto"];
        $descripcion_producto = $datos1['descripcion_producto'];
        $indicaciones_producto = $datos1['indicaciones_producto'];
        $requerimientos_producto = $datos1['requerimientos_producto'];
        $relevancia = $datos1['relevancia'];
        $nombre_servicio = $datos1['nombre_servicio'];
    }


    ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2><?php echo $nombre; ?></h2>
                <!--  <p class="lead"></p>-->
            </div>
            <!-- Formulario izquierdo -->
            <div class="row g-3">

                <!-- Formulario central -->
                <div class="col-md-10 col-lg-12">

                    <form class="needs-validation" novalidate method="post" action="./mants/mant_servicios.php">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Nombre estudio</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $nombre; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Categoría</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $nombre_servicio; ?>" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Relevancia</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $relevancia; ?>" readonly>
                            </div>

                            <div class="col-sm-12">
                                <label for="lastName" class="form-label">Descripción</label>
                                <textarea class="form-control" id="firstName" name="testimonio" readonly cols="120" rows="3">  <?php echo $descripcion_producto; ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Indicaciones</label>
                                <textarea class="form-control" id="firstName" name="testimonio" readonly cols="120" rows="4">  <?php echo $indicaciones_producto; ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Requerimientos</label>
                                <textarea class="form-control" id="firstName" name="testimonio" readonly cols="120" rows="4">  <?php echo $requerimientos_producto; ?></textarea>
                            </div>


                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="row g-3">
                                <div class="col-sm-4">

                                    <input type="submit" class="form-control text-white bg-danger" name="send_dl" value="Eliminar" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <input type="hidden" name="id_us" value="<?php echo $id; ?>">
                                    <input type="submit" class="form-control text-white bg-primary" name="send_update" value="Actualizar" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <a href="?x=./servicios.php" class="form-control text-white bg-success" style="text-align: center;">Regresar</a>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="form-validation.js"></script>

</body>

</html>