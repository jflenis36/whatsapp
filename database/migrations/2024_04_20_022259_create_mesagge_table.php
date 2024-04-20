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
        Schema::create('mesagge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id')->references('id')->on('chat');
            $table->boolean('message_from_ziro');
            $table->string('message_text')->nullable();
            $table->unsignedBigInteger('type_message_id');
            $table->foreign('type_message_id')->references('id')->on('dominio');
            $table->unsignedBigInteger('message_status_id')->nullable();
            $table->foreign('message_status_id')->references('id')->on('dominio');
            $table->boolean('writing_state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesagge');
    }
};
