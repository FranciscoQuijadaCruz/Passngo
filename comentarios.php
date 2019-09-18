<?php
  if(!isset($_SESSION)) {
  session_start();
}

  include('conexion/conexionLocalhost.php');
  include('includes/codigoComun.php');

// Evaluamos que el formulario ha sido enviado
if(isset($_POST['sent'])) {

   // Verificamos si existen campos vacios
  foreach ($_POST as $indice => $valor) {
    if($valor == ""){$error[] = "El campo $indice esta vacío.";} 
  }


  // Solamente ejecutar la transacción en la base de datos cuando estamos libre de errores
  if(!isset($error)) {

    // Definir el query a ejecutar
    $queryAddComentario = sprintf("INSERT INTO comentarios (correo, nombre, comentario, rating) VALUES ('%s', '%s', '%s', '%d')",
      mysql_real_escape_string(trim($_POST['correo'])),
      mysql_real_escape_string(trim($_POST['nombre'])),
      mysql_real_escape_string(trim($_POST['comentario'])),
      mysql_real_escape_string(trim($_POST['rating']))
    );

    // Ejecutamos el query
    $resQueryAddComentario = mysql_query($queryAddComentario, $conexionLocalhost) or die("El query para guardar el usuario no se ejecutó");


    // Si todo salio bien, redirigimos al usuario al panel de control
    if($resQueryAddComentario) {
      header("Location: index.php?#commentsFromUsers");
    }
  }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css_main.css">
	<meta charset="UTF-8">
	<title>Pass 'N Go</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kanit:800" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />

</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
?>


<h1 id="tituloagradecer">GRACIAS POR SU COMPRA</h1>

<div class="bodycomments">

<label id="parrafocomments">Se ha procesado su compra, recibirá un correo electrónico con la información detallada.<br>
Pass N Go le agradece su preferencia.</label>


<h3>Nos gustaría saber su opinión acerca de nuestro servicio:</h3>
<form action="comentarios.php" method="post" id="margencomments">

  <fieldset>
    <span class="star-cb-group">
      <input type="radio" style="visibility:hidden;" id="rating-5" name="rating" value="5" checked="checked"/><label for="rating-5"></label>
      <input type="radio" style="visibility:hidden;" id="rating-4" name="rating" value="4" /><label for="rating-4"></label>
      <input type="radio" style="visibility:hidden;" id="rating-3" name="rating" value="3" /><label for="rating-3"></label>
      <input type="radio" style="visibility:hidden;" id="rating-2" name="rating" value="2" /><label for="rating-2"></label>
      <input type="radio" style="visibility:hidden;" id="rating-1" name="rating" value="1" /><label for="rating-1"></label>
      
    </span>
  </fieldset>

      <?php if(isset($error)) printMsg($error,"error"); ?>

        <label for="correo" class="verdana">Correo:</label><br>
                <input type="text" name="correo" placeholder="ejemplo@gmail.com"><br>

        <label for="nombre" class="verdana">Nombre:</label><br>
                <input type="text" name="nombre" placeholder="MiNombre"><br>

        <label for="comentario" class="verdana">Comentario:</label><br>
                <textarea name="comentario" class="verdana" placeholder="Ingrese su comentario"></textarea>

        <br>

        
        <input type="submit" class="botoncomments" value="Enviar" name="sent">

      </form>
    </div>
    <br>



</body>
	<?php
	include('includes/footer.php');
	?>

  <script type="text/javascript">
  var logID = 'log',
  log = $('<div id="'+logID+'"></div>');
$('body').append(log);
  $('[type*="radio"]').change(function () {
    var me = $(this);
    log.html(me.attr('value'));
  });
</script>
</html>


<?php
  if(isset($resQueryAddComment)) mysql_free_result($resQueryAddComment);
?>