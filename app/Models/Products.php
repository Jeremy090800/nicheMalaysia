<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    //specify the data associated with the model(optional)
    protected $table = 'products';

    //Define the fillable fields for mass assignment
    protected $fillable = [
    
        'serial_id',
        'ferrule',
        'length',
        'weight',
        'butt',
        'balancing',
    
    ];

}
