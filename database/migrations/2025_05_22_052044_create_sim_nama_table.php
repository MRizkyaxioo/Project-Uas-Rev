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
        Schema::create('sim_nama', function (Blueprint $table) {
            $table->string('Nim', 20)->primary();
            $table->string('Nama_Lengkap', 100);
            $table->date('Tanggal_Lahir');

            // Menunggu API, jadi belum diberi foreign key
            $table->tinyInteger('Id_Jk')->nullable(); // Jenis Kelamin
            $table->unsignedInteger('Id_Agama')->nullable();
            $table->unsignedInteger('Id_Provinsi')->nullable();
            $table->unsignedInteger('Id_Kabupaten')->nullable();
            $table->unsignedInteger('Id_Kecamatan')->nullable();
            $table->unsignedInteger('Id_Kelurahan')->nullable();

            $table->text('Alamat')->nullable();
            $table->string('Email', 30)->nullable();
            $table->string('Foto_Profil', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sim_nama');
    }
};
