<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportBill extends Model
{
    use HasFactory;
    protected $table='import_bill';
    protected $fillable=[
        'id',
        'id_staff',
        'id_supplier',
        'total_money',
        'created_at',
        'updated_at',
    ];
    public $timestamps=true;
}
