<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author')->nullable();
            $table->string('shabak')->nullable();
            $table->string('serial')->nullable();
            $table->string('publisher')->nullable();
            $table->string('year')->nullable();
            $table->string('version')->nullable();
            $table->integer('createdby');
            $table->foreign('createdby')->references('id')->on('users');
            $table->timestamp('created')->useCurrent();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

        Schema::create('category_book', function(Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->primary(['category_id', 'book_id']);
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('category_book');
    }
}
