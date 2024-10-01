<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'product_type_id';
    protected $fillable = ['product_type'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id');
    }
}
