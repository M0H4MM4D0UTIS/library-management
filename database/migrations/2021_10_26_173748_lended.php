<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lended extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lended', function (Blueprint $table) {
            $table->id();
            $table->integer('operatorid');
            $table->foreign('operatorid')->references('id')->on('users');
            $table->integer('memberid');
            $table->foreign('memberid')->references('id')->on('members');
            $table->boolean('tahvil')->default(false);
            $table->timestamp('created')->useCurrent();
            $table->timestamp('tarikhTahvil')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lended');
    }
}
