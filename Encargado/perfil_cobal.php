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
    $nic_perfil = $_POST['nic_perfil'];
    $consulta_nic = $conn->busquedaFree("SELECT * FROM cliente INNER JOIN cobal ON cobal.id_cliente = cliente.id_cliente
    WHERE cobal.nic =  '$nic_perfil'");
    foreach ($consulta_nic as $datos_nic) {
        $nombres = $datos_nic['nombres'];
    }
    $consulta_paciente = $conn->busquedaFree("SELECT * FROM cobal where id_cobal = $cod_perfil");
    foreach ($consulta_paciente as $datos1) {
        $id = $datos1['id_cobal'];
        $nic = $datos1["nic"];
        $unicom = $datos1['unicom'];
        $cuenta_alcaldia = $datos1['cuenta_alcaldia'];
        $aseo = $datos1['aseo'];
        $alumbrado = $datos1['alumbrado'];
        $desechos_solidos = $datos1['desechos_solidos'];
        $otros_conceptos = $datos1['otros_conceptos'];
        $cuenta_pendiente = $datos1['cuenta_pendiente'];
        $pavimento = $datos1['pavimento'];
        $fondo_fiesta = $datos1['fondo_fiesta'];
        $periodo = $datos1['periodo'];
        $fecha_pago = $datos1['fecha_pago'];
        $nic = $datos1['nic'];
        $nis = $datos1['nis'];
        $total = $datos1['total'];
    }


    ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h3> <?php echo $nombres; ?></h3>
            </div>
            <div class="col-md-7 col-lg-12">
                <form class="needs-validation" novalidate method="post" action="./mants/mant_cobal.php">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">NIC</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $nic; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $nis; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">UNICOM</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $unicom; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Cuenta Alcaldía</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $cuenta_alcaldia; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Periodo</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $periodo; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Fecha de pago</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $fecha_pago; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Alumbrado</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $alumbrado; ?>" readonly>
                        </div>
                       <div class="col-sm-6">
                            <label for="lastName" class="form-label">Aseo</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $aseo; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Desechos Solidos</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $desechos_solidos; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Pavimento</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $pavimento; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Fondo Fiesta</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $fondo_fiesta; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Otros conceptos</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $otros_conceptos; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Cuenta pendiente</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $cuenta_pendiente ?>" readonly>
                        </div>
                       <div class="col-sm-6">
                            <label for="lastName" class="form-label">Total</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $total; ?>" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="row g-3">
                           
                            <div class="col-sm-6">
                                <input type="hidden" name="id_us" value="<?php echo $id; ?>">
                                <input type="submit" class="form-control text-white bg-primary" name="send_update" value="Actualizar" readonly>
                            </div>
                            <div class="col-sm-6">
                                <a href="?x=./cobal.php" class="form-control text-white bg-success" style="text-align: center;">Regresar</a>
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
            <form class="w3-container" method="post" action="./mants/mant_cobal.php">
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