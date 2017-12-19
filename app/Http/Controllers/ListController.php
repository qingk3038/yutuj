<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Cache;

class ListController extends Controller
{
    // 显示游记
    public function userTravel(User $user)
    {
        return $user;
    }

}
