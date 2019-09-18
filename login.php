<?php
  if(!isset($_SESSION)) {
  session_start();
  if(isset($_SESSION['userId'])) header("Location: cpaneladmin.php");
}
  include('conexion/conexionLocalhost.php');
  include('includes/codigoComun.php');

  // Evaluamos si el formulario ha sido enviado
  if(isset($_POST['sent'])) {

  //Validacion email.  
  if(preg_match('/^\s*$/', $_POST['email'])) {
    $error[] = "El campo email esta vacio.";
  }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/i", $_POST['email']))
  {
    $error[] = "Los datos no cumple con la estructura de un correo electronico.";
  } 

  

  //Validacion password.
    $mayus = preg_match('@[A-Z]@', $_POST['contrasenia']);
    $minus = preg_match('@[a-z]@', $_POST['contrasenia']);
    $numero    = preg_match('@[0-9]@', $_POST['contrasenia']);
    if(preg_match('/^\s*$/', $_POST['contrasenia'])) {
      $error[] = "El campo password esta vacio.";
    }
    else if(!$mayus || !$minus || !$numero || strlen($_POST['contrasenia']) < 8) {
      $error[] = "La contraseña no cumple con las características mencionadas.";
    }


    // Si no hay error, procedemos a definir el query y ejecutarlo
  if(!isset($error)) {
  
    $queryValidateUser = sprintf("SELECT id, email, password, nombre, apellidos, estado, rol FROM usuario WHERE email = '%s'",

        mysql_real_escape_string(trim($_POST['email']))
    );



    // Ejecutar el query
    $resQueryValidateUser = mysql_query($queryValidateUser, $conexionLocalhost) or die("The query for validating the user couldn't be executed");

    // Contamos los resultados obtenidos, 0 = no hay registro que cumpla con los criterios email y ó password; 1 = se encontró unj registro que satisface ambos criterios
    if(mysql_num_rows($resQueryValidateUser)) {
      $userData = mysql_fetch_assoc($resQueryValidateUser);

      $password = htmlentities(addslashes($_POST['contrasenia']));

        if(password_verify($password, $userData['password'])){

        $_SESSION['userId'] = $userData['id'];
        $_SESSION['userEmail'] = $userData['email'];
        $_SESSION['userFullname'] = $userData['nombre']." ".$userData['apellidos'];
        $_SESSION['userEstado'] = $userData['estado'];
        $_SESSION['userLevel'] = $userData['rol'];
        header("Location: cpaneladmin.php?login=true");
      }
    }
    else {
      $error[] = "Los datos de usuario y contraseña no existen o no coinciden... intentalo de nuevo.";
    }
  }
}
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Pass 'N Go - Log In</title>
   <link rel="stylesheet" type="text/css" href="css_main.css">
   <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
    <link rel="icon" type="image/png" href="imgs/favicon.ico" />
 </head>
 <body>

    <?php
    include('includes/header.php');
    include('includes/useroptions.php');
    include('includes/categoriesbar.php');
    ?>

   <div class="containeriniciar">
    
    <div class="margen">
      <?php if(isset($error)) printMsg($error,"error"); ?>
      </div>
    
    
     <form action="login.php" method="post" class="margenlogin">


      <?php 
         if(isset($_GET['registerUser'])) printMsg("Se ha registrado el usuario con éxito.","exito");
         if(isset($_GET['error']) && $_GET['error'] == "2") printMsg("You can't access this resource without logging in first or without the required privileges.","announce");
      ?>

     <h1 class="iniciosesion">Iniciar Sesión</h1>

        <label for="email" class="verdana">Correo:</label><br>
                <input type="text" name="email" placeholder="ejemplo@gmail.com"><br>

        <label for="password" class="verdana">Contraseña:</label><br>
                <input type="password" name="contrasenia" placeholder="•••••••••••••••"><br>

        
        <input type="submit" class="boton" name="sent" value="Entrar" >
      </form>
      
      <hr id="linealogin">
      
      <form action="signin.php" class="registro"><br>
        <label for="registrar" class="registrarsetext">Si aun no te registras</label>
        <br>
        <input  class="btnRegistro" type="submit" value="Registrarse" />

      </form>
    
</div> 

 <?php
  include('includes/footer.php');
  ?>
 </body>
 </html>
 <?php
    if(isset($resQueryValidateUser)) mysql_free_result($resQueryValidateUser);
  ?>