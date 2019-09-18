<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId']) || $_SESSION['userLevel'] != "admin") header("Location: cpaneladmin.php?error=2");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

// Obtenemos todos los usuarios de la base de datos
$queryGetVentas = "SELECT id, idEvento, nombreCompleto, correo, total FROM ventas";

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
	<title>Pass 'N Go - Consultar Ventas</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div class="listuser">
  <h1>Consultar Ventas</h1>
  <ul class="listadoUsuarios">
  <?php
    do { ?>  
    <li class="liVentas">
      <p class="nombreVentas"><?php echo 'Cliente: ' . $ventasDetail['nombreCompleto']; ?></p>
      <p class="nombreVentas"><?php echo 'Correo: '.$ventasDetail['correo']; ?></p>
      <p class="nombreVentas"><?php echo '$'.$ventasDetail['total']; ?></p>
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