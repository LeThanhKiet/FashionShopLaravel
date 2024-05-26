<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table='products';
    protected $fillable=[
        'id',
        'name',
        'quantity',
        'id_category',
        'image',
        'price',
        'description',
    ];
    public $timestamps=false;

    public static function getPrice($id){
        return DB::table('products')
            ->where('id', $id)
            ->first()->price;
    }
    public static function getCategory($id){
        return DB::table('categories')
            ->where('id', $id)
            ->first()->name;
    }
    public static function getSumProductByCategoryId($id){
        $total = DB::table('products')
            ->where('id_category', $id)
            ->get();
        return count($total);
    }


}
