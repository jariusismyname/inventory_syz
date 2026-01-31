<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cart', function (Blueprint $table) 
    {
            $table->unsignedBigInteger('id');   
            $table->string('name')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('total_amount', 10, 2);
             $table->decimal('price', 10, 2);           
            $table->boolean('status');
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
