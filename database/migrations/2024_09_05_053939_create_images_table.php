<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            // The id of the images_table
            $table->id();

            // Foreign key for serial_id from products
            $table->string('serial_id');
            $table->foreign('serial_id')->references('serial_id')-> on('products')->onDelete('cascade');

            // Add columns for original file names
            $table->string('images_file_name_1')->nullable();
            $table->string('images_file_name_2')->nullable();
            $table->string('images_file_name_3')->nullable();
            $table->string('images_file_name_4')->nullable();
            $table->string('images_file_name_5')->nullable();
            $table->string('images_file_name_6')->nullable();

            // Created_at and updated_at
            $table->timestamps();
        });

        // Image data, it is a longblob type
        DB::statement("ALTER TABLE images ADD images_data_1 LONGBLOB");
        DB::statement("ALTER TABLE images ADD images_data_2 LONGBLOB");
        DB::statement("ALTER TABLE images ADD images_data_3 LONGBLOB");
        DB::statement("ALTER TABLE images ADD images_data_4 LONGBLOB");
        DB::statement("ALTER TABLE images ADD images_data_5 LONGBLOB");
        DB::statement("ALTER TABLE images ADD images_data_6 LONGBLOB");
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
