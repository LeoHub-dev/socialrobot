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
    	$users = User::where('users.id', '!=', Auth::id())->orderBy('reputation','desc')->paginate(10)->filter(function($user)
    	{
    		return !$user->isFollowedBy(Auth::user());
		});

        return view('app.dashboard', compact('users'));
    }

}
