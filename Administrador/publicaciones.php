<!DOCTYPE html>
<html>

<head>
    <title>Participante</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div style=" text-align:center;">
        <h3>PORTADAS</h3>
    </div>
    <div style="margin-bottom: 5px; float: left; margin-left:30px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
    </div>
    <!--  <a target="blank" href="../pdf/alumnospdf.php" class="btn btn-danger">Reportes</a>-->
    <div style="float: right; margin-right:40px;">
        <form action="" method="post">
            <?php
            if (isset($_POST['send_busqueda'])) {
                echo '<a href="index.php?x=publicaciones.php" class="btn btn-danger" style="color:white;">Limpiar</a>';
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
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_publicaciones.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR PORTADA</h4>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <div class="row g-3">

                                <div class="col-sm-12">
                                    <label for="lastName" class="form-label">Nueva imágen*</label>
                                    <input type="file" class="form-control" id="firstName" name="imagen" required>
                                    <br>
                                </div>
                                <div class="input-group">
                               
                                    <input type="submit" class="form-control text-white bg-success" name="send_insert" value="Registrar" readonly>
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

    <div>

        <table class="table">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Fecha de Publicación</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_POST['send_busqueda'])) {
                    $valor = $_POST['busqueda'];
                    $pacientes = $conn->busquedaFree("SELECT * from publicaciones
                        where fecha_publicacion like '%$valor%'");
                        foreach ($pacientes as $datos1) {
                            $id = $datos1['id_publicaciones'];
                            $fecha_publicacion = $datos1["fecha_publicacion"];
                            $imagen_publicacion = $datos1['imagen_publicacion'];
                            echo " <tr>
                            <td><a href='../images/publicaciones/$imagen_publicacion' rel='shadowbox'><img src='../images/publicaciones/$imagen_publicacion' alt='Imagen_Servicio' class='imagen_perfil'></a></td>
                        <td>$fecha_publicacion</td>
                        <td style='width:180px;'><div class='input-group'>
                        <form action='mants/mant_publicaciones.php' method='post'> 
                        <input type='hidden' name='id_us'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                        </button></form>
                        <form action='mants/mant_publicaciones.php' method='post'> 
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
                    $paginacion = $conn->busquedaFree("SELECT COUNT(*) AS total_registros FROM  publicaciones");
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
                        $pacientes = $conn->busquedaFree("SELECT * from publicaciones
                         ORDER BY id_publicaciones asc LIMIT $start, $cant_salto");
                        foreach ($pacientes as $datos1) {
                            $id = $datos1['id_publicaciones'];
                            $fecha_publicacion = $datos1["fecha_publicacion"];
                            $imagen_publicacion = $datos1['imagen_publicacion'];
                            echo " <tr>
                            <td><a href='../images/publicaciones/$imagen_publicacion' rel='shadowbox'><img src='../images/publicaciones/$imagen_publicacion' alt='Imagen_Servicio' class='imagen_perfil'></a></td>
                        <td>$fecha_publicacion</td>
                        <td style='width:180px;'><div class='input-group'>
                        <form action='mants/mant_publicaciones.php' method='post'> 
                        <input type='hidden' name='id_us'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                        </button></form>
                        <form action='mants/mant_publicaciones.php' method='post'> 
                       <input type='hidden' name='id_us'  Value='" . $id . "'>
                       <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
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
                                echo '<li class="page-item"><a class="page-link" href="./index.php?x=servicios.php&page=' . ($page - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($page == $i) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="./index.php?x=servicios.php&page=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            if ($page != $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="./index.php?x=servicios.php&page=' . ($page + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
                            }
                        }
                        echo '</ul>';
                        echo '</nav>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>



</body>

</html>