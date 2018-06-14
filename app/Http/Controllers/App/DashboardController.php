<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('tradinghistories')->withCount('tradinghistories')->simplePaginate(5);

        return view('app.dashboard', compact('users'));
    }


}
