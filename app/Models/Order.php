<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'id',
        'id_customer',
        'id_saler',
        'total_money',
        'note',
        'created_at',
        'kind',
    ];
    public $timestamps=false;
}
