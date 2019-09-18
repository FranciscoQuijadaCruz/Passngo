<?php 

if(!isset($_SESSION)) {
  session_start();
}
include('../conexion/conexionLocalhost.php');
if(isset($_SESSION['userId'])){

  if(isset($_GET['favoritoAdd'])){

      $queryAddVenta = sprintf("INSERT INTO favoritos (idEvento, idUsuario) VALUES (%d, %d)",
        
        mysql_real_escape_string(trim($_GET['idEvento'])),
        mysql_real_escape_string(trim($_SESSION['userId']))
      );

      // Ejecutamos el query
      $resQueryAddVenta = mysql_query($queryAddVenta, $conexionLocalhost) or die('Error updating database: ' . mysql_error());


      echo $resQueryAddVenta;

  }

  if(isset($_GET['favoritoDel'])){

      $queryAddVenta = sprintf("DELETE FROM  favoritos WHERE idEvento=%d AND idUsuario = %d",        
        mysql_real_escape_string(trim($_GET['idEvento'])),
        mysql_real_escape_string(trim($_SESSION['userId']))
      );

      // Ejecutamos el query
      $resQueryAddVenta = mysql_query($queryAddVenta, $conexionLocalhost) or die('Error updating database: ' . mysql_error());
      echo $resQueryAddVenta;
        
  }
}else{
  echo 'false';
}

 ?>