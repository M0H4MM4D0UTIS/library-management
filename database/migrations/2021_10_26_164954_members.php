<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->enum('jensiyat', ['man', 'women', 'unknown'])->default('unknown');
            $table->string('email')->nullable();
            $table->boolean('active')->default(true);
            $table->string('codeMeli')->nullable();
            $table->string('codePosti')->nullable();
            $table->string('phone')->nullable();
            $table->string('fullAddress');
            $table->integer('createdby');
            $table->foreign('createdby')->references('id')->on('users');
            //$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('created')->useCurrent();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
