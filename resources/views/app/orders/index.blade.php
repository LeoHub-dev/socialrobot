@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
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
@endsection
