<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    // Specify the table name (optional, but recommended for clarity)
    protected $table = 'series';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'series_id';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'series_name',
        'series_description',
    ];

    // Relationship with Products
    public function products()
    {
        return $this->hasMany(Products::class, 'series_id', 'series_id');
    }
}
