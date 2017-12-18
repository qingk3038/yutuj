<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        $hot_line = Cache::remember('index_hot_line', 30, function () {
            return Nav::find(1)->activities()->limit(4)->latest('updated_at')->get(['id', 'title', 'short', 'thumb']);
        });
        return view('www.index', compact('hot_line'));
    }

}
