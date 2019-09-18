<?php
  include('includes/header.php');
  include('includes/useroptions.php');
  include('includes/categoriesbar.php');
  include('includes/eventsnav.php');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>Pass 'N Go - Control Panel User</title>
   <link rel="stylesheet" type="text/css" href="css_main.css">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />
</head>

<body>

	<div class="col-sm-3"></div>
	<div class="col-sm-3">
		<div class="cpaneluser">
			<img src="AdminElon.jpg" id="userimg">
		</div>
	</div>

	<div class="col-sm-6">
		<div class="cpanelusertitulo">
			<h1>Bienvenido "Usuario"</h1>
		</div>
	</div>
	<div class="actionlistuser">
	<ul class="ulactionlistuser">
		<li class="liactionlistuser">
			<a href="#">MIS EVENTOS</a>
		</li>
		<li class="liactionlistuser">
			<a href="#">MODIFICAR PERFIL</a>
		</li>
		<li class="liactionlistuser">
			<a href="#">LISTA DE DESEADOS</a>
		</li>
		<li class="liactionlistuser">
			<a href="#">MÉTODO DE PAGO</a>
		</li>
	</ul>	
	</div>

 		<?php
  		include('includes/footer.php');
  		?>
 </body>
 </html>