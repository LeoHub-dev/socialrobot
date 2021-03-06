@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                A quien sigues
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    Usuario
                                </th>
                                <th>
                                    % Invertido
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

                            @forelse ($follows as $follow)
                            <tr>
                                <td>
                                    {{ $follow->trader->name }}
                                </td>
                                <td>
                                    {{ $follow->percent_to_trader }}
                                </td>
                                <td>
                                    {{ $follow->created_at }}
                                </td>
                                
                                <td>
                                    <a href="{{ url("/admin/posts/{$follow->id}") }}" class="btn btn-xs btn-success">Show</a>
                                    <a href="{{ url("/admin/posts/{$follow->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    No sigues a nadie
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $follows->links() !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Seguidores
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    Usuario
                                </th>
                                <th>
                                    % Invertido
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Perfil
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($followers as $follower)
                            <tr>
                                <td>
                                    {{ $follower->user->name }}
                                </td>
                                <td>
                                    {{ $follower->percent_to_trader }}
                                </td>
                                <td>
                                    {{ $follower->created_at }}
                                </td>
                                
                                <td>
                                    <a href="{{ url("/admin/posts/{$follower->id}") }}" class="btn btn-xs btn-success">Show</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    No tienes seguidores
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {!! $followers->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
