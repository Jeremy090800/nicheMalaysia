<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    //specify the data associated with the model (optional)
    protected $table = 'images';

    //define the fillable fields for mass assignment of image data
    protected $fillable = [
        'images_name',
        'images_data',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
