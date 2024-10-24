<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{

    //specify the data associated with the model(optional)
    protected $table = 'products';

    //Define the fillable fields for mass assignment
    protected $fillable = [
    
        //'category_prefix',
        'warranty_number',
        'serial_id',
        //ADD THESE 2 LINES
        'series_id',


        'ferrule',
        'length',
        'weight',
        'butt',
        'balancing',
        'description',
        'owned_by',

    ];




    //connection to images_table
    public function images(){
        return $this-> hasOne(Images::class, 'serial_id', 'serial_id');
    }

    // //connection to categories_table
    // public function categories(){
    //     return $this->belongsTo(Categories::class, 'category_prefix', 'category_prefix');
    // }

    // Add this new relationship method
    public function series(){
        return $this->belongsTo(Series::class, 'series_id', 'series_id');
    }

}
