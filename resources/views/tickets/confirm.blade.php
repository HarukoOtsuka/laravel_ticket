@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1 class="logged_in_title">{{ $title }}</h1>
        <main class="main_contents">
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
            <form method="POST" action="{{ route('tickets.finish', $ticket) }}">
                @csrf
                <input type="submit" value="内容を確認し購入する" class="main_btn">
            </form>
        </main>
@endsection