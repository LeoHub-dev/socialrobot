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
                    {{ $user->reputation }}%
                    <a href="{{ url("/app/follows/{$user->id}/follow") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-info">Follow</a>
                    @empty
                    You are logged in!
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
