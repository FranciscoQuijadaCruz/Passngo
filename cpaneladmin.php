 <?php
	if(!isset($_SESSION)) {
  	session_start();
  	if(!isset($_SESSION['userId'])) header("Location: login.php?error=1");
	}

  include('conexion/conexionLocalhost.php');
  include('includes/codigoComun.php');

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <link rel="stylesheet" type="text/css" href="css_main.css">
  <meta charset="UTF-8">
  <title>Pass 'N Go - Panel del usuario <?php echo (isset($_SESSION['userFullname'])) ? $_SESSION['userFullname'] : '<a href="login.php">Login</a>'; ?> </title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
</head>

<body>

<body>
	<?php
  include('includes/header.php');
  include('includes/useroptions.php');
  include('includes/categoriesbar.php');
  include('includes/eventsnav.php');
 ?>
	<div class="col-sm-3"></div>
	<div class="col-sm-3">
		<div class="cpaneladmin">
			<img src="AdminElon.jpg" id="adminimg">
		</div>
	</div>

	<div class="col-sm-6">
		<div class="cpaneladmintitulo">
			<h1>Bienvenido <?php echo (isset($_SESSION['userFullname'])) ? "<strong>".$_SESSION['userFullname']."</strong>" : '<a href="login.php">Login</a>'; ?></h1>
			<?php 
   			 if(isset($_GET['registerUser'])) printMsg("Se ha registrado el usuario con éxito.","exito");
    		 if(isset($_GET['updatedUser'])) printMsg("Se ha actualizado el usuario con éxito.","exito");
    		 if(isset($_GET['deletedUser'])) printMsg("Se ha eliminado el usuario con éxito.","exito");
   			 if(isset($_GET['registerEvent'])) printMsg("Se ha registrado el evento con éxito.","exito");
    		 if(isset($_GET['updatedEvent'])) printMsg("Se ha actualizado el evento con éxito.","exito");
    		 if(isset($_GET['deletedEvent'])) printMsg("Se ha eliminado el evento con éxito.","exito");
    		 if(isset($_GET['paperUser'])) printMsg("Se ha enviado el elemento a la papelera.","exito");
    		 if(isset($_GET['restauredUser'])) printMsg("Se ha restaurado el usuario con éxito.","exito");
    		 if(isset($_GET['paperEvent'])) printMsg("Se ha enviado el elemento a la papelera.","exito");
    		 if(isset($_GET['restauredEvent'])) printMsg("Se ha restaurado el usuario con éxito.","exito");
    		 if(isset($_GET['error']) && $_GET['error'] == "2") printMsg("Solo usuarios normales pueden ver y tener favoritos.","announce");
  			?>
		</div>
	</div>
	<div class="actionlist">
	<ul class="ulactionlist">
		<li class="liactionlist">
			<a href="update_account.php">ACTUALIZAR PERFIL</a>
		</li>
		<?php if($_SESSION['userLevel'] == "agent") { ?>
		<li class="liactionlist">
			<a href="favoritos_user.php">VER FAVORITOS</a>
		</li>
		<?php } ?>
		<?php if($_SESSION['userLevel'] == "admin") { ?>
		<li class="liactionlist">
			<a href="accounts_admin.php">ADMINISTRAR USUARIOS</a>
		</li>
		<li class="liactionlist">
			<a href="ventas.php">VENTAS</a>
		</li>
		<li class="liactionlist">
			<a href="agregarevento.php">AÑADIR EVENTO</a>
		</li>
		<li class="liactionlist">
			<a href="consulta_eventos.php">ADMINISTRAR EVENTOS</a>
		</li>
		<li class="liactionlist">
			<a href="consulta_comentarios.php">CONSULTAR COMENTARIOS</a>
		</li>
		<li class="liactionlist">
			<a href="admin_usuariospap.php">PAPELERA USUARIOS</a>
		</li>
		<li class="liactionlist">
			<a href="consulta_eventospap.php">PAPELERA EVENTOS</a>
		</li>
		<?php } ?>
	</ul>	
	</div>

 		<?php
  		include('includes/footer.php');
  		?>
 </body>
 </body>
 </html>