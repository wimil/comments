<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('commenter')->nullable();
            $table->index(["commenter_id", "commenter_type"]);

            $table->morphs('commentable')->nullable();
            $table->index(["commentable_type", "commentable_id"]);

            $table->text('comment');
            $table->enum('status', ['approved', 'locked']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('comments');
    }
}
