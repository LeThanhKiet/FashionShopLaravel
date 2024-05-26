<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'url',
        'thumb',
        'sort_by',
        'active'
    ];
}
