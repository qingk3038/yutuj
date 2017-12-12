<?php

namespace App\Http\Controllers\Api;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TravelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Travel $travel)
    {
        //
    }

    public function edit(Travel $travel)
    {
        //
    }


    public function update(Request $request, Travel $travel)
    {
        //
    }


    public function destroy(Travel $travel)
    {
        //
    }
}
