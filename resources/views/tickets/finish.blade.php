@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
        <div>
            商品名：{{ $ticket->ticket_name }}
        </div>
        <div>
            説明：{{ $ticket->ticket_comment }}
        </div>
        <div>
            価格：{{ $ticket->price }}円
        </div>
        <div>
            出品者：
            <a href="{{ route('users.show', $ticket->user->id) }}">
                {{ $ticket->user->name }}
            </a>
        </div>
        <a href="{{ route('top') }}">トップページ</a>
@endsection