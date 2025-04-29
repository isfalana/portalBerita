<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->integer('id_menu')->autoIncrement();
            $table->string('nama_menu');
            $table->enum('jenis_menu', ['url' , 'page']);
            $table->string('url_menu');
            $table->string('target_menu');
            $table->integer('urutan_menu');
            $table->integer('parent_menu')->nullable();
            $table->boolean('status_menu')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
