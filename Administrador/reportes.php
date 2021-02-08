<div style="text-align: center;">
    <h5>Nota: Tomar en cuenta que algunos reportes pueden tomar unos minutos....</h5>
</div>
<div style="display:inline-flex;">
    <div class="card" style="width: 35%; margin:1%;">
        <div class="card-body">
            <h5 class="card-title"><b>Contribuyentes</b></h5>
            <p class="card-text">Reporte con todos los contribuyentes registrados hasta la fecha.</p>
            <div style="text-align: right !important; margin-top:15% !important;">
                <form action="./reportes/pro_reportes.php" method="post">
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="contri_general">
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="width: 35%; margin:1%;">
        <div class="card-body">
            <h5 class="card-title"><b>Contribuyentes</b></h5>
            <p class="card-text">Reporte, incluya una palabra clave. <br> Ejemplo: EL ZAPOTE</p>
            <div style="text-align: right !important; margin-top:10% !important;">
            <form action="./reportes/pro_reportes.php" method="post">
                    <input type="text" name="palabra" id="" class="form-control" required style="margin-bottom:2%;">
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="contri_palabra">
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="width: 35%; margin:1%;">
        <div class="card-body">
            <h5 class="card-title"><b>Cobal</b></h5>
            <p class="card-text">Reporte con todos los cobales registrados hasta la fecha.</p>
            <div style="text-align: right !important; margin-top:25% !important;">
            <form action="./reportes/pro_reportes.php" method="post">
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="cobal_general">
                </form>
            </div>
        </div>
    </div>
</div>

<div style="display:inline-flex; ">
    <div class="card" style="width: 35%; margin:1%;">
        <div class="card-body">
            <h5 class="card-title"><b>Cobal</b></h5>
            <p class="card-text">Agregar periodo para obtener todos los datos. <br>Ejemplo: 202101.</p>
            <div style="text-align: right !important; ">
            <form action="./reportes/pro_reportes.php" method="post">
                    <input type="text" name="periodo" id="" class="periodo form-control" required style="margin-bottom:2%;">
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="cobal_periodo">
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="width: 35%; margin:1%; position:center;">
        <div class="card-body">
            <h5 class="card-title"><b>Cobal</b></h5>
            <p class="card-text">Seleccione un año para un reporte anual.</p>
            <div style="text-align: right !important; margin-top:16% !important;">
            <form action="./reportes/pro_reportes.php" method="post">
                    <select name="año" id="" class="form-control" required style="margin-bottom:2%;">
                    <?php
                   date_default_timezone_set('America/El_Salvador');
                   $fecha= date("Y");
                    for ($i = 2013; $i <= $fecha; $i++) {
                        echo '<option VALUE="'.$i.'">'. $i . '</option>';
                    }
                    ?>
                    </select>
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="cobal_fecha">
                </form>
            </div>
        </div>
    </div>
    <div class="card" style="width: 35%; margin:1%;">
        <div class="card-body">
            <h5 class="card-title"><b>Usuarios</b></h5>
            <p class="card-text">Generar reporte de todos los usuarios registrados.</p>
            <div style="text-align: right !important; margin-top:30% !important;">
            <form action="./reportes/pro_reportes.php" method="post">
                    <input type="submit" class="btn bg-primary text-white" value="Generar" name="usuarios">
                </form>
            </div>
        </div>
    </div>
</div>

<script>

onload = function(){ 
  var ele = document.querySelectorAll('.periodo')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}
</script>