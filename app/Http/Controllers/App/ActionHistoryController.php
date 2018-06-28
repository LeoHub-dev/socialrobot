<?php

namespace App\Http\Controllers\App;

use App\Models\ActionHistory;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Historial';

        $history = Auth::user()->actionhistories()->paginate(10);

        return view('app.history.index', compact('histories','title'));
    }
}
