<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $primaryKey = 'id'; // if your PK is not 'id'
    protected $fillable = [
        'product_name',
        'user_id',
        'quantity',
        'price',
    ];
}
