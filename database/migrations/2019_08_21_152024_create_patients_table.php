<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nama_pasien');
			$table->string('kelamin');
			$table->date('tanggal_lahir');
			$table->mediumText('alamat');
			$table->mediumText('rekam_medis');
			$table->string('poliklinik');
			$table->string('periksa')->default("belum");
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
        Schema::dropIfExists('patients');
    }
}
