<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\Sellers;

class Sellers extends Model
{
    //Disable timestamps
    public $timestamps = false;

    //Define the fillable fields
    protected $fillable = [
        'seller_id',
        'password',
    ];

    //Hash the password automatically
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }


}
