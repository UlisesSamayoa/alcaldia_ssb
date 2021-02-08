<?php
@session_start();


?>
<!DOCTYPE HTML>
<html>

<head>

  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="login">
    <h1 class="text_login">Iniciar sesión</h1>
    <form method="post" action="login.php">
      <input type="text" name="usuario" placeholder="Usuario" required="required" class="text_login"/>
      <input type="password" name="clave" placeholder="Contraseña" required="required" class="text_login" />
      <button type="submit" name="submit" class="btn btn-primary btn-block btn-large text_login ">Entrar</button>

    </form>
  </div>
</body>
<script>
  document.write(
    '<script src="http://' +
    (location.host || '${1:localhost}').split(':')[0] +
    ':${2:35729}/livereload.js?snipver=1"></' +
    'script>'
  );
</script>
<html>
<?php
@session_start();
include_once "Clases/BD.php";
$conn = new baseD();

if(isset($_SESSION['rol'])){
  header("location: index.php");
}
else{
  if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $resultado = $conn->busquedaFree("SELECT * FROM usuario where correo='$usuario' AND clave='$clave' LIMIT 1");
    $rol="";
    //Validacion para saber si hay resultados 
    if ($resultado == true) {
      foreach ($resultado as $value) {
        $rol=$value['tipo'];
        $medico=$value['id_usuario'];
      }
  
      if($medico==true){
        $_SESSION['id']=$medico;
        $nombreusu=$conn->busquedaFree("SELECT id_usuario,`nombre_usuario`, `apellido_usuario` FROM usuario WHERE id_usuario=$medico LIMIT 1;");
      }
      foreach ($nombreusu as $value) {
        $_SESSION['Nombre']=strtoupper($value['nombre_usuario']." ".$value['apellido_usuario']);
        setcookie("cod","".$value['id_usuario']."",time() + (86400 * 30)*12);
      }
        $_SESSION['rol']=$rol;
        header ("location: index.php");
  
    }else {
      echo "<script>alert('Usuario o contraseña incorrectos.')</script>";
    }
  }
}
?>