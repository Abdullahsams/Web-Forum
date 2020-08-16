<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('isi');
            $table->integer('like');
            $table->integer('dislike');
            $table->integer('vote');
            $table->tinyinteger('correct');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');            
            $table->unsignedBigInteger('post_id'); 

            $table->foreign('user_id')->references('id')->on('users');                       
            $table->foreign('post_id')->references('id')->on('posts');                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
