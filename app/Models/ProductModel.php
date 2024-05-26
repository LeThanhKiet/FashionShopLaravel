<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel extends Model
{
    use HasFactory;
    protected $table='product_models';
    protected $fillable=[
        'id',
        'name',
        'size',
        'color',
        'quantity',
        'id_product',
        'price',
        'image',
    ];
    public $timestamps=false;

    public static function getAllQuantity($id) {
        $total_quantity = DB::table('product_models')
            ->where('id_product', $id)
            ->sum('quantity');
        DB::table('products')->where('id', $id)->update(['quantity' => $total_quantity]);
        return $total_quantity;
    }
    public static function getProductModelByProductId($id) {
        return DB::table('product_models')
            ->where('id_product', $id)
            ->get();
    }
    public static function getAllModel($id) {
        $total = DB::table('product_models')
            ->where('id_product', $id)
            ->get();
        return count($total);
    }

}
