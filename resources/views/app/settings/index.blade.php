@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row ">
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="title">
                        Ingresar llave Api
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Descripcion (opcional)
                                </label>
                                <input class="form-control" placeholder="Identificador" type="text" name="name">
                                </input>
                            </div>
                        </div>

                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Private/Secret Key
                                </label>
                                <input class="form-control" placeholder="Llave Privada" type="text" name="secret_key">
                                </input>
                            </div>
                        </div>

                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Public Key
                                </label>
                                <input class="form-control" placeholder="Llave Publica" type="text" name="pub_key">
                                </input>
                            </div>
                        </div>
            
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Plataforma
                                </label>
                                
                                <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Plataforma" name="platform">
                                    <option disabled selected>Elige la plataforma</option>
                                    @foreach ($apis_category as $platf)
                                        <option value="{{ $platf->id }}">{{ $platf->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                  <span>{{ $error }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-round" type="submit">
                        Enviar
                    </button>
               
                </div>
                 </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Llaves API
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    Public Key
                                </th>
                                <th>
                                    Plataforma
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($apis as $api)
                            <tr>
                                <td>
                                    {{ $api->pub_key }}
                                </td>
                                <td>
                                    {{ $api->api->name }}
                                </td>
                                <td>
                                    {{ $api->created_at }}
                                </td>
                                
                                <td>
                                    <a href="{{ url("/admin/posts/{$api->id}") }}" class="btn btn-xs btn-success">Show</a>
                                    <a href="{{ url("/admin/posts/{$api->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                    <a href="{{ url("/admin/posts/{$api->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    No has agregado una api
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $apis->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
