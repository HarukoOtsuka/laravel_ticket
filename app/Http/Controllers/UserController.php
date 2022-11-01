<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //出品商品一覧
    public function exhibitions($id)
    {
        $tickets = \Auth::user()->tickets()->latest()->get();
        return view('users.exhibitions', [
            'title' => '出品チケット一覧',
            'tickets' => $tickets,
        ]);
    }
}