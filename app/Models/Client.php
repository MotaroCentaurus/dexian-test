<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_name', 'email', 'telephone', 'birthdate',
        'address_line_1', 'address_line_2', 'neighborhood', 'zip'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }
}
