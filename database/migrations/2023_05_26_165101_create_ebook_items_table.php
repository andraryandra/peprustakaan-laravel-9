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
        Schema::create('ebook_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("kategori_id")->constrained("kategoris")->onDelete("cascade");
            $table->foreignId("subkategori_id")->constrained("subkategoris")->onDelete("cascade");
            $table->foreignId('ebook_id')->constrained('ebooks')->onDelete('cascade');

            $table->text("judul_part");
            $table->longText("content_part");

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
        Schema::dropIfExists('ebook_items');
    }
};
