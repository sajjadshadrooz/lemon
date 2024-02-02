<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('metadatas', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('title', 50);
            $table->string('comment', 100)->nullable();
            $table->unsignedBigInteger('parent')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('metadatas',function (Blueprint $table)
        {
            $table->foreign('parent')->references('id')->on('metadatas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metadatas');
    }
};
