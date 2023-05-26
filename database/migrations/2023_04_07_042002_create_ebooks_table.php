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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("kategori_id")->constrained("kategoris")->onDelete("cascade");
            $table->foreignId("subkategori_id")->constrained("subkategoris")->onDelete("cascade");

            $table->string("cover");
            $table->string("file");
            $table->string("judul_buku");
            $table->longText("sinopsis");
            $table->string("penulis");
            $table->date("tahun_terbit");

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
        Schema::dropIfExists('ebooks');
    }
};
