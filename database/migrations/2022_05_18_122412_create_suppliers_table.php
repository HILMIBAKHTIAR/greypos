<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan', 45)->nullable();
            $table->string('nama_supplier', 45)->nullable();
            $table->string('no_telp')->nullable();
            $table->string('situs_web', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('alamat', 45);
            $table->string('kota', 45)->nullable();
            $table->string('kode_pos', 45)->nullable();
            $table->string('catatan', 45)->nullable();
            $table->timestamps();
            # Indexes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
