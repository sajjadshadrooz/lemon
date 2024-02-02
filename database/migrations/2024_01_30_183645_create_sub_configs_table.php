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

        Schema::create('sub_configs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('title', 50);
            $table->string('comment', 100)->nullable();
            $table->unsignedBigInteger('config')->index();
            $table->timestamps();
        });

        Schema::table('sub_configs',function (Blueprint $table)
        {
            $table->foreign('config')->references('id')->on('configs');
            $table->unique('code','config');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_configs');
    }
};
