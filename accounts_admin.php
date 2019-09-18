<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId']) || $_SESSION['userLevel'] != "admin") header("Location: cpaneladmin.php?error=2");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

// Obtenemos todos los usuarios de la base de datos
$queryGetUsers = "SELECT id, nombre, apellidos, email FROM usuario";

// Ejecutamos el query
$resQueryGetUsers = mysql_query($queryGetUsers, $conexionLocalhost) or trigger_error("The query for obtaining all users couldn't be executed.");

// Extraemos del recordset los datos del primer registro
$userDetail = mysql_fetch_assoc($resQueryGetUsers);

// Obtenemos el total de usuarios encontrados
$totalUsers = mysql_num_rows($resQueryGetUsers);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css_main.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
	<title>Pass 'N Go - Administrar cuentas</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div class="listuser">
  <h1>Administrar Usuarios</h1>
  <ul class="listadoUsuarios">
  <?php
    do { ?>  
    <li>
      <p class="nombreUsuario"><?php echo $userDetail['nombre'].' '.$userDetail['apellidos'].' - '.$userDetail['email']; ?></p>
      <p class="accionesUsuario"><a href="edit_accounts_admin.php?userId=<?php echo $userDetail['id'];?>">Editar</a> | <a href="enviar_pap_us.php?userId=<?php echo $userDetail['id'];?>">Eliminar</a></p>
    </li>
  <?php } while($userDetail = mysql_fetch_assoc($resQueryGetUsers)); ?>
  </ul>

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