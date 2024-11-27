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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 100);
            $table->unsignedInteger('stok');
            $table->decimal('harga', 10, 2);
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
