<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{

    //specify the data associated with the model(optional)
    protected $table = 'products';

    //Define the fillable fields for mass assignment
    protected $fillable = [
    
        'category_prefix',
        'serial_id',
        'ferrule',
        'length',
        'weight',
        'butt',
        'balancing'

    ];

    //connection to images_table
    public function images(){
        return $this-> hasOne(Images::class, 'serial_id', 'serial_id');
    }

    //connection to categories_table
    public function categories(){
        return $this->belongsTo(Categories::class, 'category_prefix', 'category_prefix');
    }

}
