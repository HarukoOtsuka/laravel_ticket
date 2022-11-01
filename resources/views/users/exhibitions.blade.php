@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        @forelse($tickets as $ticket)
            <li>
                <div>
                    <a href="{{ route('tickets.show', $ticket) }}">
                        商品名：{{ $ticket->ticket_name }}
                    </a>
                    (開催日時：{{ date('Y年m月d日 H時i分', strtotime($ticket->event_date)) }})
                </div>
                <div>
                    価格：{{ $ticket->price }}円
                </div>
                <div>
                    [<a href="{{ route('tickets.edit', $ticket) }}">編集</a>]
                </div>
                <form method="POST" action="{{ route('tickets.destroy', $ticket) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form> 
            </li>
        @empty
            <li>商品はありません</li>
        @endforelse
    </ul>
@endsection