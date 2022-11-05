@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <h2>おすすめユーザー</h2>
    <ul>
        @forelse($recommended_users as $recommended_user)
            <li>
                <a href="{{ route('users.show', $recommended_user) }}">
                    {{ $recommended_user->name }}
                </a>
            </li>
        @empty
            <li>おすすめのユーザーはいません</li>
        @endforelse
    </ul>
    <ul>
        @forelse($tickets as $ticket)
            <li>
                <div>
                    商品名：
                    <a href="{{ route('tickets.show', $ticket) }}">
                        {{ $ticket->ticket_name }}
                    </a>
                    (開催日時：{{ date('Y年m月d日 H時i分', strtotime($ticket->event_date)) }})
                </div>
                <div>
                    価格：{{ $ticket->price }}円
                </div>
            </li>
        @empty
            <li>商品はありません</li>
        @endforelse
    </ul>
@endsection