@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('tickets.update', $ticket) }}">
        @csrf
        @method('patch')
        <div>
            <label>
                チケット名：
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
                説明：
                <textarea name="ticket_comment">{{ $ticket->ticket_comment }}</textarea>
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
        <input type="submit" value="出品">
    </form>
@endsection