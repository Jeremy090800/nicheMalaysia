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

            //ferrule of the cue
            $table->string('ferrule');

            //length of the cue
            $table->integer('length');

            //weight of the cue
            $table->decimal('weight', 3, 1);

            //butt of the cue
            $table->string('butt');

            //balancing point (5 digits, 1 decimal, nullable)
            $table->decimal('balancing', 5, 1)->nullable();

            //category type (specify the series of the cue)
            //$table->char('category_type'. 6);

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
