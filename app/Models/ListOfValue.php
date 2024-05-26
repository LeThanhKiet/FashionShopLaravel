<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListOfValue extends Model
{
    use HasFactory;
    protected $table = 'list_of_values';
    public $timestamps = false;
    protected $fillable = [
        'id_list',
        'id_element',
        'name_list',
        'name_element',
        'description',
    ];
    public static function color()
    {
        try {
            return DB::table('list_of_values')
                ->where('id_list', 3)
                ->get();
        } catch (\Exception $ex) {

        }

        return "";
    }
    public static function size()
    {
        try {
            return DB::table('list_of_values')
                ->where('id_list', 4)
                ->get();
        } catch (\Exception $ex) {

        }

        return "";
    }
}
