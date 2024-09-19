<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    //specify the data associated with the model (optional)
    protected $table = 'images';

    //NEWLY ADDED
    //specify the primary key
    protected $primaryKey = 'serial_id';

    //NEWLY ADDED
    //specify that the primary key is a string
    public $incrementing = false;
    protected $keyType = 'string';




    //define the fillable fields for mass assignment of image data
    protected $fillable = [
        
        'serial_id',
        
        //images_file_name
        'images_file_name_1',
        'images_file_name_2',
        'images_file_name_3',
        'images_file_name_4',
        'images_file_name_5',
        'images_file_name_6',

        //images_data
        'images_data_1',
        'images_data_2',
        'images_data_3',
        'images_data_4',
        'images_data_5',
        'images_data_6',
        
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    //connection to products_table
    public function products(){
        return $this->belongsTo(Products::class, 'serial_id', 'serial_id');
    }


}
