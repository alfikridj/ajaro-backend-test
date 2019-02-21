<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name', 'price', 'weight', 'description', 'image', 'category_id', 'stock'
    ];

    public function categories()
    {
        return $this->belongsTo('App\Category');
    }

    public function order_details()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
