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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("order_id");
            $table->string("order_name");
            $table->string("order_user_id")->references("id")->on("filament_users");
            $table->string("order_product_id")->references("product_id")->on("products");
            $table->string("order_notes");
            $table->string("order_status");
            $table->string("order_bukti_pembayaran");
            $table->string("order_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
