@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <div class="carousel">
        <div class="slick_content">
            <img src="/photos/image4.JPG" alt="軽音ライブ2">
            <div class="slick_text">ticket</div>
        </div>
        <div class="slick_content">
            <img src="/photos/image2.JPG" alt="軽音ライブ1">
            <div class="slick_text">学生生活の思い出や<br>成果をたくさんの人に<br>見てもらおう！</div>
        </div>
        <div class="slick_content">
            <img src="/photos/image5.JPG" alt="ネモフィラ">
            <div class="slick_text">写真展</div>
        </div>
        <div class="slick_content">
            <img src="/photos/image1.JPG" alt="ハロウィンライブ">
            <div class="slick_text">ライブ</div>
        </div>
        <div class="slick_content">
            <img src="/photos/image3.JPG" alt="オリンピック空">
            <div class="slick_text">ticketは学生のための<br>チケット販売サイトです</div>
        </div>
    </div>
    <h1 class="logged_in_title">{{ $title }}</h1>
        <div class="flex">
            <div class="left_bar">
                <form action="{{ route('tickets.index') }}">
                    @csrf
                    @method('get')
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索" class="main_btn">
                </form>
            </div>
            <ul class="center">
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
                    </li>
                @empty
                    <li>商品はありません</li>
                @endforelse
            </ul>
            <div class="right_bar">
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
            </div>
        </div>
        <div class="pagination">
            {{ $tickets->appends(request()->except('page'))->links() }}
        </div>
        <script type="text/javascript">
            $('.carousel').slick({
                dots:true,
                autoplay:true,
                autoplaySpeed:3000
            });
        </script>
@endsection