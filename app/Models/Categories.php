<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    //specify the data associated with the model(optional)
    protected $table = 'categories';

    //NEWLY ADDED
    //specify the primary key
    protected $primaryKey = 'category_type';

    //NEWLY ADDED
    //specify that the primary key is a string
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_type',
        'category_name',
        'category_description'
    ];

    //caonnection to products_table
    public function products(){
        return $this->hasMany(Products::class, 'category_type', 'category_type');
    }

}
