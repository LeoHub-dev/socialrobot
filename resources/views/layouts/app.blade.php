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
</body>

</html>