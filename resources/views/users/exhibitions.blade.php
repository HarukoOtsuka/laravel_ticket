@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1 class="logged_in_title">{{ $title }}</h1>
        <ul class="main_contents">
            @forelse($tickets as $ticket)
                <li>
                    <div>
                        商品名：
                        <a href="{{ route('tickets.show', $ticket) }}">
                            {{ $ticket->ticket_name }}
                        </a>
                    </div>
                    <div>
                        開催日時：{{ date('Y年m月d日 H時i分', strtotime($ticket->event_date)) }}
                    </div>
                    <div>
                        価格：{{ $ticket->price }}円
                    </div>
                    <div class="btn_flex">
                        <form method="GET" action="{{ route('tickets.edit', $ticket) }}">
                            @csrf
                            <input type="submit" value="編集" class="main_btn">
                        </form>
                        <form method="POST" action="{{ route('tickets.destroy', $ticket) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" class="delete_btn">
                        </form>
                    </div>
                </li>
            @empty
                <li>商品はありません</li>
            @endforelse
        </ul>
        <div class="pagination">
            {{ $tickets->links() }}
        </div>
@endsection