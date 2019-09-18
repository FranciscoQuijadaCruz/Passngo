<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId']) || $_SESSION['userLevel'] != "admin") header("Location: cpaneladmin.php?error=2");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

// Obtenemos todos los usuarios de la base de datos
$queryGetUsers = "SELECT id, nombre, artistaOGrupo, imagen FROM evento";

// Ejecutamos el query
$resQueryGetUsers = mysql_query($queryGetUsers, $conexionLocalhost) or trigger_error("The query for obtaining all events couldn't be executed.");

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
	<title>Pass 'N Go - Administrar eventos</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div class="listuser">
  <h1>Administrar eventos.</h1>

    <ul class="listadoeventos">
    <?php
    do { ?>  
    <li class="liTarjeta">
      
      <p class="busquedaImagenEvento"><img id="imgBusqueda" src="<?php echo $userDetail['imagen']; ?>"></p>
      <p class="nombreEvento"><?php echo $userDetail['nombre']; ?></p>
      <p class="nombreArtista" id="direccionevento"><?php echo $userDetail['artistaOGrupo']; ?></p>
      <p id="lbpreciosbusqueda"><a href="edit_events.php?userId=<?php echo $userDetail['id'];?>">Editar</a> | <a href="enviar_pap_ev.php?userId=<?php echo $userDetail['id'];?>">Eliminar</a></p>
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