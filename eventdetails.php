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

if(isset($_SESSION['userId'])){
  $queryFav = sprintf("SELECT * FROM favoritos WHERE idEvento = %d AND idUsuario = %d",
    mysql_real_escape_string(trim($_GET['eventId'])),
    mysql_real_escape_string(trim($_SESSION['userId']))

  );

  $resQueryGetFavs = mysql_query($queryFav, $conexionLocalhost) or trigger_error("User data couldn't be obtained");

  $Fav = mysql_fetch_assoc($resQueryGetFavs);

}
if(isset($_POST['sentCompra'])) {


  if(!isset($error)) {
    // Definir el query a ejecutar

    if($_POST['totalVip'] > 0 ){

      $queryAddVenta = sprintf("INSERT INTO ventas (idEvento, nombreCompleto, correo, total) VALUES (%d, '%s', '%s', '%s')",
        
        mysql_real_escape_string(trim($infoDetails['id'])),
        mysql_real_escape_string(trim($_POST['nombreCompleto'])),
        mysql_real_escape_string(trim($_POST['correo'])),
        mysql_real_escape_string(trim($_POST['totalVip']))
      );

      // Ejecutamos el query
      $resQueryAddVenta = mysql_query($queryAddVenta, $conexionLocalhost) or die('Error updating database: ' . mysql_error());  
    }

    if($_POST['total'] > 0 ){
      
      $queryAddVenta = sprintf("INSERT INTO ventas (idEvento, nombreCompleto, correo, total) VALUES (%d, '%s', '%s', '%s')",
        
        mysql_real_escape_string(trim($infoDetails['id'])),
        mysql_real_escape_string(trim($_POST['nombreCompleto'])),
        mysql_real_escape_string(trim($_POST['correo'])),
        mysql_real_escape_string(trim($_POST['total']))
      );

      // Ejecutamos el query
      $resQueryAddVenta = mysql_query($queryAddVenta, $conexionLocalhost) or die('Error updating database: ' . mysql_error());  
      if($resQueryAddVenta) {
      header("Location: comentarios.php");
    }
    }

  }

}  
}


else {
  header("Location: busqueda.php");
} 

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css_main.css">
	<meta charset="UTF-8">
	<title>Pass 'N Go - Detalles del evento "<?php echo $infoDetails['nombre']?>". </title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet">
  <link rel="stylesheet" href="includes/fav.css"> 
  <link rel="icon" type="image/png" href="imgs/favicon.ico" />

</head>
<body>
<?php
include('includes/header.php');
include('includes/useroptions.php');
include('includes/categoriesbar.php');

?>
<!--?php
  if(isset($_GET['addFavorite'])) printMsg("Se añadió a favoritos.","exito");
?-->
  <section class="eventdetail">
    <div>
      <div class="col-sm-2">
        <img id="imgeventdetail" for="imagen" src="<?php echo $infoDetails['imagen']; ?>" >
        <label for="nombre" id="lbtituloevento"><h1 name="nombre"><?php echo $infoDetails['nombre']?></h1></label>
        <label for="lugar" id="lblugar"><h3 class="lblugar"><?php echo $infoDetails['lugar']?></h3></label>
        <label for="localidad" id="lbciudad"><h3><?php echo $infoDetails['localidad']?></h3></label>
        <label for="fecha" id="lbfecha"><h4><?php echo $infoDetails['fecha']?></h4></label>
        <label for="hora" id="lbhora"><h4><?php echo $infoDetails['hora']?></h4></label>

        
      </div>
      <div class="bodystar">
        <?php if(isset($_SESSION['userId'])){ ?>
        <div class="Fav">
        <input id="fav-checkbox" class="Fav-checkbox" type="checkbox" onclick="favoritos()" <?php if(mysql_num_rows($resQueryGetFavs) > 0){echo 'checked=true';}  ?>>
        <label for="fav-checkbox" class="Fav-label"><span class="Fav-label-text">Favourite</span></label>
        <div class="Fav-bloom"></div>
        <div class="Fav-sparkle">
          <div class="Fav-sparkle-line"></div>
          <div class="Fav-sparkle-line"></div>
          <div class="Fav-sparkle-line"></div>
          <div class="Fav-sparkle-line"></div>
          <div class="Fav-sparkle-line"></div>
        </div>
        <svg class="Fav-star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
          <title>Star Icon</title>
          <path d="M36.14,3.09l5.42,17.78H59.66a4.39,4.39,0,0,1,2.62,7.87L47.48,40.14,53,58.3a4.34,4.34,0,0,1-6.77,4.78L32,52l-14.26,11A4.34,4.34,0,0,1,11,58.27l5.55-18.13L1.72,28.75a4.39,4.39,0,0,1,2.62-7.87h18.1L27.86,3.09A4.32,4.32,0,0,1,36.14,3.09Z"/>
        </svg>
      </div>
      <?php } ?>
      </div>
    </div>
    </div>
    </div>
  </section>
 <section class="eventdetail2">
    <div class="tab">
      <button class="tablinks active" onclick="openCity(event, 'tabdescripcion')">Descripción</button>
      <button class="tablinks" onclick="openCity(event, 'tabmapa')">Ubicación</button>
      <button class="tablinks" onclick="openCity(event, 'tabprecios')">Precios</button>
    </div>

    <div id="tabdescripcion" class="tabcontent" style="display: block;">
      <h3>Descripción <?php echo $infoDetails['nombre']?>.</h3>
      <p for="descripcion" id="pdescripcion"><?php echo $infoDetails['descripcion']?></p>
    </div>

    <div id="tabmapa" class="tabcontent">
      <h3>Ubicación <?php echo $infoDetails['lugar']?></h3>

      <div id="map"></div>
        <script>
          function initMap() {
            var uluru = {lat: <?php echo $infoDetails['latitud']?>, lng: <?php echo $infoDetails['longitud']?>};
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: uluru
            });
            var marker = new google.maps.Marker({
            position: uluru,
             map: map
            });
          }
        </script>
        <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Vl_Yu4qU1OBDdFn4xE7sbEvduvzlxCw&callback=initMap">
        </script>
    </div>


<div id="tabprecios" class="tabcontent">
      <h1>Precios</h1>
      <form action="eventdetails.php?eventId=<?php echo $infoDetails['id']; ?>" method="post">
       <!-- <input type="hidden" name="eventId" value="<?php echo $infoDetails['id']; ?>"/>-->
        <input type="hidden" name="id" value="<?php echo $infoDetails['id']; ?>"/>
        <input type="hidden" id="total" name="total" value="0" />
        <input type="hidden" id="totalVip" name="totalVip" value="0" />
        <table class="tblprecios">

          <tr>
            <td><label>INGRESA TUS DATOS:</label></td>
            <td><input type="text" name="nombreCompleto" placeholder="Nombre completo"></td>
            <td><input type="text" name="correo" placeholder="Correo electronico"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>BOLETO</th>
            <th>DETALLES</th>
           <th>CANTIDAD</th>
            <th>TOTAL A PAGAR</th>
            <td></td>
         </tr>
          <tr>
            <td>SESIÓN GENERAL</td>
            <td>BOLETO: GENERAL (PRECIO: $<?php echo $infoDetails['precio']?> MXN) </td>
            <td>
            <!--<form method="get" action="">-->
            <select onchange="calcularTotal(this.value,false)">
                <option value="0"> -- SELECCIONE LA CANTIDAD ---</option>
                <option value="1">1 Boletos</option>
                <option value="2">2 Boletos</option>
                <option value="3">3 Boletos</option>
                <option value="4">4 Boletos</option>
                <option value="5">5 Boletos</option>
                <option value="6">6 Boletos</option>
                <option value="7">7 Boletos</option>
                <option value="8">8 Boletos</option>
                <option value="9">9 Boletos</option>
                <option value="10">10 Boletos</option>
              </select>
             <!--</form> -->
            </td>
            <td>
              <label id="Label1">00.00</label> MXN
            </td>
            <td>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
       <!-- </table>
        <br>
        <br>
        <table class="tblprecios">
          <tr>
            <th>BOLETO</th>
            <th>DETALLES</th>
           <th>CANTIDAD</th>
            <th>TOTAL A PAGAR</th>
         </tr>-->
          <tr>
            <td>SESIÓN VIP</td>
            <td>BOLETO: VIP (PRECIO: $<?php echo $infoDetails['precioVip']?> MXN)</td>
            <td>
           <!-- <form method="post" action="eventdetails.php">-->
            <select onchange="calcularTotal(this.value,true)">
                <option value="0"> -- SELECCIONE LA CANTIDAD ---</option>
                <option value="1">1 Boletos</option>
                <option value="2">2 Boletos</option>
                <option value="3">3 Boletos</option>
                <option value="4">4 Boletos</option>
                <option value="5">5 Boletos</option>
                <option value="6">6 Boletos</option>
                <option value="7">7 Boletos</option>
                <option value="8">8 Boletos</option>
                <option value="9">9 Boletos</option>
                <option value="10">10 Boletos</option>
              </select>
            <!-- </form>  -->
            </td>
            <td><label id="Label2" name="total">00.00</label> MXN</td>
            <td>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" class="btncomprar" name="sentCompra"  value="Comprar"></td>
          </tr>
        </table>
    </form>
    </div>
  </section>
<!--Función del bloque de pestañas-->
<script>
  function openCity(evt, cityName) {
    //Función que hace cambiar de pestaña en pestaña
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      //Función para activar las pestañas
    tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    //Danger-No Erase
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function calcularTotal(valor,vip){
  var total  = 0;
  if(vip){
   total = <?php echo $infoDetails['precioVip']?> * valor;

   document.getElementById("Label2").innerHTML = "$ "+parseFloat(total).toFixed(2);
   document.getElementById("totalVip").value = parseFloat(total).toFixed(2);
  }else{
    total = <?php echo $infoDetails['precio']?> * valor;

    document.getElementById("Label1").innerHTML = "$ "+parseFloat(total).toFixed(2);
    document.getElementById("total").value = parseFloat(total).toFixed(2);
  }

}


function favoritos(){
  var checkbox = document.getElementById('fav-checkbox');
              if (checkbox.checked == true){
                  //INSERCION A LA BASE DE DATOS DE FAVORITOS
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                   if (this.readyState == 4 && this.status == 200) {
                     alert("Se ha añadido de sus favoritos");
                   }
                  };
                  xhttp.open("GET", "includes/starfav.php?favoritoAdd=true&idEvento=<?php echo $_GET['eventId']; ?>", true);
                  xhttp.send();
                }else{
                  //ELIMINACION A LA BASE DE DATOS DE FAVORITOS
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                   if (this.readyState == 4 && this.status == 200) {
                     alert("Se ha removido de sus favoritos");
                     
                   }
                  };
                  xhttp.open("GET", "includes/starfav.php?favoritoDel=true&idEvento=<?php echo $_GET['eventId']; ?>", true);
                  xhttp.send();

                }

}



</script>

  <?php
  include('includes/footer.php');
  ?>

</body>
</html>