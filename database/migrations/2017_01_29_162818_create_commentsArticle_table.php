<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentsArticle', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->text('content');
            $table->unsignedInteger('author');
            $table->enum('public', ['YES', 'NO']);
            $table->unsignedInteger('parent_id');
            $table->string('path', 30);
            $table->unsignedInteger('level');
            $table->unsignedInteger('order_parent');
            $table->timestamps();
        });
        Schema::table('commentsArticle', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('commentsArticle');
    }
}
