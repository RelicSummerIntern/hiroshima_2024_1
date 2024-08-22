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
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');//関連づける
            $table->BigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');//関連づける
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
