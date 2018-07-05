<?php

namespace App\Http\Controllers\App;

use App\Models\Follow;
use App\User;
use App\Models\PaymentAddress;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Resource\Address;
use Debugbar;

class PaymentController extends Controller
{
    public $apiKey = "KKxzSxKoeAgdMbQu";
    public $apiSecret = "KgbBBEXQjRE7HEWrYoie1o6INsksFl1r";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $configuration = Configuration::apiKey($this->apiKey, $this->apiSecret);
        $client = Client::create($configuration);

        Debugbar::info($client->getAccounts());

        foreach ($client->getAccounts() as $account) {
            Debugbar::info($account);
        }

        $accounts = $client->getAccounts();

        $title = 'Pagos';
        return view('app.payments.index',compact('title','accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAddress(Request $request)
    {
        $this->validate($request, [
            'coin' => 'required|string'
        ]);

        $configuration = Configuration::apiKey($this->apiKey, $this->apiSecret);
        $client = Client::create($configuration);

        $accounts = $client->getAccounts();

        $flag = 0;

        foreach ($accounts as $account)
        {
            if($account->getCurrency() == $request->coin)
            {
                $flag = 1;
                break;
            }
        }

        if($flag == 0)
        {
            return response()->json([
                'error' => true,
                'message' => 'No existe esa moneda'
            ])->setStatusCode(422);
        }

        $address = Auth::user()->paymentaddresses()->where('coin', '=',$request->coin)->first();

        if($address)
        {
            return response()->json([
                'data' => [
                    'message' => $address->address,
                ],
            ]);
        }

        $address = new Address([
            'name' => 'Address - Coin '.$request->coin.' - User '.Auth::id()
        ]);

        $client->createAccountAddress($account, $address);


        Auth::user()->paymentaddresses()->firstOrCreate([
            'coin' => $request->coin,
            'address' => $address->getAddress()
        ]);

        return response()->json([
            'data' => [
                'message' => $address->getAddress(),
            ],
        ]);

    }


    public function notifications()
    {
        $raw_body = file_get_contents('php://input');
        $signature = $_SERVER['HTTP_CB_SIGNATURE'];
        $authenticity = $client->verifyCallback($raw_body, $signature); // boolean

        if($authenticity)
        {
            $info = json_decode($raw_body);
            $user = PaymentAddress::where('address', '=', $info->data->address)->user();
            $configuration = Configuration::apiKey($this->apiKey, $this->apiSecret);
            $client = Client::create($configuration);
            $data = $client->getExchangeRates('BTC');

            $user->wallet()->create([
                'amount' => $data['rates']['USD'] * $info->additional_data->amount->amount
            ]);

        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'No se tiene acceso'
            ])->setStatusCode(422);
        }

        
    }



}
