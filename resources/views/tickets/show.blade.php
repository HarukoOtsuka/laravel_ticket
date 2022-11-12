@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1 class="logged_in_title">{{ $title }}</h1>
        <main class="main_contents">
            <div>
                商品名：{{ $ticket->ticket_name }}
            </div>
            <div>
                開催日時：{{ date('Y年m月d日 H時i分', strtotime($ticket->event_date)) }}
            </div>
            <div>
                説明：<br>{!! nl2br(e($ticket->ticket_comment)) !!}
            </div>
            <div>
                価格：{{ $ticket->price }}円
            </div>
            <div>
                枚数：{{ $ticket->stock }}枚
            </div>
            <div>
                出品者：
                <a href="{{ route('users.show', $ticket->user->id) }}">
                    {{ $ticket->user->name }}
                </a>
            </div>
            @if($ticket->isSoldout())
                売り切れ
            @elseif(Auth::user()->id !== $ticket->user_id)
                <form method="GET" action="{{ route('tickets.confirm', $ticket) }}">
                    @csrf
                    <input type="submit" value="購入する" class="main_btn">
                </form>
            @endif
        </main>
@endsection