<!DOCTYPE html>
<html lang="en">

@include('layouts.modules.head')

<body class=" sidebar-mini ">
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper ">

    @include('layouts.dashboard.nav')

    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.dashboard.navbar')
      <!-- End Navbar -->
      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      <div class="content">
        @yield('content')
        
      </div>
      @include('layouts.modules.footer')
    </div>
  </div>
  @include('layouts.modules.scripts')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

      demo.initVectorMap();

    });
  </script>
</body>

</html>