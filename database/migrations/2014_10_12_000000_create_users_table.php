<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',100);
            $table->string('name',100)->unique();
            // $table->string('email',50)->unique();
            $table->enum('privilege',array('admin','owner','manajer','receptionist'));
            $table->integer('id_role')->default(5);
            $table->string('password');
            $table->string('alamat',200)->nullable();
            $table->string('telepon',15)->nullable();
            $table->string('foto',50);
            $table->string('pertanyaan_pemulih',200)->nullable();
            $table->string('jawaban_pemulih',200)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->enum('activated',array('yes','no'))->default('yes');
            $table->enum('is_delete',array('yes','no'))->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
