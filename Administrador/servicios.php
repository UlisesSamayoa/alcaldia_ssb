<!DOCTYPE html>
<html>

<head>
    <title>Participante</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div style=" text-align:center;">
        <h3>ESTUDIOS</h3>
    </div>
    <div style="margin-bottom: 5px; float: left; margin-left:30px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
    </div>
    <!--  <a target="blank" href="../pdf/alumnospdf.php" class="btn btn-danger">Reportes</a>-->
    <div style="float: right; margin-right:40px;">
        <form action="" method="post">
        <?php
                if(isset($_POST['send_busqueda'])){
                    echo '<a href="index.php?x=servicios.php" class="btn btn-danger" style="color:white;">Limpiar</a>';
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
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_servicios.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR ESTUDIO</h4>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">Nombre estudio*</label>
                                    <input type="text" class="form-control" id="firstName" name="nombre" placeholder="Agregar nombre del estudio" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">Relevancia*(5=Normal - 1=Top)</label>
                                    <input type="number" name="relevancia" min="1" max="5" class="form-control" id="firstName" value=5>
                                </div>
                                <div class="col-sm-8">
                                    <label for="lastName" class="form-label">Descripción*</label>
                                    <textarea class="form-control" id="firstName" name="descripcion" required placeholder="Ingrese una descripción" cols="120" rows="3"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="lastName" class="form-label">Servicio*</label>
                                    <select name="servicio" id="" class="form-control" id="firstName">
                                        <?php
                                        require_once "../Clases/BD.php";
                                        $conn = new baseD();
                                        $consulta = $conn->busqueda("servicios");

                                        foreach ($consulta as $datos) {
                                            $id = $datos['id_servicios'];
                                            $nombre = $datos['nombre_servicio'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <label for="firstName" class="form-label">Indicaciones*</label>
                                    <textarea class="form-control" id="firstName" name="indicaciones" required placeholder="Escriba las indicaciones" cols="120" rows="3"></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <label for="firstName" class="form-label">Requerimientos*</label>
                                    <textarea class="form-control" id="firstName" name="requerimientos" required placeholder="Escriba los requerimientos" cols="120" rows="3"></textarea>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Indicaciones</th>
                    <th scope="col">Requerimientos</th>
                    <th scope="col">Relevancia</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_POST['send_busqueda'])) {
                    $valor = $_POST['busqueda'];
                    $pacientes = $conn->busquedaFree("SELECT id_producto,nombre_producto,descripcion_producto,indicaciones_producto,
                            requerimientos_producto,relevancia,servicios.nombre_servicio from producto
                            inner join servicios on producto.id_servicio = servicios.id_servicios
                         where nombre_producto like '%$valor%' or descripcion_producto like '%$valor%' or nombre_servicio like '%$valor%'");
                        foreach ($pacientes as $datos1) {
                            $id = $datos1['id_producto'];
                            $nombre = $datos1["nombre_producto"];
                            $descripcion_producto = $datos1['descripcion_producto'];
                            $indicaciones_producto = $datos1['indicaciones_producto'];
                            $requerimientos_producto = $datos1['requerimientos_producto'];
                            $relevancia = $datos1['relevancia'];
                            $nombre_servicio = $datos1['nombre_servicio'];
                            $consulta_desc = substr($descripcion_producto, 0, 45);
                            $consulta_indi = substr($indicaciones_producto, 0, 45);
                            $consulta_reque = substr($requerimientos_producto, 0, 45);

                            echo " <tr>
                        <td style='width:120px;'>$nombre</td>
                        <td>$consulta_desc...</td>
                        <td>$consulta_indi...</td>
                        <td>$consulta_reque...</td>
                        <td>$relevancia</td>
                        <td>$nombre_servicio</td>
                        <td style='width:180px;'><div class='input-group'>
                        <form action='?x=./perfil_servicios.php' method='post' >
                        <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                       </form>
                       
                        <form action='mants/mant_servicios.php' method='post'> 
                        <input type='hidden' name='id_us'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                        </button></form>
                        <form action='mants/mant_servicios.php' method='post'> 
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
                    $paginacion = $conn->busquedaFree("SELECT COUNT(*) AS total_registros FROM  producto");
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
                        $pacientes = $conn->busquedaFree("SELECT id_producto,nombre_producto,descripcion_producto,indicaciones_producto,
                            requerimientos_producto,relevancia,servicios.nombre_servicio from producto
                            inner join servicios on producto.id_servicio = servicios.id_servicios
                         ORDER BY id_producto asc LIMIT $start, $cant_salto");
                        foreach ($pacientes as $datos1) {
                            $id = $datos1['id_producto'];
                            $nombre = $datos1["nombre_producto"];
                            $descripcion_producto = $datos1['descripcion_producto'];
                            $indicaciones_producto = $datos1['indicaciones_producto'];
                            $requerimientos_producto = $datos1['requerimientos_producto'];
                            $relevancia = $datos1['relevancia'];
                            $nombre_servicio = $datos1['nombre_servicio'];
                            $consulta_desc = substr($descripcion_producto, 0, 45);
                            $consulta_indi = substr($indicaciones_producto, 0, 45);
                            $consulta_reque = substr($requerimientos_producto, 0, 45);

                            echo " <tr>
                        <td style='width:120px;'>$nombre</td>
                        <td>$consulta_desc...</td>
                        <td>$consulta_indi...</td>
                        <td>$consulta_reque...</td>
                        <td>$relevancia</td>
                        <td>$nombre_servicio</td>
                        <td style='width:180px;'><div class='input-group'>
                        <form action='?x=./perfil_servicios.php' method='post' >
                        <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                       </form>
                       
                        <form action='mants/mant_servicios.php' method='post'> 
                        <input type='hidden' name='id_us'  Value='" . $id . "'>
                        <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                        </button></form>
                        <form action='mants/mant_servicios.php' method='post'> 
                       <input type='hidden' name='id_us'  Value='" . $id . "'>
                       <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
                        </button></form>
                       </div> </td></tr>";
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
                        if($cant > $cant_salto){
                            echo '&nbsp &nbsp' . $cant_salto .'&nbsp de &nbsp'. $cant . '</ul>';
                        }else{
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

