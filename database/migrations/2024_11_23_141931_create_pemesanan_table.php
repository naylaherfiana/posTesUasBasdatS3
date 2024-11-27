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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah')->unsigned();
            $table->decimal('total_harga', 12, 2); // Total harga transaksi
            $table->foreignId('diskon_id')->nullable()->constrained('diskon')->onDelete('set null');
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
        Schema::dropIfExists('pemesanan');
    }
};
