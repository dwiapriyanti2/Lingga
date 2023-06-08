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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('jenis_surat');
            $table->string('penerima');
            $table->foreignId('users_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('klasifikasi_id');
            $table->foreign('klasifikasi_id')->references('id')->on('klasifikasis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pengirim');
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('keterangan');
            $table->string('file_surat');
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
        Schema::dropIfExists('surats');
    }
};
