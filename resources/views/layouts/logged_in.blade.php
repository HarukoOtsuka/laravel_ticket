@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li>
            <a href="{{ route('tickets.index') }}">
                Ticket
            </a>
        </li>
        <li>
            <a href="{{ route('users.exhibitions', ['user'=>Auth::user()->id]) }}">
                出品チケット一覧
            </a>
        </li>
        <li>
            <form method="GET" action="{{ route('tickets.create') }}">
                @csrf
                <input type="submit" value="新規出品">
            </form>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection