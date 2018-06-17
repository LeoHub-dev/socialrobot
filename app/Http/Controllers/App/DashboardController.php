<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $users  = User::with('tradinghistories', 'follows')->whereHas('follows', function ($q) {
            $q->where('follows.user_id', '!=', Auth::id());
        })->orWhereDoesntHave('follows')->get();


        dd($users);

        //dd(Auth::user()->with('tradinghistories', 'follows')->get());

        return view('app.dashboard', compact('users'));
    }

}
