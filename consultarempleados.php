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
   <title>Pass 'N Go - Gestión de Empleados</title>
   <link rel="stylesheet" type="text/css" href="css_main.css">
  <meta charset="UTF-8">
  <title>Pass 'N Go</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link rel="icon" type="image/png" href="imgs/favicon.ico" /> 
</head>

<body>


  
  <div class="saludoadmin">
<div class="col-sm-3"></div>
  <div class="col-sm-3">
    <div class="cpaneladmin">
      <img src="AdminElon.jpg" id="adminimg">
    </div>
  </div>

  <div class="col-sm-6">
    <div class="cpaneladmintitulo">
      <h1>Bienvenido "Administrador"</h1>
    </div>
  </div>
</div>
  <div class="tarjetas">
                <div class="tarjeta" id="tarjeta1">
                    <h4>Empleado</h4>
                    <img src="img/spiderman.png" alt=""/>
                    <div class="row"><h5 style="text-align: right; float: left;">Genero:</h5><h6 style="text-align: right; float: left;">Masculino</h6></div>
                    <div class="row1"><h5 style="text-align: right; float: left;">Edad:</h5><h6 style="text-align: right; float: left;">16 años</h6></div>
                    <a href="https://es.wikipedia.org/wiki/Spider-Man" class="submit" name="submit" style='width:200px; height:40px'>Ver mas...</a>
                </div>

                <div class="tarjeta" id="tarjeta2">
                    <h4>Empleado2</h4>
                    <img src="img/spiderman.png" alt=""/>
                    <div class="row"><h5 style="text-align: right; float: left;">Genero:</h5><h6 style="text-align: right; float: left;">Masculino</h6></div>
                    <div class="row1"><h5 style="text-align: right; float: left;">Edad:</h5><h6 style="text-align: right; float: left;">16 años</h6></div>
                    <a href="https://es.wikipedia.org/wiki/Spider-Man" class="submit" name="submit" style='width:200px; height:40px'>Ver mas...</a>
                </div>
              </div>

<?php
      include('includes/footer.php');
      ?>

 </body>
      
 </html>