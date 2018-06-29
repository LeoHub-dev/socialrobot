@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row ">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('settings.storeApi') }}" method="POST">
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
                            @if(session()->has('message_api'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_api') }}
                                </div>
                            @endif
                            @foreach ($errors->apiErrors->all() as $error)
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
                    <div class="table-responsive">
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
                    </div>
                    {!! $apis->links() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12">
            
            <div class="card @if(!$apis->count()) __disabled @endif">
                @if(!$apis->count())
                <div class="disabled-container text-center">
                    <div class="icon">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </div>
                    <div class="title">Debe agregar una API activa</div>
                </div>
                @endif
                <form action="{{ route('settings.storeBalance') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="title">
                        Balance
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Balance en Bittrex
                                </label>
                                <input class="form-control" placeholder="Balance Bittrex" type="text" name="name" disabled="true" required>
                                </input>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Invertir (en %)
                                </label>
                                <input class="form-control" placeholder="Cuanto invertir en %" type="text" name="percent_to_use">
                                </input>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    Balance neto a Invertir
                                </label>
                                <input class="form-control" placeholder="Balance neto" type="text" disabled="true">
                                </input>
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            @if(session()->has('message_balance'))
                                <div class="alert alert-success">
                                    {{ session()->get('message_balance') }}
                                </div>
                            @endif
                            @foreach ($errors->balanceErrors->all() as $error)
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
            <div class="card @if(!$apis->count()) __disabled @endif"">
                @if(!$apis->count())
                <div class="disabled-container text-center">
                    <div class="icon">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </div>
                    <div class="title">Debe agregar una API activa</div>
                </div>
                @endif
                <div class="card-header">
                    Balances
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>
                                        Inversión (%)
                                    </th>
                                    <th>
                                        Inversión ($)
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

                                @forelse ($balances as $balance)
                                <tr>
                                    <td>
                                        {{ $balance->percent_to_use }}
                                    </td>
                                    <td>
                                        {{ $balance->amount }}
                                    </td>
                                    <td>
                                        {{ $balance->created_at }}
                                    </td>
                                    
                                    <td>
                                        <a href="{{ url("/admin/posts/{$balance->id}") }}" class="btn btn-xs btn-success">Show</a>
                                        <a href="{{ url("/admin/posts/{$balance->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                        <a href="{{ url("/admin/posts/{$balance->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        No has asignado un balance a usar
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $balances->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
