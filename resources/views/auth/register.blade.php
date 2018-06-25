@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 ml-auto">
        <div class="info-area info-horizontal mt-5">
            <div class="icon icon-primary">
                <i class="now-ui-icons media-2_sound-wave">
                </i>
            </div>
            <div class="description">
                <h5 class="info-title">
                    Marketing
                </h5>
                <p class="description">
                    We've created the marketing campaign of the website. It was a very interesting collaboration.
                </p>
            </div>
        </div>
        <div class="info-area info-horizontal">
            <div class="icon icon-primary">
                <i class="now-ui-icons media-1_button-pause">
                </i>
            </div>
            <div class="description">
                <h5 class="info-title">
                    Fully Coded in HTML5
                </h5>
                <p class="description">
                    We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
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
                    Built Audience
                </h5>
                <p class="description">
                    There is also a Fully Customizable CMS Admin Dashboard for this product.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mr-auto">
        <div class="card card-signup text-center">
            <div class="card-header ">
                <h4 class="card-title">
                    Register
                </h4>
                <div class="social">
                    <button class="btn btn-icon btn-round btn-twitter">
                        <i class="fab fa-twitter">
                        </i>
                    </button>
                    <button class="btn btn-icon btn-round btn-dribbble">
                        <i class="fab fa-dribbble">
                        </i>
                    </button>
                    <button class="btn btn-icon btn-round btn-facebook">
                        <i class="fab fa-facebook-f">
                        </i>
                    </button>
                    <h5 class="card-description">
                        or be classical
                    </h5>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="now-ui-icons users_circle-08">
                                </i>
                            </div>
                        </div>
                        <input id="name" placeholder="Name ..." type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        </input>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="now-ui-icons ui-1_email-85">
                                </i>
                            </div>
                        </div>
                        <input id="email" type="email" placeholder="Email ..." class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        </input>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="now-ui-icons objects_key-25">
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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="now-ui-icons objects_key-25">
                                </i>
                            </div>
                        </div>
                        <input id="password-confirm" placeholder="Confirm password ..." type="password" class="form-control" name="password_confirmation" required>
                        </input>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-check text-left">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox">
                                <span class="form-check-sign">
                                </span>
                                I agree to the
                                <a href="#something">
                                    terms and conditions
                                </a>
                                .
                            </input>
                        </label>
                    </div>
                
            </div>
            <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round btn-lg">
                    {{ __('Register') }}
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
