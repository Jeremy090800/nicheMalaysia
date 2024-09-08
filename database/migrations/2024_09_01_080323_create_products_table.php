<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            //id
            $table->id();
            
            //serieal_id of the product
            $table->string('serial_id')->unique();

            //Diameter of the ferrule
            $table->string('ferrule');

            //length of the cue
            $table->integer('length');

            //weight of the cue
            $table->decimal('weight', 3, 1);

            //butt of the butt
            $table->string('butt');

            //balancing point
            $table->decimal('balancing', 5, 1)->nullable();

            //probabbly image column will need to put here

            //created_at and updated_at
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
