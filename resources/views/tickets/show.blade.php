@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
        <div>
            商品名：{{ $ticket->ticket_name }}
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
            <a href="{{ route('tickets.confirm', $ticket) }}">購入する</a>
        @endif
@endsection