<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */

    protected $table='categories';
    protected $fillable=[
        'id',
        'name',
    ];
    public $timestamps=false;

    public static function getCategoryName($id)
    {
        return DB::table('categories')
            ->select('name')
            ->where('id', $id)
            ->first();
    }
}
