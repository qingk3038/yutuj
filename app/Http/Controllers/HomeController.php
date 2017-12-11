<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = auth()->user()->travels()->where('status', '!=', 'draft')->orderByDesc('updated_at')->paginate(15);

        return view('www.home.index', compact( 'travels'));
    }

}
