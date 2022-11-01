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
            <form action="{{ route('tickets.create') }}" method="GET">
                @csrf
                <input type="submit" value="新規出品">
            </form>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection