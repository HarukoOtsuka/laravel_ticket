@extends('layouts.not_logged_in')

@section('content')
    <h1 class="not_logged_in_title">ログイン</h1>
        <form method="POST" action="{{ route('login') }}" class="not_logged_in_main">
            @csrf
            <div>
                <label>
                    メールアドレス：<br>
                    <input type="email" name="email">
                </label>
            </div>
            <div>
                <label>
                    パスワード：<br>
                    <input type="password" name="password">
                </label>
            </div>
            <div class="not_logged_in_btn">
                <input type="submit" value="ログイン" class="main_btn">
            </div>
        </form>
@endsection