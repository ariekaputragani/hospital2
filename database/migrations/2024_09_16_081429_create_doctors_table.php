<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('pp')->nullable();
            $table->foreignId('poli_id')->nullable();
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->text('desc')->nullable();
            $table->date('birthdate');
            $table->string('phone', 20);
            $table->string('email');
            $table->text('address');
            $table->time('sen_start')->nullable();
            $table->time('sen_end')->nullable();
            $table->time('sel_start')->nullable();
            $table->time('sel_end')->nullable();
            $table->time('rab_start')->nullable();
            $table->time('rab_end')->nullable();
            $table->time('kam_start')->nullable();
            $table->time('kam_end')->nullable();
            $table->time('jum_start')->nullable();
            $table->time('jum_end')->nullable();
            $table->time('sab_start')->nullable();
            $table->time('sab_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
