<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId'])) header("Location: cpaneladmin.php?error=1");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

// Obtenemos todos los datos del usuario loggeado
$queryGetUserDetails = "SELECT * FROM usuario WHERE id =".$_SESSION['userId'];

$resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or trigger_error("User data couldn't be obtained");

// Hacemos un fetch para extraer los datos del usuario y poder manipularlos
$userDetails = mysql_fetch_assoc($resQueryGetUserDetails);

// Evaluamos que el formulario ha sido enviado
if(isset($_POST['sent'])) {


  // Validación campo nombre
  if(preg_match('/^\s*$/', $_POST['nombre'])) {
      $error[] = "El campo nombre esta vacio.";
    }
    else if(!preg_match("/^[a-zA-Z äáàëéèíìöóòúùñç]+$/i", $_POST['nombre']))
  {
    $error[] = "El campo nombre solo acepta letras.";
  } 

  // Validación campo apellidos
  if(preg_match('/^\s*$/', $_POST['apellidos'])) {
      $error[] = "El campo nombre esta vacio.";
  }else if(!preg_match("/^[a-zA-Z äáàëéèíìöóòúùñç]+$/i", $_POST['apellidos']))
  {
    $error[] = "El campo apellidos solo acepta letras.";
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
    $error[] = "La contraseña no coinciden";
  }

  // Verificamos que sea seleccionado el estado.
  if($_POST['estado'] == "Seleccione su estado") {
    $error[] = "No has seleccionado el estado.";
  }

    
  // Verificamos que los password sean coincidentes
  if($_POST['password'] != $_POST['password2']) {
    $error[] = "Las contraseñas no coinciden.";
  }

  // Solamente ejecutar la transacción en la base de datos cuando estamos libre de errores
  if(!isset($error)) {

    $pass= $_POST['password'];
    $opciones = ['cost' => 12, ];
    $pass_cifrado=password_hash($pass, PASSWORD_DEFAULT, $opciones);

    // Definir el query a ejecutar
    $queryUserEdit = sprintf("UPDATE usuario SET nombre = '%s', apellidos = '%s', password = '%s', estado = '%s', rol = '%s' WHERE id = %d",
      mysql_real_escape_string(trim($_POST['nombre'])),
      mysql_real_escape_string(trim($_POST['apellidos'])),
      mysql_real_escape_string(trim($pass_cifrado)),
      mysql_real_escape_string(trim($_POST['estado'])),
      mysql_real_escape_string(trim($_POST['rol'])),
      $_SESSION['userId']
    );

    // Ejecutamos el query
    $resQueryUserEdit = mysql_query($queryUserEdit, $conexionLocalhost) or die("We're sorry but the query for updating user data wasn't executed");

    // Si todo salio bien, redirigimos al usuario al panel de control
    if($resQueryUserEdit) {
      header("Location: cpaneladmin.php?updatedUser=true");
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
	<title>Pass 'N Go - Actualizar perfil.</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div>
<form action="update_account.php" method="post" class="margen">
<?php if(isset($error)) printMsg($error,"error"); ?>
     
     <h1 class="iniciosesion">Editar perfil</h1>
       
        <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" value="<?php echo $userDetails['nombre']; ?>" ><br>
       
        <label for="apellidos">Apellido:</label><br>
            <input type="text" name="apellidos" value="<?php echo $userDetails['apellidos']; ?>" ><br>
       
        <label for="email">E-mail:</label><br>
            <input type="text" name="email" disabled="disabled" value="<?php echo $userDetails['email']; ?>"><br>
       
        <label for="password">Contraseña:</label><br>
            <input type="password" name="password" ><br>
       
        <label for="password2">Confirmar contraseña:</label><br>
            <input type="password" name="password2" ><br>

        <label for="estado">Estado:</label><br><br>
        <select name="estado" id="estado" value="<?php echo $userDetails['estado']; ?>">
            <option value="Seleccione su estado" selected="selected"  class="genero"  <?php if($userDetails['estado'] == "Seleccione su estado") echo 'selected="selected"'; ?> >Seleccione su estado</option>
            <option value="Aguascalientes" <?php if($userDetails['estado'] == "Aguascalientes") echo 'selected="selected"'; ?> >Aguascalientes</option>
            <option value="Baja California" <?php if($userDetails['estado'] == "Baja California") echo 'selected="selected"'; ?> >Baja California</option>
            <option value="Baja California Sur" <?php if($userDetails['estado'] == "Baja California Sur") echo 'selected="selected"'; ?> >Baja California Sur</option>
            <option value="Campeche" <?php if($userDetails['estado'] == "Campeche") echo 'selected="selected"'; ?> >Campeche</option>
            <option value="Chiapas" <?php if($userDetails['estado'] == "Chiapas") echo 'selected="selected"'; ?> >Chiapas</option>
            <option value="Chihuahua" <?php if($userDetails['estado'] == "Chihuahua") echo 'selected="selected"'; ?> >Chihuahua</option>
            <option value="Coahuila" <?php if($userDetails['estado'] == "Coahuila") echo 'selected="selected"'; ?> >Coahuila</option>
            <option value="Colima" <?php if($userDetails['estado'] == "Colima") echo 'selected="selected"'; ?> >Colima</option>
            <option value="Durango" <?php if($userDetails['estado'] == "Durango") echo 'selected="selected"'; ?> >Durango</option>
            <option value="Estado de México" <?php if($userDetails['estado'] == "Estado de México") echo 'selected="selected"'; ?> >Estado de México</option>
            <option value="Guanajuato" <?php if($userDetails['estado'] == "Guanajuato") echo 'selected="selected"'; ?> >Guanajuato</option>
            <option value="Guerrero" <?php if($userDetails['estado'] == "Guerrero") echo 'selected="selected"'; ?> >Guerrero</option>
            <option value="Hidalgo" <?php if($userDetails['estado'] == "Hidalgo") echo 'selected="selected"'; ?> >Hidalgo</option>
            <option value="Jalisco" <?php if($userDetails['estado'] == "Jalisco") echo 'selected="selected"'; ?> >Jalisco</option>
            <option value="Michoacán" <?php if($userDetails['estado'] == "Michoacán") echo 'selected="selected"'; ?> >Michoacán</option>
            <option value="Morelos" <?php if($userDetails['estado'] == "Morelos") echo 'selected="selected"'; ?> >Morelos</option>
            <option value="Nayarit" <?php if($userDetails['estado'] == "Nayarit") echo 'selected="selected"'; ?> >Nayarit</option>
            <option value="Nuevo León" <?php if($userDetails['estado'] == "Nuevo León") echo 'selected="selected"'; ?> >Nuevo León</option>
            <option value="Oaxaca" <?php if($userDetails['estado'] == "Oaxaca") echo 'selected="selected"'; ?> >Oaxaca</option>
            <option value="Puebla" <?php if($userDetails['estado'] == "Puebla") echo 'selected="selected"'; ?> >Puebla</option>
            <option value="Querétaro" <?php if($userDetails['estado'] == "Querétaro") echo 'selected="selected"'; ?> >Querétaro</option>
            <option value="Quintana Roo" <?php if($userDetails['estado'] == "Quintana Roo") echo 'selected="selected"'; ?> >Quintana Roo</option>
            <option value="San Luis Potosí" <?php if($userDetails['estado'] == "San Luis Potosí") echo 'selected="selected"'; ?> >San Luis Potosí</option>
            <option value="Sinaloa" <?php if($userDetails['estado'] == "Sinaloa") echo 'selected="selected"'; ?> >Sinaloa</option>
            <option value="Sonora" <?php if($userDetails['estado'] == "Sonora") echo 'selected="selected"'; ?> >Sonora</option>
            <option value="Tabasco" <?php if($userDetails['estado'] == "Tabasco") echo 'selected="selected"'; ?> >Tabasco</option>
            <option value="Tamaulipas" <?php if($userDetails['estado'] == "Tamaulipas") echo 'selected="selected"'; ?> >Tamaulipas</option>
            <option value="Tlaxcala" <?php if($userDetails['estado'] == "Tlaxcala") echo 'selected="selected"'; ?> >Tlaxcala</option>
            <option value="Veracruz" <?php if($userDetails['estado'] == "Veracruz") echo 'selected="selected"'; ?> >Veracruz</option>
            <option value="Yucatán" <?php if($userDetails['estado'] == "Yucatán") echo 'selected="selected"'; ?> >Yucatán</option>
            <option value="Zacatecas" <?php if($userDetails['estado'] == "Zacatecas") echo 'selected="selected"'; ?> >Zacatecas</option>
        </select>
		<br>
		<br>
		
  		<select name="rol" id="rol" style="visibility:hidden" value="<?php echo $userDetails['rol']; ?>">
        
        <option value="agent" <?php if($userDetails['rol'] == "agent") echo 'selected="selected"'; ?>>agent</option>
        
        <option value="admin" <?php if($userDetails['rol'] == "admin") echo 'selected="selected"'; ?>>admin</option>

  			</select>
  		<br>
        <input type="submit" class="botonactualizar" value="Actualizar" name="sent" />
</form>
</div>

<div>
  
</div>
</body>
	<?php
	include('includes/footer.php');
	?>
</html>
<?php
  if(isset($resQueryValidateEmail)) mysql_free_result($resQueryValidateEmail);
  if(isset($resQueryAddUsuario)) mysql_free_result($resQueryAddUsuario);
?>