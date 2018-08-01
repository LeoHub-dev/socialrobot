<!DOCTYPE html>
<html lang="en">

@include('layouts.modules.head')

<body class=" sidebar-mini ">
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- Navbar -->
  @include('layouts.app.nav')
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page ">
    <div class="full-page login-page section-image" filter-color="black" data-image="{{ asset('uidash/img/bg14.jpg') }}">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="content">
        <div class="container">
          @yield('content')
        </div>
      </div>
      @include('layouts.modules.footer')
    </div>
  </div>
  @include('layouts.modules.scripts')
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
  <div aria-labelledby="myModalLabel" class="modal fade modal-mini modal-primary" id="privacy" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons travel_info">
                    </i>
                </div>
            </div>
            <div class="modal-body text-center">
                <h3>Politicas de Privacidad</h3>
                <p class="errorText">
                  SocialRobot asegura la privacidad de sus clientes. Al ingresar con las redes, accedes al acceso a tu perfil en dicha red para la creacion de un perfil en nuestra pagina.
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-link btn-neutral" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
</body>

</html>