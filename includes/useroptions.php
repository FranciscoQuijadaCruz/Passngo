<div class="useroptions">
  <ul class="useroptions">
    

    <li class="useroptions">
      <a href="#" class="Auseroptions">
        <div id="google_translate_element"></div><script type="text/javascript">
          function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
          }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </a>


    </li>
    <li class="useroptions">
      <a class="trigger"><img id="iconoayuda" src="imgs/icono_ayuda.png" title="Ayuda para el usuario"></a>
    </li> 


    <li class="useroptions">
      <a href="login.php" class="Auseroptions">

        <?php if($_SESSION) { ?> 
        <div class="dropdown">
          <button class="dropbtn"><img id="login-icon" src="imgs/icono_usuario.png"></button>

          <div class="dropdown-content">
            <a href="login.php" class="Auseroptions">Administrar Perfil</a>
            <a href="login.php?logOut=true" class="Auseroptions">Cerrar Sesión</a>
          </div>
        </div> 

       <?php } else { echo '<img id="imgentrar" src="imgs/icono_entrar.png">';}?> 
      </a>
    </li>

  </ul>
</div>



    <div class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            
            <div class="carousel-wrapper">
              <span id="item-1"></span>
              <span id="item-2"></span>
              <span id="item-3"></span>
              <span id="item-4"></span>
              <span id="item-5"></span>
              <span id="item-6"></span>

              <div class="carousel-item item-1">
                <a class="arrow arrow-prev" href="#item-6"></a>
                <a class="arrow arrow-next" href="#item-2"></a>
              </div>
  
              <div class="carousel-item item-2">
                <a class="arrow arrow-prev" href="#item-1"></a>
                <a class="arrow arrow-next" href="#item-3"></a>
              </div>
              
              <div class="carousel-item item-3">
                <a class="arrow arrow-prev" href="#item-2"></a>
                <a class="arrow arrow-next" href="#item-4"></a>
              </div>

              <div class="carousel-item item-4">
                <a class="arrow arrow-prev" href="#item-3"></a>
                <a class="arrow arrow-next" href="#item-5"></a>
              </div>

              <div class="carousel-item item-5">
                <a class="arrow arrow-prev" href="#item-4"></a>
                <a class="arrow arrow-next" href="#item-6"></a>
              </div>

              <div class="carousel-item item-6">
                <a class="arrow arrow-prev" href="#item-5"></a>
                <a class="arrow arrow-next" href="#item-1"></a>
              </div>
            </div>

        </div>
    </div>

<script type="text/javascript">
    var modal = document.querySelector(".modal");
    var trigger = document.querySelector(".trigger");
    var closeButton = document.querySelector(".close-button");

    function toggleModal() {
        modal.classList.toggle("show-modal");
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            toggleModal();
        }
    }

    trigger.addEventListener("click", toggleModal);
    closeButton.addEventListener("click", toggleModal);
    window.addEventListener("click", windowOnClick);
</script>