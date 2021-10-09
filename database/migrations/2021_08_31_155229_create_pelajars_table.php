<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_pelajars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pelajar_id')->unsigned();
            $table->foreign('pelajar_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->string('nik');
            $table->string('nisn');
            $table->string('sekolah');
            $table->string('wa');
            $table->string('ibu');
            $table->string('wali');
            $table->string('wa_wali');
            $table->string('foto');
            $table->string('markas');
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
        Schema::dropIfExists('adm_pelajars');
    }
}
