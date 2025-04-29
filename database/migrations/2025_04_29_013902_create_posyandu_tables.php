<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosyanduTables extends Migration
{
    public function up()
    {
        // 1. data_orangtua
        Schema::create('data_orangtua', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('nama_ibu', 100);
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat');
            $table->timestamps();
        });

        // 2. data_anak (FK → data_orangtua)
        Schema::create('data_anak', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('parent_nik', 16);
            $table->string('nama_anak', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('usia', 10);
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->timestamps();

            $table->foreign('parent_nik')
                  ->references('nik')
                  ->on('data_orangtua')
                  ->onDelete('cascade');
        });

        // 3. pengguna (FK → data_orangtua)
        Schema::create('pengguna', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('password', 255);
            $table->timestamps();

            $table->foreign('nik')
                  ->references('nik')
                  ->on('data_orangtua')
                  ->onDelete('cascade');
        });

        // 4. petugas
        Schema::create('petugas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->timestamps();
        });

        // 5. jadwal (FK → petugas)
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->time('waktu');
            $table->unsignedInteger('petugas_id');
            $table->timestamps();

            $table->foreign('petugas_id')
                  ->references('id')
                  ->on('petugas')
                  ->onDelete('cascade');
        });

        // 6. imunisasi (FK → data_anak)
        Schema::create('imunisasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anak_nik', 16);
            $table->date('tanggal_imunisasi');
            $table->string('vaksin', 100);
            $table->enum('status', ['Selesai','Tidak Selesai']);
            $table->timestamps();

            $table->foreign('anak_nik')
                  ->references('nik')
                  ->on('data_anak')
                  ->onDelete('cascade');
        });

        // 7. perkembangan_anak (FK → data_anak)
        Schema::create('perkembangan_anak', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anak_nik', 16);
            $table->date('tanggal');
            $table->decimal('berat_badan', 5, 2);
            $table->string('ket_berat_badan', 255)->nullable();
            $table->decimal('tinggi_badan', 5, 2);
            $table->string('ket_tinggi_badan', 255)->nullable();
            $table->timestamps();

            $table->foreign('anak_nik')
                  ->references('nik')
                  ->on('data_anak')
                  ->onDelete('cascade');
        });

        // 8. stunting (FK → data_anak)
        Schema::create('stunting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anak_nik', 16);
            $table->date('tanggal');
            $table->string('usia', 10);
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('lingkar_kepala', 5, 2);
            $table->text('catatan')->nullable();
            $table->string('status', 50);
            $table->timestamps();

            $table->foreign('anak_nik')
                  ->references('nik')
                  ->on('data_anak')
                  ->onDelete('cascade');
        });

        // 9. vitamin (FK → data_anak)
        Schema::create('vitamin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anak_nik', 16);
            $table->date('tanggal_vitamin');
            $table->string('vitamin', 100);
            $table->enum('status', ['Selesai','Tidak Selesai']);
            $table->timestamps();

            $table->foreign('anak_nik')
                  ->references('nik')
                  ->on('data_anak')
                  ->onDelete('cascade');
        });

        // 10. artikel (mandiri)
        Schema::create('artikel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul', 255);
            $table->string('gambar_artikel', 255);
            $table->text('isi_artikel');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    public{

    }

    public function down()
    {
        // Drop in reverse order of creation to avoid FK constraint errors
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('vitamin');
        Schema::dropIfExists('stunting');
        Schema::dropIfExists('perkembangan_anak');
        Schema::dropIfExists('imunisasi');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('petugas');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('data_anak');
        Schema::dropIfExists('data_orangtua');
    }
}
