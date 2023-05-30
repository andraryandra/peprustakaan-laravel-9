<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->string('level', 5);
            $table->tinyInteger('level')->default(0);
            /* Users: 0=>User, 1=>Admin, 2=>Manager */
            $table->enum('status', ["ACTIVE", "INACTIVE"])->default("ACTIVE");
            $table->bigInteger("no_telp")->nullable();
            $table->date("tgl_lahir")->nullable();
            $table->string("photo")->nullable();
            $table->string("tmpt_lahir")->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kelurahan')->nullable();
		    $table->integer('id_kodepos')->nullable();
            $table->enum('keterangan', ["TU", "SISWA"])->default('SISWA')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
