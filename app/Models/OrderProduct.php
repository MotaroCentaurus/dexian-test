<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Pivot
{
    use SoftDeletes;

    protected $table = 'order_product';
    protected $fillable = ['order_id', 'product_id'];
}
