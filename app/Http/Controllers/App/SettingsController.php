<?php

namespace App\Http\Controllers\App;

use App\User;
use App\Models\UserApi;
use App\Models\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

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
        $apis = Auth::user()->apis()->with('api')->paginate(10);
        $balances = Auth::user()->balancepercents()->paginate(10);

        return view('app.settings.index',compact('apis','apis_category','balances'));
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
            'percent_to_use' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator, 'balanceErrors');
        }


        Auth::user()->balancepercents()->create([
            'percent_to_use' => $request->percent_to_use
        ]);

        return redirect('app/settings')->with('message_balance', 'Balance Asignado');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $title = 'Perfil';
        return view('app.profile.edit',compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;

        $user->save();

        flash()->overlay('Editado');

        return redirect('app/profile/edit')->with('message', 'Editado');
    }


}
