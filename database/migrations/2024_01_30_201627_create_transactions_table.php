<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet')->index()->unique();
            $table->unsignedBigInteger('type')->index()->unique();
            $table->bigInteger('amount');
            $table->bigInteger('balance');
            $table->string('from', 50)->nullable();
            $table->string('to', 50)->nullable();
            $table->timestamp('created_at');

            $table->foreign('wallet')->references('id')->on('wallets');
            $table->foreign('type')->references('id')->on('sub_metadatas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
