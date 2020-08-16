<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
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
        Schema::dropIfExists('comment_posts');
    }
}
