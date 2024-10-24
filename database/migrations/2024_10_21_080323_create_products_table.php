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
            

            //warranty_number of the product
            $table->string('warranty_number',255)->unique();

            //serieal_id of the product
            $table->string('serial_id')->unique();

            // //category type (specify the series of the cue)
            // $table->char('category_prefix', 6);

            // Add foreign key for series
            $table->unsignedBigInteger('series_id');
            $table->foreign('series_id')->references('series_id')->on('series')->onDelete('cascade');

            //ferrule of the cue
            $table->decimal('ferrule',5 ,1);

            //length of the cue
            $table->decimal('length',5 ,1);

            //weight of the cue
            $table->decimal('weight',3 ,1);

            //butt of the cue
            $table->decimal('butt',5 ,1);

            //balancing point (5 digits, 1 decimal)
            $table->decimal('balancing',5 ,1);

            //product_description
            $table->text('description')->nullable();

            //NEWLY CREATED
            //owned_by
            $table->text('owned_by')->nullable();

            //created_at and updated_at
            $table->timestamps();


            // // Ensure that serial_id and category_prefix combination is unique
            // $table->unique(['serial_id', 'category_prefix']);

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
