<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->integer('total_produk');
            $table->integer('subtotal');
            $table->integer('diskon');
            $table->integer('total');
            $table->integer('bayar');
            $table->integer('kembali');
            $table->string('id_kasir');
            $table->string('kasir');
            $table->string('pembeli');
            $table->string('no_meja');
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
        Schema::dropIfExists('transactions');
    }
}
