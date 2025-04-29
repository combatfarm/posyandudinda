<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosyanduTables extends Migration
{
    public function up()
    {
        // artikel
        Schema::create('artikel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul', 255);
            $table->string('gambar_artikel', 255);
            $table->text('isi_artikel');
            $table->date('tanggal');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // data_anak
        Schema::create('data_anak', function (Blueprint $table) {
            $table->string('nik', 16);
            $table->string('nama_ibu', 100);
            $table->string('nama_anak', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('usia', 10);
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary('nik');
        });

        // data_orangtua
        Schema::create('data_orangtua', function (Blueprint $table) {
            $table->string('nik', 16);
            $table->string('nama_ibu', 100);
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat');
            $table->string('nama_anak', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary('nik');
        });

        // imunisasi
        Schema::create('imunisasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_anak', 100);
            $table->date('tanggal_imunisasi');
            $table->string('imunisasi', 100);
            $table->enum('status', ['Selesai','Tidak Selesai']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // jadwal
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->time('waktu');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('nik', 16);
            $table->string('nama_ibu', 100);
            $table->string('nama_anak', 100);
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('usia', 10);
            $table->string('tempat_lahir', 100);
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('password', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary('nik');
        });

        // perkembangan_anak
        Schema::create('perkembangan_anak', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_anak', 100);
            $table->date('tanggal');
            $table->decimal('berat_badan', 5, 2);
            $table->string('ket_berat_badan', 255)->nullable();
            $table->decimal('tinggi_badan', 5, 2);
            $table->string('ket_tinggi_badan', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // petugas
        Schema::create('petugas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // stunting
        Schema::create('stunting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_anak', 100);
            $table->date('tanggal');
            $table->string('usia', 10);
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('lingkar_kepala', 5, 2);
            $table->text('catatan')->nullable();
            $table->string('status', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // vitamin
        Schema::create('vitamin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_anak', 100);
            $table->date('tanggal_vitamin');
            $table->string('vitamin', 100);
            $table->enum('status', ['Selesai','Tidak Selesai']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vitamin');
        Schema::dropIfExists('stunting');
        Schema::dropIfExists('petugas');
        Schema::dropIfExists('perkembangan_anak');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('imunisasi');
        Schema::dropIfExists('data_orangtua');
        Schema::dropIfExists('data_anak');
        Schema::dropIfExists('artikel');
    }
}
