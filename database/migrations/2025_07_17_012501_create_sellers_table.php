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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("shop_name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("phone",11)->unique();
            $table->timestamp("phone_verified_at")->nullable();
            $table->integer("verification_code")->nullable();
            $table->timestamp("code_expired_at")->nullable();
            $table->string("password");
            $table->boolean("status")->comment("1=>active, 0=>inactive")->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
