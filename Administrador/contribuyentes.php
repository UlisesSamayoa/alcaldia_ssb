<!DOCTYPE html>
<html>

<head>
    <title>Contribuyentes</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div style="margin-bottom: 5px; margin-left:30px;">
        <button onclick="document.getElementById('id02').style.display='block'" class="btn btn-success" style="color:white;">Agregar(Excel)</button>
        <button onclick="document.getElementById('id01').style.display='block'" class="btn bg-primary" style="color:white;">Agregar</button>
        <!--  <a target="blank" href="../pdf/alumnospdf.php" class="btn btn-danger">Reportes</a>-->
        <div style="float: right; margin-right:40px;">
            <form action="" method="post">
                <?php
                if (isset($_POST['send_busqueda'])) {
                    echo '<a href="index.php?x=contribuyentes.php" class="btn btn-danger" style="color:white;">Limpiar</a>';
                }
                ?>
                <input type="text" style="border-radius: 5px;" name="busqueda" required>
                <input type="submit" value="Buscar" class="btn btn-info" name="send_busqueda"></input>

            </form>
        </div>
    </div>
    <div class="w3-container">
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:900px">
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_contribuyentes.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR CONTRIBUYENTES</h4>
                                <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <!-- Formulario central -->
                            <div class="col-md-7 col-lg-12">
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label for="firstName" class="form-label">Subir archivo*</label>
                                        <input type="file" class="form-control" id="firstName" name="archivo" required>
                                        <br><br>
                                    </div>
                                    <div class="input-group">
                                        <input type="submit" class="form-control text-white bg-success" id="enviar" name="send_insert2" value="Registrar" readonly>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                </form>
            </div>
        </div>

    </div>
    <!-- Inicio Modal -->
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:900px">
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_contribuyentes.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR CONTRIBUYENTE</h4>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <!-- Formulario central -->
                            <div class="col-md-7 col-lg-12">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Nombres*</label>
                                        <input type="text" class="form-control" id="firstName" name="nombre" placeholder="Ingresar nombres" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">NIC*</label>
                                        <input type="text" class="form-control" id="firstName" name="nic" placeholder="Ingresar NIC" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Medidor*</label>
                                        <input type="text" class="form-control" id="firstName" name="medidor" placeholder="Ingresar el medidor" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">NIS*</label>
                                        <input type="text" class="form-control" id="lastName" name="nis" placeholder="Ingresar NIS" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">UNICOM*</label>
                                        <input type="text" class="form-control" id="lastName" name="unicom" placeholder="Ingresar UNICOM" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Municipio*</label>
                                        <input type="text" class="form-control" id="firstName" name="municipio" value="S SEBASTIAN SALITRILLO" readonly required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="lastName" class="form-label">Dirección*</label>
                                        <input type="text" class="form-control" id="lastName" name="direccion" placeholder="Ingresar dirección" required>
                                        <br>
                                    </div>
                                    <div class="input-group">

                                        <input type="submit" class="form-control text-white bg-success" id="enviar" name="send_insert" value="Registrar" readonly>
                                    </div>
                                    <br><br>
                                </div>
                </form>
            </div>
        </div>

        </main>
    </div>


    </form>

    </div>
    </div>

    <!-- Data -->
    <div>
        <table class="table" >
            <thead class="thead bg-primary text-white">
                <tr>
                    <th scope="col" style='width:80px !important;'>Nombre</th>
                    <th scope="col" style='width:80px !important;'>Medidor</th>
                    <th scope="col" style='width:80px !important;'>NIC</th>
                    <th scope="col" style='width:80px !important;'>UNICOM</th>
                    <th scope="col" style='width:80px !important ;'>Dirección</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody >
                <?php
                if (isset($_POST['send_busqueda'])) {
                    require_once "../Clases/BD.php";
                    $conn = new baseD();
                    $filtro = $_POST['busqueda'];
                    $contribuyentes = $conn->busquedaFree("SELECT * FROM cliente
                     WHERE nombres LIKE '%$filtro%' OR nic LIKE '%$filtro%'  OR nis LIKE '%$filtro%' OR medidor LIKE '%$filtro%'");
                    foreach ($contribuyentes as $datos1) {
                        $id = $datos1['id_cliente'];
                        $nombre = $datos1["nombres"];
                        $unicom = $datos1['unicom'];
                        $direccion = $datos1['direccion'];
                        $municipio = $datos1['municipio'];
                        $nis = $datos1['nis'];
                        $nic = $datos1['nic'];
                        $medidor = $datos1['medidor'];

                        echo " <tr>
                    <td >$nombre</td>
                    <td>$medidor</td>
                    <td>$nic</td>
                    <td>$unicom</td>
                    <td >$direccion</td>
                    <td style='width:180px;'><div class='input-group'>
                    <form action='?x=perfil_contribuyentes.php' method='post' >
                    <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                    <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                   </form>
                   
                    <form action='mants/mant_contribuyentes.php' method='post'> 
                    <input type='hidden' name='id_us'  Value='" . $id . "'>
                    <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                    </button></form>
                    <form action='mants/mant_contribuyentes.php' method='post'> 
                   <input type='hidden' name='id_us'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
                    </button></form>
                   </div></td></tr>";
                    }
                    echo "</tbody>
              </table>
              </div>";
                } else {
                ?>
                <?php
                    require_once "../Clases/BD.php";
                    $conn = new baseD();
                    $cant_salto = 15;
                    $paginacion = $conn->busquedaFree("SELECT COUNT(*) AS total_registros FROM  cliente");
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
                        $contribuyentes = $conn->busquedaFree("SELECT * FROM cliente
                     ORDER BY id_cliente asc LIMIT $start, $cant_salto");
                        foreach ($contribuyentes as $datos1) {
                            $id = $datos1['id_cliente'];
                            $nombre = $datos1["nombres"];
                            $unicom = $datos1['unicom'];
                            $direccion = $datos1['direccion'];
                            $municipio = $datos1['municipio'];
                            $nis = $datos1['nis'];
                            $nic = $datos1['nic'];
                            $medidor = $datos1['medidor'];

                            echo " <tr>
                        <td >$nombre</td>
                        <td>$medidor</td>
                        <td>$nic</td>
                        <td>$unicom</td>
                        <td >$direccion</td>
                        <td style='width:180px;'><div class='input-group'>
                   <form action='?x=perfil_contribuyentes.php' method='post' >
                   <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                  </form>
                  
                   <form action='mants/mant_contribuyentes.php' method='post'> 
                   <input type='hidden' name='id_us'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;' name='send_update'><img src='../images/icons/formularios/update.png' alt='x' />
                   </button></form>
                   <form action='mants/mant_contribuyentes.php' method='post'> 
                  <input type='hidden' name='id_us'  Value='" . $id . "'>
                  <button type='submit' class='form-control text-white' style='border:none;' name='send_dl'><img src='../images/icons/formularios/borrar.png' alt='x' />
                   </button></form>
                  </div></td></tr>";
                        }
                        echo "</tbody>
              </table>
              </div>";
                        //INICIO PAGINACIÓN
                        echo '<nav style="font-size:11px !important; height:150px; width:900px; overflow:auto;">';
                        echo '<ul class="pagination" >';
                        if($total_pages > 1){
                           
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($page == $i) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="./index.php?x=contribuyentes.php&page=' . $i . '">' . $i . '</a><li>';
                                    if((fmod($i,25)==0)){
                                        echo "</ul><ul class='pagination'>";
                                    }
                                   
                                    
                                }
                            }
                        }
                        echo '</ul>';
                        echo '</nav>';
                        if($cant > $cant_salto){
                            echo '&nbsp &nbsp' . $cant_salto .'&nbsp de &nbsp'. $cant ;
                        }else{
                           
                        }
                    }
                }
                ?>

</body>

</html>