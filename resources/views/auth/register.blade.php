@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 ml-auto">
        <div class="info-area info-horizontal mt-5">
            <div class="icon icon-primary">
                <i class="now-ui-icons media-1_button-pause">
                </i>
            </div>
            <div class="description">
                <h5 class="info-title">
                    Conecta
                </h5>
                <p class="description">
                Sigue a tus traders favoritos.
                </p>
            </div>
        </div>
        <div class="info-area info-horizontal">
            <div class="icon icon-primary">
                <i class="now-ui-icons media-2_sound-wave">
                </i>
            </div>
            <div class="description">
                <h5 class="info-title">
                    Gana
                </h5>
                <p class="description">
                    Obten ganancias pronto.
                </p>
            </div>
        </div>
        <div class="info-area info-horizontal">
            <div class="icon icon-info">
                <i class="now-ui-icons users_single-02">
                </i>
            </div>
            <div class="description">
                <h5 class="info-title">
                    Crece
                </h5>
                <p class="description">
                    Crece y vuelvete trader.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mr-auto">
        <div class="card card-signup text-center">
            <div class="card-header ">
                <h4 class="card-title">
                    Registro
                </h4>
                <div class="social">
                    <a href="{{ url('login/google') }}"><button class="btn btn-google">
                        <i class="fab fa-google-plus-g">
                        </i> Conectar con Google
                    </button></a>
                    <a href="{{ url('login/facebook') }}"><button class="btn btn-facebook">
                        <i class="fab fa-facebook-square">
                        </i> Conectar con Facebook
                    </button></a>
                  
                </div>
            </div>
            <div class="card-body ">
                  
                
            </div>
         
            
        </div>
    </div>
</div>
@endsection
