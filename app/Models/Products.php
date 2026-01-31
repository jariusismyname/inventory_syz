<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
     protected $primaryKey = 'id'; // if your PK is not 'id'
    protected $fillable = [
        'product_quantity',
 'product_image',
'product_name',
'product_description',
' product_price',
'category_name',
'supplier_name',
'created_at',
'updated_at'
    ];
}
