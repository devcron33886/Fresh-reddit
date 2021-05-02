<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->longText('post_text');
            $table->integer('votes')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('community_id');
            $table->foreign('community_id', 'community_fk_3813948')->references('id')->on('communities');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_3814020')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
