<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('history_discount_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount')->index();
            $table->unsignedBigInteger('wallet')->index();
            $table->boolean('status')->default(false);
            $table->timestamp('created_at');

            $table->foreign('discount')->references('id')->on('discounts');
            $table->foreign('wallet')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_discount_usages');
    }
};
