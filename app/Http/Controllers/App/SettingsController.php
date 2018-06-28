<?php

namespace App\Http\Controllers\App;

use App\User;
use App\Models\UserApi;
use App\Models\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        return view('app.settings.index',compact('apis','apis_category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string',
            'secret_key' => 'required|string|unique:user_apis,secret_key',
            'pub_key' => 'required|string|unique:user_apis,pub_key',
            'platform' => 'required|integer|exists:apis,id',
        ]);

        Auth::user()->apis()->create([
            'name' => $request->name,
            'secret_key' => $request->secret_key,
            'pub_key' => $request->pub_key,
            'api_category' => $request->platform
        ]);

        return redirect('app/settings')->with('message', 'Llave agregada');
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
