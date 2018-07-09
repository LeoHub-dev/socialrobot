<?php

namespace App\Http\Controllers\App;

use App\User;
use App\Models\UserApi;
use App\Models\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Messerli90\Bittrex\Bittrex;
use Debugbar;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Settings';

        $apis_category = Api::all();
        $apis_list = Auth::user()->apis()->with('api')->paginate(10);
        $balances_list = Auth::user()->balancepercents()->paginate(10);

        $actived_api = Auth::user()->apis()->where([['user_id',Auth::id()],['active',true]])->first();

        if($actived_api)
        {
            $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);
            $balance = $bittrex->getBalance('BTC');
            Debugbar::info($bittrex->getBalance('BTC'));
        }

        $btc_price = new Bittrex(null, null);
        $btc_price = $btc_price->getTicker('USD-BTC');
        Debugbar::info($btc_price);

        return view('app.settings.index',compact('actived_api','apis_category','apis_list','balance','balances_list','btc_price'));
    }

    public function storeApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'secret_key' => 'required|string|unique:user_apis,secret_key',
            'pub_key' => 'required|string|unique:user_apis,pub_key',
            'platform' => 'required|integer|exists:apis,id'
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator, 'apiErrors');
        }

        $bittrex = new Bittrex($request->pub_key, $request->secret_key);

        $response = $bittrex->getBalances();

        if(!$response->success)
        {
            return redirect()->back()->withErrors([$response->message], 'apiErrors');
        }

        Auth::user()->apis()->create([
            'name' => $request->name,
            'secret_key' => $request->secret_key,
            'pub_key' => $request->pub_key,
            'api_category' => $request->platform
        ]);

        return redirect('app/settings')->with('message_api', 'Llave agregada');
    }

    public function storeBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'percent_to_use' => 'required|integer|min:1|max:100',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator, 'balanceErrors');
        }

        $actived_api = Auth::user()->apis()->where('user_id',Auth::id())->first();

        if($actived_api)
        {
            $bittrex = new Bittrex($actived_api->pub_key, $actived_api->secret_key);
            $balance = $bittrex->getBalance('BTC');
        }
        else
        {
            return redirect()->back()->withErrors(["Debes tener una API activa"], 'balanceErrors');
        }

        $btc_price = $bittrex->getTicker('USD-BTC');

        $amount_btc = (number_format($balance->result->Available,8) * $request->percent_to_use) / 100;
        $amount_usd = $amount_btc * $btc_price->result->Last;

        if (!env('APP_DEBUG')) 
        {
            if($amount_usd < 5)
            {
                return redirect()->back()->withErrors(array('message' => 'Debe de invertir un minimo de 5$'), 'balanceErrors'); 
            }
        }

        Auth::user()->balancepercents()->create([
            'percent_to_use' => $request->percent_to_use,
            'amount_base' => number_format($balance->result->Available,8),
            'amount_btc' => $amount_btc,
            'amount_usd' => $amount_usd
        ]);

        return redirect('app/settings')->with('message_balance', 'Balance Asignado');
    }


}
