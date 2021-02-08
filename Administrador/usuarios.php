<!DOCTYPE html>
<html>

<head>
    <title>Participante</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div style=" text-align:center;">
        <h3>USUARIOS</h3>
    </div>
    <div style="margin-bottom: 5px; float: left; margin-left:30px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
    </div>
    <!--  <a target="blank" href="../pdf/alumnospdf.php" class="btn btn-danger">Reportes</a>-->
    <div style="float: right; margin-right:40px;">
        <form action="" method="post">
            <?php
            if (isset($_POST['send_busqueda'])) {
                echo '<a href="index.php?x=usuarios.php" class="btn btn-danger" style="color:white;">Limpiar</a>';
            }
            ?>
            <input type="text" style="border-radius: 5px;" name="busqueda" required>
            <input type="submit" value="Buscar" class="btn btn-info" name="send_busqueda"></input>
        </form>
    </div>

    <!-- Inicio Modal -->

    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:900px">
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_usuarios.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR USUARIOS</h4>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Nombres*</label>
                                    <input type="text" class="form-control" id="firstName" name="nombre" placeholder="Ingrese los nombres" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Apellidos*</label>
                                    <input type="text" class="form-control" id="firstName" name="apellido" placeholder="Ingrese los apellidos" required>
                                </div>
                               
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Correo / Usuario(Para inicio de sesión)*</label>
                                    <input type="text" class="form-control" id="firstName" name="correo" placeholder="Ingrese el correo" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">Tipo</label>
                                    <select name="tipo" class="form-control" id="firstName">
                                        <option value="3">Administrador</option>
                                        <option value="2">Encargado</option>
                                        <option value="1" selected>Invitado</option>
                                    </select>
                                
                                </div>
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
                                

                                <div class="input-group">
                                    <input type="submit" class="form-control text-white bg-success" id="send_insert" name="send_insert" value="Registrar" readonly>
                                </div>
                                <br><br>
                </form>
            </div>
        </div>
        </main>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        </div>
    </div>
    </div>
    <script>
        $("#clave2").change(function() {
            var contrasena = $("#clave1").val();
            var confirContrasena = $("#clave2").val();
            //console.log(contrasena+"   "+confirContrasena);
            if (contrasena != '' && confirContrasena != '') {
                if (contrasena === confirContrasena) {

                    $("#clave1").css("border-color", "green");
                    $("#clave2").css("border-color", "green");
                    $("#send_insert").css("display","block");
                    
                } else {
                    $("#clave1").css("border-color", "red");
                    $("#clave2").css("border-color", "red");
                    $("#send_insert").css("display","none");
                }
            } else {
                $("#clave1").css("border-color", "red");
                $("#clave2").css("border-color", "red");
                $("#send_insert").css("display","none");
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
                    $("#send_insert").css("display","block");
                } else {
                    $("#clave1").css("border-color", "red");
                    $("#clave2").css("border-color", "red");
                    $("#send_insert").css("display","none");
                }
            } else {
                $("#clave1").css("border-color", "red");
                $("#clave2").css("border-color", "red");
                $("#send_insert").css("display","none");
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
    <div>

        <table class="table">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th scope="col">Nombre </th>
                    <th scope="col">Correo </th>
                    <th scope="col">Tipo </th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_POST['send_busqueda'])) {
                    $valor = $_POST['busqueda'];
                    $pacientes = $conn->busquedaFree("SELECT * from usuario
                    where id_usuario not in(1) or nombre_usuario like '%$valor%' or apellido_usuario like '%$valor%' or correo like '%$valor%'");

                    foreach ($pacientes as $datos1) {
                        $id = $datos1['id_usuario'];
                        $nombre_usuario = $datos1["nombre_usuario"];
                        $apellido_usuario = $datos1['apellido_usuario'];
                        $correo_usuario = $datos1['correo'];
                        $tipo = $datos1['tipo'];
                        if ($tipo == 3) {
                            $tipo = "Administrador";
                        } else {
                            $tipo = "Invitado";
                        }

                        echo " <tr>
                        <td>$nombre_usuario $apellido_usuario</td>
                        <td>$correo_usuario</td>
                        <td>$tipo</td>
                        <td style='width:180px;'><div class='input-group'>
                   <form action='?x=perfil_usuarios.php' method='post' >
                   <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                  </form>
                  
                   <form action='mants/mant_usuarios.php' method='post'> 
                   <input type='hidden' name='id_us'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                   </button></form>
                   <form action='mants/mant_usuarios.php' method='post'> 
                  <input type='hidden' name='id_us'  Value='" . $id . "'>
                  <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
                   </button></form>
                  </div></td></tr>";
                    }
                    echo "</tbody>
              </table>
              </div>";
                } else {
                    require_once "../Clases/BD.php";
                    $conn = new baseD();
                    $cant_salto = 6;
                    $paginacion = $conn->busquedaFree("SELECT COUNT(*) AS total_registros FROM  usuario");
                    foreach ($paginacion as $datos1) {
                        $cant = $datos1['total_registros'];
                    }
                    if ($cant > 0) {
                        $page = false;
                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        }
                        if (!$page) {
                            $start = 0;
                            $page = 1;
                        } else {
                            $start = ($page - 1) * $cant_salto;
                        }
                        $total_pages = ceil($cant / $cant_salto);
                        $pacientes = $conn->busquedaFree("SELECT * from usuario
                         where id_usuario not in(1) ORDER BY id_usuario asc LIMIT $start, $cant_salto");
                        foreach ($pacientes as $datos1) {
                            $id = $datos1['id_usuario'];
                            $nombre_usuario = $datos1["nombre_usuario"];
                            $apellido_usuario = $datos1['apellido_usuario'];
                            $correo_usuario = $datos1['correo'];
                            $tipo = $datos1['tipo'];
                            if ($tipo == 3) {
                                $tipo = "Administrador";
                            } elseif ($tipo == 2) {
                                $tipo = "Encargado";
                            } else {
                                $tipo = "Invitado";
                            }

                            echo " <tr>
                        <td>$nombre_usuario $apellido_usuario</td>
                        <td>$correo_usuario</td>
                        <td>$tipo</td>
                        <td style='width:240px;'><div class='input-group'>
                   <form action='?x=perfil_usuarios.php' method='post' >
                   <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                  </form>
                  
                   <form action='mants/mant_usuarios.php' method='post'> 
                   <input type='hidden' name='id_us'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                   </button></form>
                   <form action='mants/mant_usuarios.php' method='post'> 
                  <input type='hidden' name='id_us'  Value='" . $id . "'>
                  <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
                   </button></form>
                   <form action='?x=perfil_usuarios.php' method='post'> 
                  <input type='hidden' name='id_password'  Value='" . $id . "'>
                  <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/password.png' alt='x' />
                   </button></form>
                  </div></td></tr>";
                        }
                        echo "</tbody>
              </table>
              </div>";
                        //INICIO PAGINACIÓN
                        echo '<nav>';
                        echo '<ul class="pagination">';
                        if ($total_pages > 1) {
                            if ($page != 1) {
                                echo '<li class="page-item"><a class="page-link" href="./index.php?x=usuarios.php&page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($page == $i) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="./index.php?x=usuarios.php&page=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            if ($page != $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="./index.php?x=usuarios.php&page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
                            }
                        }
                        if ($cant > $cant_salto) {
                            echo '&nbsp &nbsp' . $cant_salto . '&nbsp de &nbsp' . $cant . '</ul>';
                        } else {
                            echo "</ul>";
                        }
                        echo '</nav>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>



</body>

</html>