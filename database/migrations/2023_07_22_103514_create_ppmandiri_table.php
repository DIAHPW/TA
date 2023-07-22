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
        Schema::create('ppmandiri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_buku');
            $table->string('nama');
            $table->string('nisn');
            $table->string('judul');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->date('tgl_perpanjang')->nullable();
            $table->integer('denda')->nullable();
            $table->boolean('status')->default(false);


            $table->foreign('id_buku')->references('id')->on('databukus');
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
        Schema::dropIfExists('ppmandiri');
    }
};
