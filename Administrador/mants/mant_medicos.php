<?php
require_once "../../Clases/BD.php";
$conn = new baseD();
//If para controlar las tres acciones de control de datos del CRUD.
if (isset($_POST['send_insert'])) {
        $nombre_med = $_POST['nombre'];
        $apellido_med = $_POST['apellido'];
        $dui_med = $_POST['dui'];
        $telefono_med = $_POST['telefono'];
        $correo_med = $_POST['correo'];
        $direccion_med = $_POST['direccion'];
        $sexo_med = $_POST['sexo'];
        $especialidad_med = $_POST['especialidad'];
        /* $fechaNac = $_GET['fecha']; */
        $fechaNac_med = date('Y-m-d', strtotime($_POST['fecha']));
            $conn->insertar(
                "medico( nombre_medico, apellido_medico, dui, fecha_nacimiento, sexo, telefono, correo, direccion,id_especialidad)",
                "'$nombre_med','$apellido_med','$dui_med','$fechaNac_med','$sexo_med','$telefono_med','$correo_med','$direccion_med','$especialidad_med'");
        echo '<script>alert("Registro INGRESADO con exito");</script>';
        echo " <script>window.location.replace('../index.php?x=medicos.php')</script>";

} elseif (isset($_POST['send_dl'])) {
  $id_del = $_POST['id_us'];
  $conn->borrar("medico","id_medico = $id_del");
  echo '<script>alert("Registro ELIMINADO con exito");</script>';
  echo " <script>window.location.replace('../index.php?x=medicos.php')</script>";
} elseif (isset($_POST['send_update'])) {
?>
  <!-- Estilos del Modal -->

  <head>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  </head>
  <!-- Fin de los estilos del Modal -->
  <!-- Activar el MODAL al CARGAR el sitio completo -->
  <style>
    #id01 {
      display: block;
    }
  </style>
  <!-- Inicio de Modal de Actualizar -->
  <div class="w3-container">
    <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">
        <div class="w3-center"><br>
          <a href="../index.php?x=medicos.php"> <span class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span></a>
          <p>ACTUALIZAR MÉDICO</p>
        </div>
        <form class="w3-container" method="post" action="">
          <div class="w3-section">
            <?php
            //Inicio de Consulta filtrada para mostrar los datos del PARTICIPANTE a Actualizar
            $id_update = $_POST['id_us'];
            //Inicio de consulta SQL, datos requerido por la función busquedaFree(tabla)
            $busqueda = $conn->busquedaFree("SELECT * FROM medico INNER JOIN `clinicamonterroza`.`especialidad`
            ON (
              `medico`.`id_especialidad` = `especialidad`.`id_especialidad`
            ) WHERE medico.id_medico = $id_update");
            foreach ($busqueda as $datos) {
              //Asignación de datos a la variables para mostrar los valores en los inputs
              $id = $datos['id_medico'];
              $nombre = $datos['nombre_medico'];
              $apellidos = $datos['apellido_medico'];
              $dui = $datos['dui'];
              $sexo = $datos['sexo'];
              $fecha = $datos['fecha_nacimiento'];
              $telefono = $datos['telefono'];
              $correo = $datos['correo'];
              $direccion = $datos['direccion'];
              $especialidad = $datos['id_especialidad'];
            ?>
              <!-- Llenado de los Valores(propiedad Value) de los Inputs -->
              <input type="hidden" name="id_update" Value="<?php echo $id; ?>">
              <label><b>Nombre</b></label>
              <input class="w3-input w3-border " type="text" Value="<?php echo $nombre; ?>" name="nombre" required>
              <label><b>Apellido</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $apellidos; ?>" name="apellido" required>
              <label><b>DUI</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $dui; ?>" name="dui" required>
              <label><b>Sexo</b></label>
              <select name="sexo" id="" class="w3-input w3-border">
                <?php
                 if ($sexo == 'Hombre') {
                  echo '<option value="Hombre" selected><b>Hombre</b></option>';
                  echo '<option value="Mujer"><b>Mujer</b></option>';
                } else {
                  echo '<option value="Hombre" ><b>Hombre</b></option>';
                  echo '<option value="Mujer" selected><b>Mujer</b></option>';
                }
                ?>
              </select>
              <label><b>Fecha de Nacimiento</b></label>
              <input class="w3-input w3-border" type="date" Value="<?php echo $fecha; ?>" name="fecha" required>
              <label><b>Telefono</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $telefono; ?>" name="telefono" required>
              <label><b>Correo electronico</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $correo; ?>" name="correo" required>
              <label><b>Dirección</b></label>
              <input class="w3-input w3-border" type="text" Value="<?php echo $direccion; ?>" name="direccion" required>
              </select>
              <label><b>Especialidad</b></label>
              <select name="especialidad" id="" class="w3-input w3-border">
                <?php
                //Consulta para llenar el SELECT de curso
                $consulta = $conn->busqueda("especialidad");

                foreach ($consulta as $datos) {
                  $id = $datos['id_especialidad'];
                  $nombre = $datos['nombre_especialidad'];
                  if ($id == $especialidad) {
                    echo '<option value="' . $id . '" selected="true">' . $nombre . '</option>';
                  } else {
                    echo '<option value="' . $id . '">' . $nombre . '</option>';
                  }
                }
                ?>
              </select>
            <?php
              //Cierre del Foreach
            }
            ?>
            <input type="submit" class="w3-button w3-block w3-blue w3-section w3-padding" value="Actualizar" name="send_update2">
          </div>
        </form>
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <a href="../index.php?x=medicos.php" class="w3-button w3-red">Cancel</a>
        </div>
      </div>
    </div>
    <script>
      $(function() {
        $("#telp").change(function() {
          if ($(this).val() !== "") {
            $("#telc").removeAttr("required");
          } else {
            $('#telc').prop("required", true);
          }
        });
      });
    </script>
    <!-- FIN del MODAL -->
  <?php

} elseif (isset($_POST['send_update2'])) {
        $id_update = $_POST['id_update'];
        $nombre_ac = $_POST['nombre'];
        $apellido_ac = $_POST['apellido'];
        $dui_ac = $_POST['dui'];
        $telefono_ac= $_POST['telefono'];
        $correo_ac = $_POST['correo'];
        $direccion_ac = $_POST['direccion'];
        $sexo_ac = $_POST['sexo'];
        $especialidad_ac = $_POST['especialidad'];
        /* $fechaNac = $_GET['fecha']; */
        $fechaNac = date('Y-m-d', strtotime($_POST['fecha']));
        $consulta = $conn->actualizar("medico", "nombre_medico='$nombre_ac',apellido_medico='$apellido_ac',dui='$dui_ac',sexo='$sexo_ac',fecha_nacimiento='$fechaNac',telefono='$telefono_ac',correo='$correo_ac',direccion='$direccion_ac',id_especialidad=$especialidad_ac", "id_medico=$id_update");
        echo '<script>alert("Registro ACTUALIZADO con exito");</script>';
        echo " <script>window.location.replace('../index.php?x=medicos.php')</script>";
}

  ?>