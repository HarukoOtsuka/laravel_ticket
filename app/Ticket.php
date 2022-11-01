<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'ticket_name', 'event_date', 'ticket_comment', 'price'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
