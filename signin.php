<?php
  if(!isset($_SESSION)) {
  session_start();}

  include('conexion/conexionLocalhost.php');
  include('includes/codigoComun.php');


// Evaluamos que el formulario ha sido enviado
if(isset($_POST['sent'])) {

  // Validación campo nombre
  if(preg_match('/^\s*$/', $_POST['nombre'])) {
      $error[] = "El campo nombre esta vacio.";
  }else if(!preg_match("/^[a-zA-Z äáàëéèíìöóòúùñç]+$/i", $_POST['nombre']))
  {
    $error[] = "El campo nombre solo acepta letras.";
  } 

  // Validación campo apellidos
  if(preg_match('/^\s*$/', $_POST['apellidos'])) {
      $error[] = "El campo apellido esta vacio.";
  }else if(!preg_match("/^[a-zA-Z äáàëéèíìöóòúùñç]+$/i", $_POST['apellidos']))
  {
    $error[] = "El campo apellidos solo acepta letras.";
  } 

  //Validacion email.  
  if(preg_match('/^\s*$/', $_POST['email'])) {
    $error[] = "El campo email esta vacio.";
  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/i", $_POST['email']))
  {
    $error[] = "Los datos no cumplen con la estructura de un correo electronico.";
  } 

  //Validacion password.
    $mayus = preg_match('@[A-Z]@', $_POST['password']);
    $minus = preg_match('@[a-z]@', $_POST['password']);
    $numero    = preg_match('@[0-9]@', $_POST['password']);
    if(preg_match('/^\s*$/', $_POST['password'])) {
      $error[] = "El campo password esta vacio.";
    }
    else if(!$mayus || !$minus || !$numero || strlen($_POST['password']) < 8) {
      $error[] = "La contraseña no cumple con las características mencionadas.";
    }

  // Verificamos que los password sean coincidentes
  if($_POST['password'] != $_POST['password2']) {
    $error[] = "Las contraseñas no coinciden";
  }

  // Verificamos que sea seleccionado el estado.
  if($_POST['estado'] == "Seleccione su estado") {
    $error[] = "No has seleccionado el estado.";
  }

  // Definir el query para buscar el email en la base de datos
  $queryValidateEmail = sprintf("SELECT id FROM usuario WHERE email = '%s'",
    mysql_real_escape_string(trim($_POST['email']))
  );

  // Ejecutar el query
  $resQueryValidateEmail = mysql_query($queryValidateEmail, $conexionLocalhost) or die("El query para buscar el email no se ejecutó");

  // Definir el query para buscar el email en la base de datos
  $queryValidateEmailP = sprintf("SELECT id FROM papelerausuario WHERE email = '%s'",
    mysql_real_escape_string(trim($_POST['email']))
  );

  // Ejecutar el query
  $resQueryValidateEmailP = mysql_query($queryValidateEmailP, $conexionLocalhost) or die("El query para buscar el email no se ejecutó");

  // Contamos el numero de registros que devuelve la consulta y en caso de existir un registro generamos un error de email utilizado
  if(mysql_num_rows($resQueryValidateEmail)) {
      $error[] = "Este correo electronico esta en uso.";
    }elseif(mysql_num_rows($resQueryValidateEmailP)) $error[] = "Es posible que este correo se encuentre en revisión, favor de contactar con un administrador.";

  // Solamente ejecutar la transacción en la base de datos cuando estamos libre de errores
  if(!isset($error)) {

    $pass= $_POST['password'];
    $opciones = ['cost' => 12, ];
    $pass_cifrado=password_hash($pass, PASSWORD_DEFAULT, $opciones);

    // Definir el query a ejecutar
    $queryAddUsuario = sprintf("INSERT INTO usuario (nombre, apellidos, email, password, estado) VALUES ('%s', '%s', '%s', '%s', '%s')",
      mysql_real_escape_string(trim($_POST['nombre'])),
      mysql_real_escape_string(trim($_POST['apellidos'])),
      mysql_real_escape_string(trim($_POST['email'])),
      mysql_real_escape_string(trim($pass_cifrado)),
      mysql_real_escape_string(trim($_POST['estado']))
    );

    // Ejecutamos el query
    $resQueryAddUsuario = mysql_query($queryAddUsuario, $conexionLocalhost) or die("El query para guardar el usuario no se ejecutó");


    // Si todo salio bien, redirigimos al usuario al panel de control
    if($resQueryAddUsuario) {
      header("Location: login.php?registerUser=true");
    }

  }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css_main.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
  <title>Pass 'N Go - Sign in</title>
</head>
<body>

<section>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>



<form action="signin.php" method="post" class="margen">
  
  <?php if(isset($error)) printMsg($error,"error"); ?>

     <h1>Regístrate</h1>
       
        <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" placeholder="Nombre del usuario" <?php if(isset($_POST['nombre'])) echo 'value="'.$_POST['nombre'].'"'; ?> ><br>
       
        <label for="apellidos">Apellido:</label><br>
            <input type="text" name="apellidos" placeholder="Apellidos del usuario" <?php if(isset($_POST['apellidos'])) echo 'value="'.$_POST['apellidos'].'"'; ?> ><br>
       
        <label for="email">E-mail:</label><br>
            <input type="text" name="email" placeholder="E-mail del usuario" <?php if(isset($_POST['email'])) echo 'value="'.$_POST['email'].'"'; ?> ><br>
       
        <label for="password">Contraseña:</label><br>
            <input type="password" name="password" placeholder="Mínimo 6 caractéres, 1 mayúscula y 1 minúscula."><br>
       
        <label for="password2">Confirmar contraseña:</label><br>
            <input type="password" name="password2" placeholder="Confirme la contraseña"><br>

        <label for="estado">Estado:</label><br><br>
        <select name="estado" id="estado">
            <option value="Seleccione su estado" selected="selected"  class="genero">Seleccione su estado</option>
            <option value="Aguascalientes">Aguascalientes</option>
            <option value="Baja California">Baja California</option>
            <option value="Baja California Sur">Baja California Sur</option>
            <option value="Campeche">Campeche</option>
            <option value="Chiapas">Chiapas</option>
            <option value="Chihuahua">Chihuahua</option>
            <option value="Coahuila">Coahuila</option>
            <option value="Colima">Colima</option>
            <option value="Durango">Durango</option>
            <option value="Estado de México">Estado de México</option>
            <option value="Guanajuato">Guanajuato</option>
            <option value="Guerrero">Guerrero</option>
            <option value="Hidalgo">Hidalgo</option>
            <option value="Jalisco">Jalisco</option>
            <option value="Michoacán">Michoacán</option>
            <option value="Morelos">Morelos</option>
            <option value="Nayarit">Nayarit</option>
            <option value="Nuevo León">Nuevo León</option>
            <option value="Oaxaca">Oaxaca</option>
            <option value="Puebla">Puebla</option>
            <option value="Querétaro">Querétaro</option>
            <option value="Quintana Roo">Quintana Roo</option>
            <option value="San Luis Potosí">San Luis Potosí</option>
            <option value="Sinaloa">Sinaloa</option>
            <option value="Sonora">Sonora</option>
            <option value="Tabasco">Tabasco</option>
            <option value="Tamaulipas">Tamaulipas</option>
            <option value="Tlaxcala">Tlaxcala</option>
            <option value="Veracruz">Veracruz</option>
            <option value="Yucatán">Yucatán</option>
            <option value="Zacatecas">Zacatecas</option>
        </select>
    <br>
    <br>
    
      <select name="rol" id="rol" style="visibility:hidden">
        <option value="agent" selected="selected">Agent</option>
        <option value="admin">Administrator</option>
        </select>
      <br>

        <input type="submit" class="boton" value="Registrar" name="sent" />
</form>
</section>
</body>
  <?php
  include('includes/footer.php');
  ?>
</html>
<?php
  if(isset($resQueryValidateEmail)) mysql_free_result($resQueryValidateEmail);
  if(isset($resQueryAddUsuario)) mysql_free_result($resQueryAddUsuario);
?>