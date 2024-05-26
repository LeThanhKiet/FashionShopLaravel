<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    use HasFactory;

    protected $table = 'import_details';
    protected $fillable = [
        'id',
        'id_import',
        'id_model',
        'quantity',
        'price',
    ];
    public $timestamps = false;
}
