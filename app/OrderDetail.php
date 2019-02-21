<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
        'order_id', 'product_id', 'quantity'
    ];

    public function orders()
    {
        return $this->belongsTo('App\Order');
    }

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
