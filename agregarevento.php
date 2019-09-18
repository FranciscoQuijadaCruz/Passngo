<?php
  if(!isset($_SESSION)) {
    session_start();
    if(!isset($_SESSION['userId'])) header("Location: login.php?error=1");
  }

    include('conexion/conexionLocalhost.php');
    include('includes/codigoComun.php');

 // Evaluamos que el formulario ha sido enviado
if(isset($_POST['sent'])) {

    // Validación campo nombre evento.
    if(preg_match('/^\s*$/', $_POST['nombre'])) {
        $error[] = "El campo nombre del evento esta vacio.";
    }else if(!preg_match("/^[a-zA-Z äáàëéèíìöóòúùñçÄÁÀËÉÈÍÌÖÓÒÚÙÑÇ]+$/i", $_POST['nombre']))
    {
      $error[] = "El campo nombre del evento solo acepta letras.";
    } 

    // Validación campo localidad
    if(preg_match('/^\s*$/', $_POST['localidad'])) {
        $error[] = "El campo localidad esta vacio.";
    }else if(!preg_match("/^([a-zA-Z0-9 \._-äáàëéèíìöóòúùñç])+([,])+([[:space:]])+([A-Z{3}])+$/i", $_POST['localidad']))
    {
      $error[] = "Los datos no cumple con la estructura de la ciudad y estado.";
    }

    // Validación campo imagen
    if(preg_match('/^\s*$/', $_POST['imagen'])) {
        $error[] = "El campo imagen esta vacio.";
    }else if(!preg_match("~[a-z]+://\S+~i", $_POST['imagen']))
    {
      $error[] = "Los datos no cumple con la estructura de un link.";
    }

    //Verificamos si acepta solo números (Boletaje).
    if(preg_match('/^\s*$/', $_POST['numBoletos'])) {
        $error[] = "El campo numBoletos esta vacio.";
    }else if(!preg_match("/^[0-9]+$/i", $_POST['numBoletos']))
    {
      $error[] = "El campo boletaje solo acepta números.";
    } 

    //Verificamos si acepta solo números (Precio General).
    if(preg_match('/^\s*$/', $_POST['precio'])) {
      $error[] = "El campo precio general esta vacio.";
    }else if(!preg_match("/^[1-9]\d*(\.\d+)?$/", $_POST['precio']))
    {
      $error[] = "El campo precio general solo acepta números.";
    } 

    //Verificamos si acepta solo números (Precio VIP).
    if(preg_match('/^\s*$/', $_POST['precioVip'])) {
      $error[] = "El campo precio Vip esta vacio.";
    }else if(!preg_match("/^[1-9]\d*(\.\d+)?$/", $_POST['precioVip']))
    {
      $error[] = "El campo precio Vip solo acepta números.";
    } 

    //Verificamos si acepta solo números (Precio General).
    if(preg_match('/^\s*$/', $_POST['latitud'])) {
      $error[] = "El campo latitud esta vacio.";
    }

    //Verificamos si acepta solo números (Precio VIP).
    if(preg_match('/^\s*$/', $_POST['longitud'])) {
      $error[] = "El campo longitud esta vacio.";
    }

      // Verificamos que sea seleccionado la categoría.
    if($_POST['categoria'] == "Seleccione una categoría de evento") {
      $error[] = "No has seleccionado la categoría.";
    }

      // Verificamos que sea seleccionado el tipo.
    if($_POST['tipo'] == "Seleccione un tipo de evento") {
      $error[] = "No has seleccionado el tipo.";
    }

    // Definir el query para buscar nombre de evento en la base de datos
    $queryValidateEmail = sprintf("SELECT id FROM evento WHERE nombre = '%s'",
      mysql_real_escape_string(trim($_POST['nombre']))
    );

    // Ejecutar el query
    $resQueryValidateEmail = mysql_query($queryValidateEmail, $conexionLocalhost) or die("El query para buscar el email no se ejecutó");

    // Definir el query para buscar nombre de evento en la base de datos
    $queryValidateEmailP = sprintf("SELECT id FROM papeleraevento WHERE nombre = '%s'",
      mysql_real_escape_string(trim($_POST['nombre']))
    );

    // Ejecutar el query
    $resQueryValidateEmailP = mysql_query($queryValidateEmailP, $conexionLocalhost) or die("El query para buscar el email no se ejecutó");

    // Contamos el numero de registros que devuelve la consulta y en caso de existir un registro generamos un error de email utilizado
    if(mysql_num_rows($resQueryValidateEmail)) {
        $error[] = "Ya existe un evento con este nombre.";
    }elseif(mysql_num_rows($resQueryValidateEmailP)) $error[] = "Existe un evento con un mismo nombre en papelera, favor de revisar si es necesario.";


  // Solamente ejecutar la transacción en la base de datos cuando estamos libre de errores
  if(!isset($error)) {

    // Definir el query a ejecutar
    $queryAddEvento = sprintf("INSERT INTO evento (nombre, categoria, tipo, artistaOGrupo, fecha, hora, lugar, localidad, descripcion, imagen, numBoletos, precio, precioVip, latitud, longitud) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
      mysql_real_escape_string(trim($_POST['nombre'])),
      mysql_real_escape_string(trim($_POST['categoria'])),
      mysql_real_escape_string(trim($_POST['tipo'])),
      mysql_real_escape_string(trim($_POST['artistaOGrupo'])),
      mysql_real_escape_string(trim($_POST['fecha'])),
      mysql_real_escape_string(trim($_POST['hora'])),
      mysql_real_escape_string(trim($_POST['lugar'])),
      mysql_real_escape_string(trim($_POST['localidad'])),
      mysql_real_escape_string(trim($_POST['descripcion'])),
      mysql_real_escape_string(trim($_POST['imagen'])),
      mysql_real_escape_string(trim($_POST['numBoletos'])),
      mysql_real_escape_string(trim($_POST['precio'])),
      mysql_real_escape_string(trim($_POST['precioVip'])),
      mysql_real_escape_string(trim($_POST['latitud'])),
      mysql_real_escape_string(trim($_POST['longitud']))
    );


    // Ejecutamos el query
    $resQueryAddEvento = mysql_query($queryAddEvento, $conexionLocalhost) or die("We're sorry but the query for registering new users wasn't executed");
   
    // Si todo salio bien, redirigimos al evento al panel de control
    if($resQueryAddEvento) {
      header("Location: cpaneladmin.php?registerEvent=true");
    }
  }
}

?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Pass 'N Go - Agregar evento.</title>
   <link rel="stylesheet" type="text/css" href="css_main.css">
  <meta charset="UTF-8">
  <title>Pass 'N Go</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
 </head>
 <body>
  <?php
  include('includes/header.php');
  include('includes/useroptions.php');
  include('includes/categoriesbar.php');
  include('includes/eventsnav.php');
 ?>
   <section class="addemp">
    <form action="agregarevento.php" method="post" class="margenregistro">
    <?php if(isset($error)) printMsg($error,"error"); ?>
        <h1 class="addemp">Añadir Evento</h1>

        <label for="nombre" class="verdana">Nombre del evento:</label><br>
                <input type="text" name="nombre" placeholder="Ingrese el nombre del evento"><br>

        <label for="categoria">Categoría de evento:</label><br>
        <select name="categoria" id="categoria">
            <option default value="Seleccione una categoría de evento"  class="genero">Seleccione una categoría de evento</option>
            <option value="Conciertos">Conciertos</option>
            <option value="Deportes">Deportes</option>
            <option value="Popular">Popular</option>
            <option value="Teatro">Teatro</option>
            <option value="Especial">Especial</option>
        </select> <br>
        <br>

        <label for="tipo">Tipo de evento:</label><br>
        <select name="tipo" id="tipo">
            <option default value="Seleccione un tipo de evento"  class="genero">Seleccione un tipo de evento</option>
            <option value="Electronica">Electronica</option>
            <option value="Rock/Metal">Rock/metal</option>
            <option value="Musica regional">Musica regional</option>
            <option value="Festivales">Festivales</option>
            <option value="Pop">Pop</option>
            <option value="Expo regionales">Expo regionales</option>
            <option value="Ferias">Ferias</option>
            <option value="Palenques">Palenques</option>
            <option value="Teatro">Teatro</option>
            <option value="Football">Football</option>
            <option value="Baseball" >Baseball</option>
            <option value="Basketball">Basketball</option>
            <option value="Circos">Circos</option>
            <option value="Musicales">Musicales</option>
        </select> <br>
        <br>

        <label for="artistaOGrupo" class="verdana">Artista/Grupo:</label><br>
                <input type="text" name="artistaOGrupo" placeholder="Ingrese el nombre del artista o grupo"><br><br>
        
        <label for="fecha" class="verdana">Fecha del evento:</label><br>
                <input type="date" name="fecha" class="fecha" placeholder="Ingrese la fecha del evento"><br><br>

        <label for="hora" class="verdana">Hora del evento:</label><br>
                <input type="time" name="hora" class="hora" placeholder="Ingrese la hora del evento"><br><br> 

        <label for="lugar" class="verdana">Lugar del evento:</label><br>
                <input type="text" name="lugar" placeholder="Ingrese el lugar del evento"><br>

        <label for="localidad" class="verdana">Ciudad y estado:</label><br>
                <input type="text" name="localidad" placeholder="EJ: Hermosillo, SON"><br>

        <label for="descripcion" class="verdana">Descripción:</label><br>
                <input type="text" name="descripcion" placeholder="Ingrese la descripción del evento"><br>

        <label for="imagen" class="verdana">Imagen:</label><br>
                <input type="text" name="imagen" placeholder="Inserte un enlace http"><br>

        <label for="numBoletos" class="verdana">Boletaje:</label><br>
                <input type="text" name="numBoletos" placeholder="Ingrese el número de boletos"><br><br>

        <label for="precio" class="verdana">Precio General:</label><br>
                <input type="text" name="precio" placeholder="Ingrese el precio general"><br>

        <label for="precioVip" class="verdana">Precio Vip:</label><br>
                <input type="text" name="precioVip" placeholder="Ingrese el precio de los boletos vip"><br><br>

        <label for="latitud" class="verdana">Latitud:</label><br>
                <input type="text" name="latitud" placeholder="Ingrese la latitud del evento"><br>

        <label for="longitud" class="verdana">Longitud:</label><br>
                <input type="text" name="longitud" placeholder="Ingrese la longitud del evento"><br>

        <input type="submit" class="boton" value="Registrar" name="sent" />
     
</form>
     
    
</section> 

 </body>
 <?php
  include('includes/footer.php');
  ?>
 </html>
<?php
  if(isset($resQueryAddEvento)) mysql_free_result($resQueryAddEvento);
?>
 