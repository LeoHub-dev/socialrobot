@extends('layouts.app')

@section('content')
<div class="col-md-4 ml-auto mr-auto">
    
        <div class="card card-login card-plain">
            <div class="card-header ">
                <div class="logo-container">
                    <img alt="" src="{{ asset('uidash/img/now-logo.png') }}">
                    </img>
                </div>
            </div>
            
            <div class="social text-center" style="clear:both">
                <h5 class="card-description">
                    Conectate con las redes
                </h5>
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
    
</div>
@endsection
