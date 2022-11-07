<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'ticket_id'];
    
    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }
}
