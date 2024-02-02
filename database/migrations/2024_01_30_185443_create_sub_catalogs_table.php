<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sub_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('title', 50);
            $table->string('comment', 100)->nullable();
            $table->unsignedBigInteger('catalog')->index();
            $table->timestamps();
        });

        Schema::table('sub_catalogs',function (Blueprint $table)
        {
            $table->foreign('catalog')->references('id')->on('catalogs');
            $table->unique('code','catalog');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_catalogs');
    }
};
