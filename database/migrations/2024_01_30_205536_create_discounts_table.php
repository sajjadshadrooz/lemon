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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->unsignedBigInteger('type')->index();
            $table->bigInteger('amount');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->unsignedInteger('max_usage')->default(1);
            $table->unsignedInteger('max_capacity')->nullable();
            $table->timestamps();

            $table->foreign('type')->references('id')->on('sub_metadatas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
