<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesCommentsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('comment', 1000);
            $table->bigInteger('ip')->nullable();
            $table->string('ua')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            $table->foreign('parent_id')->references('id')->on('articles_comments')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles_comments');
	}

}
