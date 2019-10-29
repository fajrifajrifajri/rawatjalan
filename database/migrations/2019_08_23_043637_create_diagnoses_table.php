<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('nama_pasien');
			$table->string('nama_poliklinik');
			$table->string('nama_dokter');
			$table->string('penyakit_atau_gejala');
			$table->string('kode_resep');
			$table->text('keterangan')->nullable();
			$table->integer('total_harga');
			$table->string('bayar')->default("belum");
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
        Schema::dropIfExists('diagnoses');
    }
}
