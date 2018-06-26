@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">
                    Edit Profile
                </h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">

                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Email address
                                </label>
                                <input class="form-control" placeholder="Email" type="email" value="{{ Auth::user()->email }}" disabled="true">
                                </input>
                            </div>
                        </div>
            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Nombre
                                </label>
                                <input class="form-control" placeholder="Company" type="text" value="{{ Auth::user()->name }}">
                                </input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img alt="..." src="{{ asset('uidash/img/bg5.jpg') }}">
                </img>
            </div>
            <div class="card-body">
                <div class="author">
                    <a href="#">
                        <img alt="" class="avatar border-gray" src="{{ asset('uidash/img/'.Auth::user()->profile_img) }}">
                            <h5 class="title">
                                {{ Auth::user()->name }}
                            </h5>
                        </img>
                    </a>
                    <p class="description font-weight-bold @if(Auth::user()->reputation > 0) text-info @elseif(Auth::user()->reputation < 0) text-danger @else text-muted @endif">
                        {{ Auth::user()->reputation }}% Precisión
                    </p>
                </div>
                <p class="description text-center">
                    
                </p>
            </div>
            <hr>
                <div class="button-container">
                    <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                        <i class="fab fa-facebook-square">
                        </i>
                    </button>
                    <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                        <i class="fab fa-twitter">
                        </i>
                    </button>
                    <button class="btn btn-neutral btn-icon btn-round btn-lg" href="#">
                        <i class="fab fa-google-plus-square">
                        </i>
                    </button>
                </div>
            </hr>
        </div>
    </div>
</div>
@endsection
