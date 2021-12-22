<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_pendidik', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pendidik_id')->unsigned()->nullable();
            $table->foreign('pendidik_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->integer('mapel_id')->unsigned()->nullable();
            $table->foreign('mapel_id')
                    ->references('id')
                    ->on('mapels')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('wa')->nullable();
            $table->string('ibu')->nullable();
            $table->string('foto')->nullable();
            $table->string('cv')->nullable();
            $table->string('status_dapodik')->nullable();
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
        Schema::dropIfExists('adm_pendidik');
    }
}
