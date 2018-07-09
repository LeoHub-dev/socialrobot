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
                                        {{ $invoice->created_at }}
                                    </td>
                                    <td>
                                        @if(!$invoice->paid)
                                        <div id="respuesta-pagar">
                                            <a class="json-action-link" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" data-target="respuesta-pagar" href="{{ url('app/invoices/pay/'.$invoice->id) }}">Pagar</a>
                                        </div>
                                        @else
                                        Pago
                                        @endif
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
