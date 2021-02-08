<!DOCTYPE html>
<html>

<head>
    <title>Contribuyentes</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div style=" max-width:900px;   margin-bottom: 5px; margin-left:30px;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success">Agregar</button>
        <!--  <a target="blank" href="../pdf/alumnospdf.php" class="btn btn-danger">Reportes</a>-->
        <div style="float: right; margin-right:40px;">
            <form action="" method="post">
                <?php
                if (isset($_POST['send_busqueda'])) {
                    echo '<a href="index.php?x=cobal.php" class="btn btn-danger" style="color:white;">Limpiar</a>';
                }
                ?>
                <input type="text" style="border-radius: 5px;" name="busqueda" required>
                <input type="submit" value="Buscar" class="btn btn-info" name="send_busqueda"></input>

            </form>
        </div>
    </div>

    <!-- Inicio Modal -->
    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:900px">
                <form class="w3-container" enctype="multipart/form-data" method="post" action="./mants/mant_cobal.php">
                    <div class="container">
                        <main>
                            <div class="py-5 text-center">
                                <h4>AGREGAR COBAL</h4>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <!--  <p class="lead"></p>-->
                            </div>
                            <!-- Formulario central -->
                            <div class="col-md-7 col-lg-12">
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label for="firstName" class="form-label">Subir Cobal*</label>
                                        <input type="file" class="form-control" id="firstName" name="archivo" required>
                                        <br>
                                    </div>
                                    <div class="col-sm-12">

                                        <p> <b>Por razones de seguridad se registran un maximo de 1,000 cobales a la vez.</b></p>
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
        <table class="table" style="max-width:100%;">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th scope="col">NIC</th>
                    <th scope="col">UNICOM</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Fecha de pago</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['send_busqueda'])) {
                    require_once "../Clases/BD.php";
                    $conn = new baseD();
                    $filtro = $_POST['busqueda'];
                    $contribuyentes = $conn->busquedaFree("SELECT * FROM cobal
                     WHERE nic LIKE '%$filtro%' or periodo like '%$filtro%' or fecha_pago like '%$filtro%'");
                    foreach ($contribuyentes as $datos1) {
                        $id = $datos1['id_cobal'];
                        $nic = $datos1["nic"];
                        $unicom = $datos1['unicom'];
                        $periodo = $datos1['periodo'];
                        $fecha_pago = $datos1['fecha_pago'];
                        $total = $datos1['total'];


                        echo " <tr>
                        <td>$nic</td>
                        <td>$unicom</td>
                        <td>$periodo</td>
                        <td>$fecha_pago</td>
                        <td>$total</td>
                    <td style='width:180px;'><div class='input-group'>
               <form action='?x=perfil_cobal.php' method='post' >
                <input type='hidden' name='nic_perfil'  Value='" . $nic . "'>
                <input type='hidden' name='id_perfil'  Value='" . $id . "'>
               <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
              </form>             
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
                    $cant_salto = 10;
                    $paginacion = $conn->busquedaFree("SELECT COUNT(*) AS total_registros FROM  cobal");
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
                        $contribuyentes = $conn->busquedaFree("SELECT * FROM cobal
                     ORDER BY periodo asc LIMIT $start, $cant_salto");
                        foreach ($contribuyentes as $datos1) {
                            $id = $datos1['id_cobal'];
                            $nic = $datos1["nic"];
                            $unicom = $datos1['unicom'];
                            $periodo = $datos1['periodo'];
                            $fecha_pago = $datos1['fecha_pago'];
                            $total = $datos1['total'];


                            echo " <tr>
                        <td>$nic</td>
                        <td>$unicom</td>
                        <td>$periodo</td>
                        <td>$fecha_pago</td>
                        <td>$total</td>
                        <td style='width:180px;'><div class='input-group'>
                   <form action='?x=perfil_cobal.php' method='post' >
                    <input type='hidden' name='nic_perfil'  Value='" . $nic . "'>
                    <input type='hidden' name='id_perfil'  Value='" . $id . "'>
                   <button type='submit' class='form-control text-white' style='border:none;'><img src='../images/icons/formularios/mas.png' alt='x' />
                  </form>
                  </div></td></tr>";
                        }
                        echo "</tbody>
              </table>
              </div>";
                        //INICIO PAGINACIÓN
                        echo '<nav style="font-size:11px !important; height:150px; width:900px; overflow:auto;">';
                        echo '<ul class="pagination" >';
                        if ($total_pages > 1) {

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($page == $i) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $page . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="./index.php?x=cobal.php&page=' . $i . '">' . $i . '</a><li>';
                                    if ((fmod($i, 25) == 0)) {
                                        echo "</ul><ul class='pagination'>";
                                    }
                                }
                            }
                        }
                        echo '</ul>';
                        echo '</nav>';
                        if ($cant > $cant_salto) {
                            echo '&nbsp &nbsp' . $cant_salto . '&nbsp de &nbsp' . $cant;
                        } else {
                        }
                    }
                }
                ?>

</body>

</html>