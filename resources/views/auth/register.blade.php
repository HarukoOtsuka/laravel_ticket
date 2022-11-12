@extends('layouts.not_logged_in')

@section('content')
    <h1 class="not_logged_in_title">サインアップ</h1>
        <form method="POST" action="{{ route('register') }}" class="not_logged_in_main">
            @csrf
            <div>
                <label>
                    ユーザー名：<br>
                    <input type="text" name="name">
                </label>
            </div>
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
            <div>
                <label>
                    パスワード（確認用）：<br>
                    <input type="password" name="password_confirmation">
                </label>
            </div>
            <div class="not_logged_in_btn">
                <input type="submit" value="登録" class="main_btn">
            </div>
        </form>
@endsection