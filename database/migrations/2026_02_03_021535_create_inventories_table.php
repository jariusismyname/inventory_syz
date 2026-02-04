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
    Schema::create('inventories', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->string('product_code')->unique(); // Added this to match your previous error fix
        $table->integer('product_quantity');
        $table->decimal('product_price', 10, 2);
        $table->string('category_name');
        $table->string('supplier_name');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
