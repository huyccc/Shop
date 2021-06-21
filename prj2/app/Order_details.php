<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'order_id','product_id','product_name','product_price','product_sales_quantity'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'order_details';
}
