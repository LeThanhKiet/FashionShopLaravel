<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='orders_details';
    protected $fillable=[
        'id',
        'id_order',
        'id_model',
        'quantity',
        'price',
    ];
    public $timestamps=false;
}
