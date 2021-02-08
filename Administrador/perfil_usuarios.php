<?php
if(isset($_POST['id_password'])){
?>
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
    $cod_perfil = $_POST['id_password'];
    $consulta_paciente = $conn->busquedaFree("SELECT * FROM usuario where id_usuario = $cod_perfil");
    foreach ($consulta_paciente as $datos1) {
        $id_med = $datos1['id_usuario'];
        $usuario = $datos1["correo"];
        $nombre_medico = $datos1["nombre_usuario"];
        $apellido_medico = $datos1["apellido_usuario"];
        $tipo = $datos1["tipo"];
        if ($tipo == 3) {
            $tipo = "Administrador";
        } else {
            $tipo = "Invitado";
        }
    }


    ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h1>Usuario: <?php echo $nombre_medico ." " . $apellido_medico ?></h1>
            </div>
            <!-- Formulario izquierdo -->
            <!-- Formulario central -->
            <div class="col-md-7 col-lg-12">
                <form class="needs-validation" novalidate method="post" action="./mants/mant_usuarios.php">
                    <div class="row g-3">
                    <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Contraseña*</label>
                                    <div class=" input-group">
                                        <input type="password" class="form-control" id="clave1" name="clave1" placeholder="Ingrese contraseña" required>
                                        <button type='button' style='border:none;' id="mostrar1"><img src='../images/icons/formularios/contra.png' alt='x' />
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Repetir Contraseña*</label>
                                    <div class=" input-group">
                                        <input type="password" class="form-control" id="clave2" name="clave2" id="clave2" placeholder="Repetir contraseña" required>
                                        <button type='button' style='border:none;' id="mostrar2"><img src='../images/icons/formularios/contra.png' alt='x' />
                                        </button>
                                    </div>
                                    <br>
                                </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="hidden" name="id_us" value="<?php echo $id_med; ?>">
                                <input type="submit" class="form-control text-white bg-primary" id="send_update3" name="send_update3" value="Actualizar" readonly>
                            </div>
                            <div class="col-sm-6">
                                <a href="?x=./usuarios.php" class="form-control text-white bg-success" style="text-align: center;">Regresar</a>
                            </div>

                        </div>
                    </div>
            </div>
    </div>
    </main>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#clave2").change(function() {
            var contrasena = $("#clave1").val();
            var confirContrasena = $("#clave2").val();
            //console.log(contrasena+"   "+confirContrasena);
            if (contrasena != '' && confirContrasena != '') {
                if (contrasena === confirContrasena) {

                    $("#clave1").css("border-color", "green");
                    $("#clave2").css("border-color", "green");
                    $("#send_update3").css("display","block");
                    
                } else {
                    $("#clave1").css("border-color", "red");
                    $("#clave2").css("border-color", "red");
                    $("#send_update3").css("display","none");
                }
            } else {
                $("#clave1").css("border-color", "red");
                $("#clave2").css("border-color", "red");
                $("#send_update3").css("display","none");
            }
        });
        $("#clave1").change(function() {
            var contrasena = $("#clave1").val();
            var confirContrasena = $("#clave2").val();
            //console.log(contrasena+"   "+confirContrasena);
            if (contrasena != '' && confirContrasena != '') {
                if (contrasena === confirContrasena) {

                    $("#clave1").css("border-color", "green");
                    $("#clave2").css("border-color", "green");
                    $("#send_update3").css("display","block");
                } else {
                    $("#clave1").css("border-color", "red");
                    $("#clave2").css("border-color", "red");
                    $("#send_update3").css("display","none");
                }
            } else {
                $("#clave1").css("border-color", "red");
                $("#clave2").css("border-color", "red");
                $("#send_update3").css("display","none");
            }
        });
        //Mostrar claves
        $("#mostrar1").click(function() {
            if ($('#clave1').attr('type', 'password')) {
                $('#clave1').attr('type', 'text');
            }
        });

        $("#mostrar2").click(function() {
            if ($('#clave2').attr('type', 'password')) {
                $('#clave2').attr('type', 'text');
            }
        });
    </script>
</body>
<?php
}else{
    ?>
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
    $consulta_paciente = $conn->busquedaFree("SELECT * FROM usuario where id_usuario = $cod_perfil");
    foreach ($consulta_paciente as $datos1) {
        $id_med = $datos1['id_usuario'];
        $usuario = $datos1["correo"];
        $nombre_medico = $datos1["nombre_usuario"];
        $apellido_medico = $datos1["apellido_usuario"];
        $tipo = $datos1["tipo"];
        if ($tipo == 3) {
            $tipo = "Administrador";
        } elseif ($tipo == 2) {
            $tipo = "Encargado";
        } else {
            $tipo = "Invitado";
        }
    }


    ?>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h1>Usuario: <?php echo $nombre_medico ." ". $apellido_medico  ?></h1>
            </div>
            <!-- Formulario izquierdo -->
            <!-- Formulario central -->
            <div class="col-md-7 col-lg-12">
                <h4 class="mb-3">Datos Primarios</h4>
                <form class="needs-validation" novalidate method="post" action="./mants/mant_usuarios.php">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $nombre_medico; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $apellido_medico; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Correo / Usuario</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $usuario ;?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $tipo ;?>" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <input type="button" onclick="document.getElementById('id03').style.display='block'" class="form-control text-white bg-danger" value="Eliminar">
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="id_us" value="<?php echo $id_med; ?>">
                                <input type="submit" class="form-control text-white bg-primary" name="send_update" value="Actualizar" readonly>
                            </div>
                            <div class="col-sm-4">
                                <a href="?x=./usuarios.php" class="form-control text-white bg-success" style="text-align: center;">Regresar</a>
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

    <?php
}

?>