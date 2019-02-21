<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'user_id', 'amount', 'address_id', 'shipping', 'tax', 'tracking_number'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function addresses()
    {
        return $this->belongsTo('App\Address');
    }

    public function order_details()
    {
        return $this->hasMany('App\OrderDetail');
    }

}
