@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        <div>
            ユーザー名：{{ $user->name }}
            @if($user->id !== Auth::user()->id)
                @if(Auth::user()->isFollowing($user))
                    <form method="POST" action="{{ route('follows.destroy', $user) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="フォロー解除">
                    </form>
                @else
                    <form method="POST" action="{{ route('follows.store') }}">
                        @csrf
                        <input type="hidden" name="follow_id" value="{{ $user->id }}">
                        <input type="submit" value="フォロー">
                    </form>
                @endif
            @endif
        </div>
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
            </li>
        @empty
            <li>商品はありません</li>
        @endforelse
    </ul>
@endsection