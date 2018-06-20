<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\TradingHistory;
use App\Models\ActionHistory;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function orders()
    {
        $orders = TradingHistory::paginate(10);

        return $orders;
    }

    public function categories()
    {
        $categories = Category::paginate(10);

        return $categories;
    }

    public function users()
    {
        $users = User::paginate(10);

        return $users;
    }
}
