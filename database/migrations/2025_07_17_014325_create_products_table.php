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
            $table->id();
            $table->string('name', 512);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('purchase_price', 10, 2);
            $table->smallInteger('quantity');
            $table->integer("code");
            $table->text('description');
            $table->boolean('status')->default(1)->comment('1=>active, 0=>inactive');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade')->onUpdate('cascade');
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
