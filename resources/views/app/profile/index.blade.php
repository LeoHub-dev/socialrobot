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
                                <label>
                                    Company (disabled)
                                </label>
                                <input class="form-control" disabled="" placeholder="Company" type="text" value="Creative Code Inc.">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>
                                    Username
                                </label>
                                <input class="form-control" placeholder="Username" type="text" value="michael23">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Email address
                                </label>
                                <input class="form-control" placeholder="Email" type="email">
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>
                                    First Name
                                </label>
                                <input class="form-control" placeholder="Company" type="text" value="Mike">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>
                                    Last Name
                                </label>
                                <input class="form-control" placeholder="Last Name" type="text" value="Andrew">
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Address
                                </label>
                                <input class="form-control" placeholder="Home Address" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>
                                    City
                                </label>
                                <input class="form-control" placeholder="City" type="text" value="Mike">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>
                                    Country
                                </label>
                                <input class="form-control" placeholder="Country" type="text" value="Andrew">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>
                                    Postal Code
                                </label>
                                <input class="form-control" placeholder="ZIP Code" type="number">
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    About Me
                                </label>
                                <textarea class="form-control" cols="80" placeholder="Here can be your description" rows="4" value="Mike">
                                    Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.
                                </textarea>
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
                <img alt="..." src="../../assets/img/bg5.jpg">
                </img>
            </div>
            <div class="card-body">
                <div class="author">
                    <a href="#">
                        <img alt="..." class="avatar border-gray" src="../../assets/img/mike.jpg">
                            <h5 class="title">
                                Mike Andrew
                            </h5>
                        </img>
                    </a>
                    <p class="description">
                        michael24
                    </p>
                </div>
                <p class="description text-center">
                    "Lamborghini Mercy
                    <br>
                        Your chick she so thirsty
                        <br>
                            I'm in that two seat Lambo"
                        </br>
                    </br>
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
