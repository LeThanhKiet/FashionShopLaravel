<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'name',
        'email',
        'role',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function name($id)
    {
        try {
            return User::where('id', $id)->first()->name;
        } catch (\Exception $ex) {

        }

        return "";
    }

//    public function idOrder() {
//        return $this->hasMany('App\Models\donhang','idkhachhang','id');
//    }

//    public function getOrder($id) {
//        return User::where('id',$id)->with('idOrder.details.product')->first();
//    }
}
