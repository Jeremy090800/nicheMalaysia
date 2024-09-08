<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//explicitly call the DB method
use Illuminate\Support\Facades\DB;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            //the id of the iamges_table
            $table->id();

            //image_name, it is nullable
            $table->string('images_name')->nullable();

            //created_at and updated_at
            $table->timestamps();

        });

        //image data, it is a longblob type there need a specially created 
        DB::statement("ALTER TABLE images ADD images_data LONGBLOB");


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
