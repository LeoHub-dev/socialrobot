<?php

namespace App\Http\Controllers\App;

use App\Models\Invoice;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Debugbar;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Facturas';

        $invoices = Auth::user()->invoices()->paginate(10);

        return view('app.invoice.index', compact('invoices','title'));
    }

    
    public function pay(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:invoices,id']);

        $invoice = Invoice::find($request->id);

        if($invoice->count())
        {
            if($invoice->get()->first()->user_id == Auth::id())
            {
                if(Auth::user()->wallet >= $invoice->get()->first()->amount)
                {

                    Auth::user()->wallet()->create([
                        'amount' => -$invoice->get()->first()->amount
                    ]);

                    $invoice->paid = 1;
                    $invoice->save();

                    return response()->json([
                        'data' => [
                            'message' => 'Gracias por pagar su factura.',
                        ],
                    ]);
                }
                else
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'No posees suficiente para pagar la factura.'
                    ])->setStatusCode(422);
                }
            }
            else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'No es tu factura'
                ])->setStatusCode(422);
            }

        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Invoice no existe'
            ])->setStatusCode(422);
        }

        return redirect("/app/invoices");

    }
}
