@extends('layouts.dashboard',['graph' => false])

@section('content')
<div class="row ">
    <div class="col-md-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Facturas
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>
                                        Monto
                                    </th>
                                    <th>
                                        Estado
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

                                @forelse ($invoices as $invoice)
                                <tr>
                                    <td>
                                        {{ $invoice->amount }}
                                    </td>
                                    <td>
                                        {{ $invoice->paid }}
                                    </td>
                                    <td>
                                        {{ $invoice->created_at }}
                                    </td>
                                    
                                    <td>
                                        Pagar
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        No tienes ninguna factura
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $invoices->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
