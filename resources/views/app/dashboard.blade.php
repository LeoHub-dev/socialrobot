@extends('layouts.dashboard',['graph' => true])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-primary">
                                    <i class="now-ui-icons ui-2_chat-round">
                                    </i>
                                </div>
                                <h3 class="info-title">
                                    0
                                </h3>
                                <h6 class="stats-title">
                                    Mensajes
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="now-ui-icons business_money-coins">
                                    </i>
                                </div>
                                <h3 class="info-title">
                                    <small>
                                        $
                                    </small>
                                    5000
                                </h3>
                                <h6 class="stats-title">
                                    Ganancias
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-info">
                                    <i class="now-ui-icons users_single-02">
                                    </i>
                                </div>
                                <h3 class="info-title">
                                    562
                                </h3>
                                <h6 class="stats-title">
                                    Seguidores
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="now-ui-icons objects_support-17">
                                    </i>
                                </div>
                                <h3 class="info-title">
                                    353
                                </h3>
                                <h6 class="stats-title">
                                    Siguiendo
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Classic Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="followModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    <i class="now-ui-icons ui-1_simple-remove">
                    </i>
                </button>
                <h4 class="title title-up">
                    Cuanto Invertira?
                </h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <p class="font-weight-bold">
                        Información del trader :
                    </p>
                    <p>
                        <span class="font-weight-bold">
                            Usuario :
                        </span>
                        <span class="user_name">
                        </span>
                    </p>
                    <p>
                        <span class="font-weight-bold">
                            Precisión :
                        </span>
                        <span class="user_reputation">
                        </span>
                        %
                    </p>
                    <hr>
                    <form class="form-horizontal form-confirm-follow" action="{{ url('app/follows') }}" method="POST">
                        @csrf
                        <input name="user_id" type="hidden" value=""/>
                        <div class="row">
                            <label class="col-md-3 col-form-label">
                                Balance ($)
                            </label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input class="form-control" id="balance_available" name="balance" number="true" type="number" value="{{ number_format(Auth::user()->getBalance()->amount_btc,8) }}" readonly="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">
                                Invertir (%)
                            </label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input class="form-control" id="invest_calculator" max="100" min="1" name="invest" number="true" type="number"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">
                                Total ($)
                            </label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input class="form-control" id="balance_invest_btc" name="total" number="true" type="number" readonly="true"  value="0" />
                                </div>
                            </div>
                        </div>

                        <div class="text-center slider-div">
                         
                            <h4 class="card-title">Cantidad de ordenes a invertir</h4>
                            <div class="col-md-12">
                                
                                <div id="sliderRegular" class="slider"></div>
                                <input id="order_count" class="form-control" name="order_count" number="true" type="hidden" readonly="true"  value="1" />
                                
                            </div>
                        </div>

                        
                    
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-primary btn-round" type="submit">
                    Confirmar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--  End Modal -->
<div class="row">
    <div class="col-lg-12 text-center">
        <h4>
            LISTA DE TRADERS
        </h4>
    </div>
</div>
<div class="row">
    @forelse ($users as $user)
    <div class="col-lg-2" id="user-{{ $user->id }}">
        <div class="card card-user">
            <div class="image">
            </div>
            <div class="card-body">
                <div class="author">
                    <a href="{{ url('profile/'.$user->id) }}">
                        <img alt="..." class="avatar border-gray" src="{{ asset('uidash/img/'.$user->profile_img) }}">
                            <h5 class="title">
                                {{ $user->name }}
                            </h5>
                        </img>
                    </a>
                    <p class="description font-weight-bold @if($user->reputation > 0) text-info @elseif($user->reputation < 0) text-danger @else text-muted @endif">
                        {{ $user->reputation }}% Precisión
                    </p>
                </div>
            </div>
            <hr>
                <div class="button-container">
                    <a class="btn btn-round btn-primary btn-follow" data-target="#followModal" data-toggle="modal" data-user="{{ $user->id }}|{{ $user->name }}|{{ $user->reputation }}" href="javascript:void(0)">
                        Seguir
                    </a>
                </div>
            </hr>
        </div>
    </div>
    @empty
    <div class="col-lg-12">
        <div class="alert alert-info alert-with-icon" data-notify="container">
            <span class="now-ui-icons ui-1_bell-53" data-notify="icon">
            </span>
            <span data-notify="message">
                No hay usuarios para seguir
            </span>
        </div>
    </div>
    @endforelse
</div>
@endsection
@push('extra_scripts')
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        
        var slider = document.getElementById('sliderRegular');

        noUiSlider.create(slider, {
            start: 1,
            connect: [true, false],
            tooltips: true,
            pips: {
                mode: 'steps',
                stepped: true,
                density: 4
            },
            step: 1,
            range: {
                min: 1,
                max: 3
            }
        });

        slider.noUiSlider.on('update', function() {
            $('#order_count').val(slider.noUiSlider.get());
        });

        demo.initDashboardPageCharts();

        demo.initVectorMap();

        $('#invest_calculator').on('input', function(e) { 

            var balance_invest_percent = $(this).val();
            var balance_available = $('#balance_available').val();

            var balance_invest_btc = (balance_available * balance_invest_percent) / 100;

            $('#balance_invest_btc').val(parseFloat(balance_invest_btc).toFixed(8));
            
        });

    });
</script>
@endpush