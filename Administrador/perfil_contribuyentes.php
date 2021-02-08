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
    $consulta_paciente = $conn->busquedaFree("SELECT * FROM cliente where id_cliente = $cod_perfil");
    foreach ($consulta_paciente as $datos1) {
        $id = $datos1['id_cliente'];
                        $id = $datos1["id_cliente"];
                        $nombre = $datos1["nombres"];
                        $nis = $datos1['nis'];
                        $municipio = $datos1['municipio'];
                        $direccion = $datos1['direccion'];
                        $unicom = $datos1['unicom'];
                        $nic = $datos1['nic'];
                        $medidor = $datos1['medidor'];
    }


    ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h1> <?php echo $nombre; ?></h1>
            </div>
            <!-- Formulario izquierdo -->
            <!-- Formulario central -->
            <div class="col-md-7 col-lg-12">
                <form class="needs-validation" novalidate method="post" action="./mants/mant_contribuyentes.php">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $nombre; ?>" readonly>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">NIC</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $nic ;?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Medidor</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $medidor ;?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $nis; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">UNICOM</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $unicom ;?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $municipio ;?>" readonly>
                        </div>
                        <div class="col-sm-12">
                            <label for="lastName" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $direccion ;?>" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <input type="button" onclick="document.getElementById('id03').style.display='block'" class="form-control text-white bg-danger" value="Eliminar">
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="id_us" value="<?php echo $id; ?>">
                                <input type="submit" class="form-control text-white bg-primary" name="send_update" value="Actualizar" readonly>
                            </div>
                            <div class="col-sm-4">
                                <a href="?x=./contribuyentes.php" class="form-control text-white bg-success" style="text-align: center;">Regresar</a>
                            </div>

                        </div>
                    </div>
            </div>
    </div>
    </main>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="form-validation.js"></script>
    <div id="id03" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px;">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <p>¿Esta seguro de eliminar este registro?</p>
            </div>
            <form class="w3-container" method="post" action="./mants/mant_usuarios.php">
                <div class="w3-section">
                    <div style="text-align: center;">
                        <input type="button" onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-red w3-section w3-padding" value="No">
                        <input type="submit" class="w3-button  w3-blue w3-section w3-padding" value="Si" name="send_dl">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

   