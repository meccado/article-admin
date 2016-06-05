<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryArticlePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('category_article', function (Blueprint $table) {
          $table->integer('category_id')->unsigned()->index();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
          $table->integer('article_id')->unsigned()->index();
          $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
          $table->primary(['category_id', 'article_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_article');
    }
}
