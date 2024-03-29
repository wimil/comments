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
            $table->string('commenter_id')->nullable();
            $table->string('commenter_type')->nullable();
            $table->index(["commenter_id", "commenter_type"]);

            $table->string("commentable_type");
            $table->string("commentable_id");
            $table->index(["commentable_type", "commentable_id"]);


            $table->text('comment');
            $table->enum('status', ['approved', 'locked']);

            if (config('comments.timestamps')) {
                $table->timestamps();
            } else {
                $table->bigInteger('updated_at')->nullable();
                $table->bigInteger('created_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::drop('comments');
    }
}
