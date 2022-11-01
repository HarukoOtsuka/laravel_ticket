<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Requests\TicketRequest;

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
    public function index()
    {
        $tickets = Ticket::where('user_id', '!=', \Auth::user()->id)->latest()->get();
        return view('tickets.index', [
            'title' => 'チケット一覧',
            'tickets' => $tickets,
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
            'ticket_comment' => $request->ticket_comment,
            'price' => $request->price,
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
}