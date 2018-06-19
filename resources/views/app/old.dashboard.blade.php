@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}

                        </div>
                    @endif
                    @forelse ($users as $user)
                    {{ $user->name }}
                    @php $trading_total = 0; $trading_count = 0; @endphp
                    @foreach ($user->tradinghistories as $trading) 
                    @php 
                    if($trading->result == 1): 
                        $trading_total++;
                    elseif($trading->result == 2): 
                        $trading_total--;
                    endif; 
                    $trading_count++;
                    @endphp
                    @endforeach
                    @php 
                    if($trading_count == 0) : $trading_count = 1; else : $trading_count = $trading_count; endif;
                    echo floor(($trading_total / $trading_count) * 100) ."%";
                    @endphp


                    
                    @empty
                    You are logged in!
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
