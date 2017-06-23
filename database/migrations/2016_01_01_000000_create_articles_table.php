<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->text('body');
            $table->string('image', 15)->nullable();
            $table->string('slug', 20)->unique();
            $table->text('meta_description');
            $table->string('meta_keywords');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->timestamps();
        });

            Schema::table('articles', function (Blueprint $table) {
                //$table->foreign('category_id')->references('id')->on('categoriesArticles');
                $table->foreign('author_id')->references('id')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
