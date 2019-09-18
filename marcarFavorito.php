<?php
  if(!isset($_SESSION)) {
  session_start();
  if(isset($_SESSION['eventId']));}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

if(isset($_GET['eventId']) && is_numeric($_GET['eventId'])) {

  // Obtenemos todos los datos del usuario loggeado
  $queryGetInfoDetails = sprintf("SELECT * FROM evento WHERE id = %d",
    mysql_real_escape_string(trim($_GET['eventId']))
  );

  $resQueryGetInfoDetails = mysql_query($queryGetInfoDetails, $conexionLocalhost) or trigger_error("User data couldn't be obtained");

  // Evaluo si obtuve resultados con la consulta
  if(mysql_num_rows($resQueryGetInfoDetails) == 0) header("Location: busqueda.php?error=4");

  // Hacemos un fetch para extraer los datos del usuario y poder manipularlos
  $infoDetails = mysql_fetch_assoc($resQueryGetInfoDetails);
  $queryGetUserDetails = "SELECT * FROM Usuario WHERE id =".$_SESSION['userId'];

  $resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or trigger_error("User data couldn't be obtained");

  // Hacemos un fetch para extraer los datos del usuario y poder manipularlos
  $userDetails = mysql_fetch_assoc($resQueryGetUserDetails);

  if(isset($_POST['sent'])) {

    echo "string";

  if(!isset($error)) {

  //hash de datos

    // Definir el query a ejecutar
    $queryAdd = sprintf("INSERT INTO favoritos (idusuario, idevento) VALUES ('%s', '%s')",
      
      mysql_real_escape_string(trim($userDetails['id'])),
      mysql_real_escape_string(trim($infoDetails['id']))
    );

    // Ejecutamos el query
    $resQueryAdd = mysql_query($queryAdd, $conexionLocalhost) or die("We're sorry but the query for registering new users wasn't executed");  
  }

}
}
else {
  header("Location: busqueda.php?error=3");
} 

?>