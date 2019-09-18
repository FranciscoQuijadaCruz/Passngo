<?php
if(!isset($_SESSION)) {
  session_start();
  if(!isset($_SESSION['userId']) || $_SESSION['userLevel'] != "admin") header("Location: cpaneladmin.php?error=2");
}

include('conexion/conexionLocalhost.php');
include('includes/codigoComun.php');

if(isset($_GET['userId']) && is_numeric($_GET['userId'])) {
  // Obtenemos todos los datos del usuario loggeado
  $queryGetEventDetails = sprintf("SELECT * FROM evento WHERE id = %d",
    mysql_real_escape_string(trim($_GET['userId']))
  );

  $resQueryGetEventDetails = mysql_query($queryGetEventDetails, $conexionLocalhost) or trigger_error("User data couldn't be obtained");

  // Evaluo si obtuve resultados con la consulta
  if(mysql_num_rows($resQueryGetEventDetails) == 0) ;

  // Hacemos un fetch para extraer los datos del usuario y poder manipularlos
  $userDetails = mysql_fetch_assoc($resQueryGetEventDetails);
}
else {
  header("Location: consulta_eventos.php?error=3");
} 

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
    }else if(!preg_match("/^[1-9]\d*(\.\d+)?$/", $_POST['latitud']))
    {
      $error[] = "El campo latitud solo acepta números.";
    } 

    //Verificamos si acepta solo números (Precio VIP).
    if(preg_match('/^\s*$/', $_POST['longitud'])) {
      $error[] = "El campo longitud esta vacio.";
    }else if(!preg_match("/^[-][1-9]\d*(\.\d+)?$/", $_POST['longitud']))
    {
      $error[] = "El campo longitud solo acepta números.";
    } 

  // Solamente ejecutar la transacción en la base de datos cuando estamos libre de errores
  if(!isset($error)) {

    // Definir el query a ejecutar
    $queryUserEdit = sprintf("UPDATE evento SET nombre = '%s', tipo = '%s', artistaOGrupo = '%s', fecha = '%s', hora = '%s', lugar = '%s', localidad = '%s', descripcion = '%s', imagen = '%s', numBoletos = '%s', precio = '%s', precioVip = '%s', latitud = '%s', longitud = '%s'  WHERE id = %d",
      mysql_real_escape_string(trim($_POST['nombre'])),
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
      mysql_real_escape_string(trim($_POST['longitud'])),
      $_POST['id']
    );

    // Ejecutamos el query
    $resQueryUserEdit = mysql_query($queryUserEdit, $conexionLocalhost) or die("We're sorry but the query for updating user data wasn't executed");

    // Si todo salio bien, redirigimos al usuario al panel de control
    if($resQueryUserEdit) {
      header("Location: cpaneladmin.php?updatedEvent=true");
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
  <title>Pass 'N Go - Editar evento</title>
</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
include('includes/eventsnav.php');
?>
<div class="">
    <form action="edit_events.php?userId=<?php echo $userDetails['id'];?>" method="post" class="margen">
    <?php if(isset($error)) printMsg($error,"error"); ?>
    <div class="margeneditarcuentas">
        <h1 class="addemp">Editar Evento</h1>

        <label for="nombre" class="verdana">Nombre del evento:</label><br>
                <input type="text" name="nombre" value="<?php echo $userDetails['nombre']; ?>"><br>


        <label for="categoria">Categoría de evento:</label><br>
        <select name="categoria" id="categoria" value="<?php echo $userDetails['categoria']; ?>">
            <option value="Conciertos" <?php if($userDetails['categoria'] == "Conciertos") echo 'selected="selected"'; ?> >Conciertos</option>
            <option value="Deportes" <?php if($userDetails['categoria'] == "Deportes") echo 'selected="selected"'; ?> >Deportes</option>
            <option value="Popular" <?php if($userDetails['categoria'] == "Popular") echo 'selected="selected"'; ?> >Popular</option>
            <option value="Teatro" <?php if($userDetails['categoria'] == "Teatro") echo 'selected="selected"'; ?> >Teatro</option>
            <option value="Especial" <?php if($userDetails['categoria'] == "Especial") echo 'selected="selected"'; ?> >Especial</option>
        </select> <br>
        <br>

        <label for="tipo">Tipo de evento:</label>
        <select name="tipo" id="tipo" value="<?php echo $userDetails['tipo']; ?>">
            
            <option value="Electronica" <?php if($userDetails['tipo'] == "Electronica") echo 'selected="selected"'; ?> >Electronica</option>
            <option value="Rock/Metal" <?php if($userDetails['tipo'] == "Rock/Metal") echo 'selected="selected"'; ?> >Rock/metal</option>
            <option value="Musica regional" <?php if($userDetails['tipo'] == "Musica regional") echo 'selected="selected"'; ?> >Musica regional</option>
            <option value="Festivales" <?php if($userDetails['tipo'] == "Festivales") echo 'selected="selected"'; ?> >Festivales</option>
            <option value="Pop" <?php if($userDetails['tipo'] == "Pop") echo 'selected="selected"'; ?> >Pop</option>
            <option value="Expo regionales" <?php if($userDetails['tipo'] == "Expo regionales") echo 'selected="selected"'; ?> >Expo regionales</option>
            <option value="Ferias" <?php if($userDetails['tipo'] == "Ferias") echo 'selected="selected"'; ?> >Ferias</option>
            <option value="Palenques" <?php if($userDetails['tipo'] == "Palenques") echo 'selected="selected"'; ?> >Palenques</option>
            <option value="Teatro" <?php if($userDetails['tipo'] == "Teatro") echo 'selected="selected"'; ?> >Teatro</option>
            <option value="Football" <?php if($userDetails['tipo'] == "Football") echo 'selected="selected"'; ?> >Football</option>
            <option value="Baseball" <?php if($userDetails['tipo'] == "Baseball") echo 'selected="selected"'; ?> >Baseball</option>
            <option value="Basketball" <?php if($userDetails['tipo'] == "Basketball") echo 'selected="selected"'; ?> >Basketball</option>
            <option value="Circos" <?php if($userDetails['tipo'] == "Circos") echo 'selected="selected"'; ?> >Circos</option>
            <option value="Musicales" <?php if($userDetails['tipo'] == "Musicales") echo 'selected="selected"'; ?> >Musicales</option>
        </select> <br>
        <br>

        <label for="artistaOGrupo" class="verdana">Artista/Grupo:</label><br>
                <input type="text" name="artistaOGrupo" value="<?php echo $userDetails['artistaOGrupo']; ?>"><br><br>
        
        <label for="fecha" class="verdana">Fecha del evento:</label><br>
                <input type="date" name="fecha" class="fecha" value="<?php echo $userDetails['fecha']; ?>"><br><br>

        <label for="hora" class="verdana">Hora del evento:</label><br>
                <input type="time" name="hora" class="hora" value="<?php echo $userDetails['hora']; ?>"><br><br> 

        <label for="lugar" class="verdana">Lugar del evento:</label><br>
                <input type="text" name="lugar" value="<?php echo $userDetails['lugar']; ?>"><br>

        <label for="localidad" class="verdana">Ciudad y estado:</label><br>
                <input type="text" name="localidad" placeholder="EJ: Hermosillo, SON" value="<?php echo $userDetails['localidad']; ?>"><br>

        <label for="descripcion" class="verdana">Descripcion:</label><br>
                <input type="text" name="descripcion" value="<?php echo $userDetails['descripcion']; ?>"><br>

        <label for="imagen" class="verdana">Imagen:</label><br>
                <input type="text" name="imagen" value="<?php echo $userDetails['imagen']; ?>" ><br>

        <label for="numBoletos" class="verdana">Boletaje:</label><br>
                <input type="text" name="numBoletos" value="<?php echo $userDetails['numBoletos']; ?>"><br><br>

        <label for="precio" class="verdana">Precio General:</label><br>
                <input type="text" name="precio" value="<?php echo $userDetails['precio']; ?>" ><br>

        <label for="precioVip" class="verdana">Precio VIP:</label><br>
                <input type="text" name="precioVip" value="<?php echo $userDetails['precioVip']; ?>"><br>

        <label for="latitud" class="verdana">Latitud:</label><br>
                <input type="text" name="latitud" value="<?php echo $userDetails['latitud']; ?>" ><br>

        <label for="longitud" class="verdana">Longitud:</label><br>
                <input type="text" name="longitud" value="<?php echo $userDetails['longitud']; ?>"><br><br>


        <input type="hidden" name="id" value="<?php echo $userDetails['id']; ?>"/>
        <input type="submit" class="boton" value="Actualizar" name="sent" />

        </div>
     
</form>
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