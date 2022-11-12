@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1 class="logged_in_title">{{ $title }}</h1>
        <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="main_contents">
            @csrf
            @method('patch')
            <div>
                <label>
                    商品名：
                    <input type="text" name="ticket_name" value="{{ $ticket->ticket_name }}">
                </label>
            </div>
            <div>
                <label>
                    開催日時：
                    <input type="datetime-local" name="event_date" value="{{ $ticket->event_date }}">
                </label>
            </div>
            <div>
                <label>
                    説明：<br>
                    <textarea name="ticket_comment" cols="50" rows="10">{{ $ticket->ticket_comment }}</textarea>
                </label>
            </div>
            <div>
                <label>
                    価格：
                    <input type="number" name="price" value="{{ $ticket->price }}">
                    円
                </label>
            </div>
            <div>
                <label>
                    枚数：
                    <input type="number" name="stock" value="{{ $ticket->stock }}">
                    枚
                </label>
            </div>
            <input type="submit" value="出品" class="main_btn">
        </form>
@endsection