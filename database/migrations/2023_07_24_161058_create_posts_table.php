<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreatePostsTable extends Migration
{
    use HasFactory;

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');//関連づける
            $table->string('title');
            $table->text('content');
            $table->integer('reward');
            $table->dateTime('deadline');
            $table->string('address');
            $table->boolean('is_completed');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
