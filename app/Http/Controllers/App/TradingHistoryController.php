<?php

namespace App\Http\Controllers\App;

use App\Models\TradingHistory;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TradingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = TradingHistory::with(['user'])->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['coins' => 'required', 'amount' => 'required']);

        Auth::user()->tradinghistories()->create([
            'coins' => $request->coins,
            'amount' => $request->amount
        ]);
        
        flash()->overlay('Comment successfully created');

        return redirect("/app/dashboard");

    }
}
