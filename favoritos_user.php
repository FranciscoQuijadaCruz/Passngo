<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId']) || $_SESSION['userLevel'] != "agent") header("Location: cpaneladmin.php?error=2");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

// Obtenemos todos los usuarios de la base de datos
$queryGetVentas = "SELECT favoritos.idEvento AS 'idEvento', usuario.nombre AS 'nombreUsuario', usuario.apellidos AS 'apellidoUsuario', usuario.email AS 'emailUsuario',evento.nombre AS 'nombreEvento', evento.categoria AS 'categoriaEvento', evento.artistaOGrupo AS 'artistaEvento' FROM favoritos LEFT JOIN usuario ON usuario.id = favoritos.idUsuario LEFT JOIN evento ON favoritos.idEvento = evento.id WHERE favoritos.idUsuario = ".$_SESSION['userId'];

// Ejecutamos el query
$resQueryGetVentas = mysql_query($queryGetVentas, $conexionLocalhost) or trigger_error("The query for obtaining all sales couldn't be executed.");

// Extraemos del recordset los datos del primer registro
$ventasDetail = mysql_fetch_assoc($resQueryGetVentas);

// Obtenemos el total de usuarios encontrados
$totalVentas = mysql_num_rows($resQueryGetVentas);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css_main.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
	<title>Pass 'N Go - Consultar Favoritos</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div class="listuser">
  <h1>Consultar Favoritos</h1>
  <ul class="listadoUsuarios">
  <?php
    do { ?>  
    <li class="liVentas">
      <p class="nombreVentas"><?php echo 'Cliente: ' . $ventasDetail['nombreUsuario']. ' ' . $ventasDetail['apellidoUsuario']; ?></p>
      <p class="nombreVentas"><?php echo 'Correo: '.$ventasDetail['emailUsuario']; ?></p>
      <p class="nombreVentas"><?php echo 'Evento: <a href="eventdetails.php?eventId='.$ventasDetail['idEvento'].'">'.$ventasDetail['nombreEvento'].'</a>'; ?></p>
      <br>
    </li>
  <?php } while($ventasDetail = mysql_fetch_assoc($resQueryGetVentas)); ?>
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