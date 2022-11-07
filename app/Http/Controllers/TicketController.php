<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Requests\TicketRequest;
use App\User;
use App\Order;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        //チケット一覧
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Ticket::query();
        if(!empty($keyword)){
            $query->where('ticket_name', 'LIKE', "%{$keyword}%");
        }
        $tickets = $query->where('user_id', '!=', \Auth::user()->id)->latest()->get();
        $user = \Auth::user();
        $follow_user_ids = $user->follow_users->pluck('id');
        $recommended_users = User::where('id', '!=', \Auth::user()->id)->whereNotIn('id', $follow_user_ids)->inRandomOrder()->limit(3)->get();
        return view('tickets.index', [
            'title' => 'チケット一覧',
            'tickets' => $tickets,
            'recommended_users' => $recommended_users,
            'keyword' => $keyword,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //新規出品フォーム
    public function create()
    {
        return view('tickets.create', [
            'title' => '新規出品',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //新規出品処理
    public function store(TicketRequest $request)
    {
        Ticket::create([
            'user_id' => \Auth::user()->id,
            'ticket_name' => $request->ticket_name,
            'event_date' => $request->event_date,
            'ticket_comment' => $request->ticket_comment,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        session()->flash('success', 'チケットを出品しました');
        return redirect()->route('users.exhibitions', ['user'=>\Auth::user()->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //チケット情報
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.show', [
            'title' => 'チケット情報',
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //チケット情報編集フォーム
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.edit', [
            'title' => 'チケット情報編集',
            'ticket' => $ticket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //チケット情報編集処理
    public function update(TicketRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->update([
            'ticket_name' => $request->ticket_name,
            'event_date' => $request->event_date,
            'ticket_comment' => $request->ticket_comment,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        session()->flash('success', 'チケット情報を編集しました');
        return redirect()->route('tickets.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //チケット情報削除処理
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        \Session::flash('success', 'チケット情報を削除しました');
        return redirect()->route('users.exhibitions', ['user'=>\Auth::user()->id]);
    }
    
    public function confirm($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.confirm', [
            'title' => '購入確認',
            'ticket' => $ticket,
        ]);
    }
    
    //購入確定
    public function finish(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        
        Order::create([
            'user_id' => \Auth::user()->id,
            'ticket_id' => $id,
        ]);
        
        $ticket->stock--;
        $ticket->save();
        
        return view('tickets.finish', [
            'title' => 'ご購入ありがとうございました',
            'ticket' => $ticket,
        ]);
    }
}
