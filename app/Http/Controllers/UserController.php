<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;

class UserController extends Controller
{
    //出品商品一覧
    public function exhibitions($id)
    {
        $tickets = \Auth::user()->tickets()->latest()->paginate(5);
        return view('users.exhibitions', [
            'title' => '出品チケット一覧',
            'tickets' => $tickets,
        ]);
    }
    
    //ユーザー詳細画面
    public function show($id)
    {
        $user = User::find($id);
        $tickets = $user->tickets()->latest()->paginate(5);
        return view('users.show', [
            'title' => 'ユーザー詳細',
            'user' => $user,
            'tickets' => $tickets,
        ]);
    }
}