<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'ticket_name', 'event_date', 'ticket_comment', 'price', 'stock'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function orders(){
        return $this->hasMany('App\Order');
    }
    
    public function isSoldout(){
        return $this->stock===0;
    }
}
