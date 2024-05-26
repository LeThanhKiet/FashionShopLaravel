<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table='product_details';
    protected $fillable=[
        'id',
        'id_models',
        'order',
        'import',
        'price',
        'id_order_detail',
        'id_import_detail',
    ];
    public $timestamps=false;
}
