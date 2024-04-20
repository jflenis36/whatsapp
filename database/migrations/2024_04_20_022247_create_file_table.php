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
        Schema::create('file', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_file_id');
            $table->foreign('type_file_id')->references('id')->on('dominio');
            $table->string('file_url');
            $table->unsignedBigInteger('mesagge_id');
            $table->foreign('mesagge_id')->references('id')->on('mesagge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file');
    }
};
