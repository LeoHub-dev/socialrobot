<!DOCTYPE html>
<html lang="en">
    @include('layouts.modules.head')
  
    <div aria-labelledby="myModalLabel" class="modal fade modal-mini modal-primary" id="errorModal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="modal-profile">
                        <i class="now-ui-icons travel_info">
                        </i>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="errorText">
                        Error
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
    <body class=" sidebar-mini ">
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe height="0" src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" style="display:none;visibility:hidden" width="0">
            </iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="wrapper ">
            @include('layouts.dashboard.nav')
            <div class="main-panel">
                <!-- Navbar -->
                @include('layouts.dashboard.navbar')
                <!-- End Navbar -->
                @includeWhen($graph, 'layouts.dashboard.dashgraph')
                @includeWhen(!$graph, 'layouts.dashboard.dashnormal')

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