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
                    {{ var_dump($user->tradinghistories) }}
                    You are logged in!
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
