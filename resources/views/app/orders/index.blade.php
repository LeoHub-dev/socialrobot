@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row ">
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="title">
                        Crear Orden
                    </h5>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Moneda
                                </label>
                                
                                <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Coins" name="coins" required>
                                    <option disabled selected>Elige la moneda</option>
                                    @foreach ($bittrex->getMarkets()->result as $moneda)
                                        @if($moneda->BaseCurrency == "BTC")
                                            <option value="{{ $moneda->MarketName }}">{{ $moneda->MarketCurrencyLong }} ({{ $moneda->MarketName }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Cantidad a comprar
                                </label>
                                <input class="form-control" placeholder="Monto a comprar" type="text" value="" name="amount" required>
                                </input>
                            </div>
                        </div>
            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Comprar a
                                </label>
                                <input class="form-control" placeholder="Limite compra" type="text" value="" name="buy_limit" required>
                                </input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Vender en 
                                </label>
                                <input class="form-control" placeholder="Limite Venta alta" type="text" value="" name="sell_limit" required>
                                </input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Stop Loss
                                </label>
                                <input class="form-control" placeholder="Limite Venta baja" type="text" value="" name="stop_loss" required>
                                </input>
                            </div>
                        </div>

    
                        <div class="form-check text-left">
                            <label class="form-check-label">
                                <input class="form-check-input" name="auto_order" type="checkbox">
                                    <span class="form-check-sign">
                                    </span>Crear orden en mi cuenta tambien
                                </input>
                            </label>
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
                    Ordenes
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    Moneda
                                </th>
                                <th>
                                    Monto
                                </th>
                                <th>
                                    Resultado
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

                            @forelse ($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->coins }}
                                </td>
                                <td>
                                    {{ $order->amount }}
                                </td>
                                <td>
                                    {{ $order->result }}
                                </td>
                                <td>
                                    {{ $order->created_at }}
                                </td>
                                
                                <td>
                                    <a href="{{ url("/admin/posts/{$order->id}") }}" class="btn btn-xs btn-success">Show</a>
                                    <a href="{{ url("/admin/posts/{$order->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                    <a href="{{ url("/admin/posts/{$order->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    No has realizado alguna orden
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $orders->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
