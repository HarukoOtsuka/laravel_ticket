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
                    (開催日時：{{ $ticket->event_date }})
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