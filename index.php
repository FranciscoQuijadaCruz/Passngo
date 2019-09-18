<?php
  if(!isset($_SESSION)) {
  session_start();}

  include('conexion/conexionLocalhost.php');
  include('includes/codigoComun.php');


// Obtenemos todos los usuarios de la base de datos
$queryGetComentario = "SELECT id, correo, nombre, comentario, rating FROM comentarios";

// Ejecutamos el query
$resQueryGetComentario = mysql_query($queryGetComentario, $conexionLocalhost) or trigger_error("The query for obtaining all events couldn't be executed.");

// Extraemos del recordset los datos del primer registro
$comentarioDetail = mysql_fetch_assoc($resQueryGetComentario);

// Obtenemos el total de usuarios encontrados
$totalComentario = mysql_num_rows($resQueryGetComentario);

?>


<!DOCTYPE html>
<html lang="en">
  <script src="js/jquery-3.3.1.min.js" ></script>

<head>
  <link rel="stylesheet" type="text/css" href="css_main.css">

  <meta charset="UTF-8">
  <title>Pass 'N Go</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kanit:800" rel="stylesheet"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />

</head>
<body id="index">
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');
?>


<div class="carousel-wrapper">
  <span id="itemS-1"></span>
  <span id="itemS-2"></span>
  <span id="itemS-3"></span>
  <span id="itemS-4"></span>
  <span id="itemS-5"></span>
  <span id="itemS-6"></span>
  <div class="carousel-item itemS-1">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> EVENTOS FAVORITOS</p>
    <img src="imgs/logo.png" class="imglogolanding" title="Pass N Go">
    <a class="arrow arrow-prev" href="#itemS-6" title="Anterior imagen"></a>
    <a class="arrow arrow-next" href="#itemS-2" title="Siguiente imagen"></a>
</div>
  
  <div class="carousel-item itemS-2">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> DEPORTES FAVORITOS</p>
    <img src="imgs/logo.png" class="imglogolanding">
    <a class="arrow arrow-prev" href="#itemS-1"></a>
    <a class="arrow arrow-next" href="#itemS-3"></a>
  </div>
  
  <div class="carousel-item itemS-3">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> OBRAS FAVORITAS</p>
    <img src="imgs/logo.png" class="imglogolanding">
    <a class="arrow arrow-prev" href="#itemS-2"></a>
    <a class="arrow arrow-next" href="#itemS-4"></a>
  </div>

  <div class="carousel-item itemS-4">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> CIRCOS FAVORITOS</p>
    <img src="imgs/logo.png" class="imglogolanding">
    <a class="arrow arrow-prev" href="#itemS-3"></a>
    <a class="arrow arrow-next" href="#itemS-5"></a>
  </div>

  <div class="carousel-item itemS-5">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> BAILES FAVORITOS</p>
    <img src="imgs/logo.png" class="imglogolanding">
    <a class="arrow arrow-prev" href="#itemS-4"></a>
    <a class="arrow arrow-next" href="#itemS-6"></a>
  </div>

  <div class="carousel-item itemS-6">
    <p class="textolanding">DISFRUTA LA EXPERIENCIA DE TUS <br> CONCIERTOS FAVORITOS</p>
    <img src="imgs/logo.png" class="imglogolanding">
    <a class="arrow arrow-prev" href="#itemS-5"></a>
    <a class="arrow arrow-next" href="#itemS-1"></a>
  </div>
</div>

<div href="#commentsFromUsers">
<br>
<h1 id="h1Comentarios">Comentarios de usuarios</h1><br>
<!--Slider-->
  <div class="slider">
    <ul>
    <?php
    do { ?>
      <li>
        <h2 ><center><?php echo $comentarioDetail['nombre']?></center></h2><br><br>
        <img src="imgs/avatar-user-business-man.png"><br><br>
        <?php  
          if($comentarioDetail['rating'] == 1 ) {?> <p id="validarNegativo"><?php echo "NEGATIVO";?><img id="iconoPositivo" src="imgs/icono_negativo.png"></p> <?php }
            else if($comentarioDetail['rating'] == 2 || $comentarioDetail['rating'] == 3) {?> <p id="validarRegular"><?php echo "REGULAR"; ?><img id="iconoPositivo" src="imgs/icono_regular.png"></p> <?php }
              else if($comentarioDetail['rating'] == 4 || $comentarioDetail['rating'] == 5) {?> <p id="validarPositivo"><?php echo "POSITIVO"; ?><img id="iconoPositivo" src="imgs/icono_positivo.png"></p> <?php }
        ?>
         <p><label id="calificacion"><?php echo $comentarioDetail['rating']?></label>/5</p>
         <p><?php echo $comentarioDetail['comentario']?></p>
      </li>
    <?php } while($comentarioDetail = mysql_fetch_assoc($resQueryGetComentario)); ?>
    </ul>
    
  </div>
  <script>
    var total = 0;
    var restar = false;
    $(document).ready(function(){
      total = $('.slider ul li');
      total = parseFloat(total.length / 3);
      $('.slider ul').css({'width':(total*100)+'%'});
      $('.slider ul li').css({'width':((total*30))+'%'});
      slide(0,false);
    });

    function slide(step,signo){
      $( '.slider ul' ).animate({
          marginLeft: "-"+(step*100)+"%"
        }, 1500 );

      console.log(step*100);

      if(signo == true){
        step -=1;
      }else{
        step +=1;
      }
      setTimeout(function(){
        
        if(step == parseFloat(total).toFixed(0)){
          restar = true;
        }

        if(step == 0){
          restar = false;;
        }
        slide(step,restar);
      },4500);
    }


  </script>
<!--fin Slider--></div>


</body>
  <?php
  include('includes/footer.php');
  ?>
</html>