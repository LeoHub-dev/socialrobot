@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="card">
                <form class="form-payment-coin" action="{{ route('payments.getAddress') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5 class="title">
                        Pagos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Moneda con la que pagara
                                </label>
                                
                                <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Plataforma" name="coin">
                                    <option disabled selected>Elige la moneda</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->getCurrency() }}">{{ $account->getCurrency() }}</option>
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
                <div id="payment-info" class="col-md-12" style="display: none">
                <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            Dirección donde enviar pagos <span class="payment-coin"></span>
                        </label>
                        <input id="payment-address" class="form-control" type="text">
                        </input>
                    </div>
                </div>
            </div>

        </div>
        
         
    </div>
</div>
@endsection
