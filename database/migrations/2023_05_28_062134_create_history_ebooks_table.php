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
        Schema::create('history_ebooks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('ebook_id')->constrained('ebooks')->onDelete('cascade')->nullable();
            $table->foreignId('ebook_item_id')->constrained('ebook_items')->onDelete('cascade')->nullable();

            $table->text('slug_ebook')->nullable();
            $table->text('slug_ebook_item')->nullable();

            $table->timestamp('accessed_ebook_at')->nullable();
            $table->timestamp('accessed_ebook_item_at')->nullable();


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
        Schema::dropIfExists('history_ebooks');
    }
};
