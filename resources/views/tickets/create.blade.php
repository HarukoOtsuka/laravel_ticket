@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1 class="logged_in_title">{{ $title }}</h1>
        <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="main_contents">
            @csrf
            <div>
                <label>
                    商品名：
                    <input type="text" name="ticket_name">
                </label>
            </div>
            <div>
                <label>
                    開催日時：
                    <input type="datetime-local" name="event_date">
                </label>
            </div>
            <div>
                <label>
                    説明：<br>
                    <textarea name="ticket_comment" cols="50" rows="10"></textarea>
                </label>
            </div>
            <div>
                <label>
                    価格：
                    <input type="number" name="price">
                    円
                </label>
            </div>
            <div>
                <label>
                    枚数：
                    <input type="number" name="stock">
                    枚
                </label>
            </div>
            <input type="submit" value="出品" class="main_btn">
        </form>
@endsection