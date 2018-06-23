@extends('layouts.app')

@section('content')
<div class="col-md-4 ml-auto mr-auto">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card card-login card-plain">
            <div class="card-header ">
                <div class="logo-container">
                    <img alt="" src="{{ asset('uidash/img/now-logo.png') }}">
                    </img>
                </div>
            </div>
            <div class="card-body ">
                <div class="input-group no-border form-control-lg">
                    <span class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="now-ui-icons ui-1_email-85">
                            </i>
                        </div>
                    </span>
                    <input id="email" type="email" placeholder="Email ..." class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </input>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group no-border form-control-lg">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="now-ui-icons text_caps-small">
                            </i>
                        </div>
                    </div>
                    <input id="password" type="password" placeholder="Password ..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </input>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                    {{ __('Login') }}
                </button>
           
                <div class="pull-left">
                    <h6>
                        <a class="link footer-link" href="#pablo">
                            Create Account
                        </a>
                    </h6>
                </div>
                <div class="pull-right">
                    <h6>
                        <a class="link footer-link" href="#pablo">
                            Need Help?
                        </a>
                    </h6>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
