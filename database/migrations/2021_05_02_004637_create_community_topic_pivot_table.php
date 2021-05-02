<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityTopicPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_topic', function (Blueprint $table) {
            $table->unsignedBigInteger('community_id');
            $table->foreign('community_id', 'community_id_fk_3813990')->references('id')->on('communities')->onDelete('cascade');
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id', 'topic_id_fk_3813990')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_topic');
    }
}
