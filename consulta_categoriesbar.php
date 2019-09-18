<?php
  if(!isset($_SESSION)) {
  session_start();
  if(isset($_SESSION['eventId']));}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');



// En una variable previa sanitizamos el parametro de busqueda y le concatenamos los signos de porciento al inicio y final.
$search = $_GET['catEvento'];

// Obtenemos todos los usuarios de la base de datos
$queryGetEvents = "SELECT id, nombre, categoria, tipo, artistaOGrupo, imagen, precio, precioVip FROM evento WHERE categoria LIKE '$search'";

// Ejecutamos el query
$resQueryGetEvents = mysql_query($queryGetEvents, $conexionLocalhost) or trigger_error("The query for obtaining all users couldn't be executed.");

// Extraemos del recordset los datos del primer registro
$eventDetail = mysql_fetch_assoc($resQueryGetEvents);

// Obtenemos el total de usuarios encontrados
$totalEvents = mysql_num_rows($resQueryGetEvents);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css_main.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
  <title>Pass 'N Go - Eventos <?php echo $eventDetail['categoria']; ?>.</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<section>
<div class="margenbusqueda">

  <h1>Eventos <?php echo $eventDetail['categoria']; ?>.</h1> 
  <div>       

    <ul class="listadoeventos">
    <?php
    if($totalEvents == 0){
      echo '<p class="announce">La busqueda no encontró resultados.</p>';}
    else{
    ?>
    <?php
      do { ?>  
      <li class="liTarjeta">
        <p class="busquedaImagenEvento"><img id="imgBusqueda" src="<?php echo $eventDetail['imagen']; ?>">
        <p class="nombreEvento"><a href="eventdetails.php?eventId=<?php echo $eventDetail['id'];?>"><?php echo $eventDetail['nombre']?></a></p>
        <p class="nombreArtista" id="direccionevento"><?php echo $eventDetail['artistaOGrupo']?></p></p>
        <label id="lbpreciosbusqueda">PRECIOS<br> Zona general: <?php echo $eventDetail['precio']; ?><br> Zona Vip: <?php echo $eventDetail['precioVip']; ?>. </label>
<!--
        <p class="accionesusuariobusqueda">
        <a href="eventdetails.php?eventId=<?php echo $eventDetail['id'];?>">Consultar evento</a></p>
-->
      </li>
    <?php } while($eventDetail = mysql_fetch_assoc($resQueryGetEvents)); ?>
    </ul>
    <?php } ?>



  </div>  
</div>  

</section>

</body>
  <?php
  include('includes/footer.php');
  ?>
</html> 