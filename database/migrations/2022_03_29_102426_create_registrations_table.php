<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->string('no_sertifikasi')->nullable();

            $table->string('nama_bujt');
            $table->string('slug');

            $table->text('alamat_operasional');
            $table->string('email_operasional');
            $table->string('noTelp_operasional');
            $table->string('kodePos_operasional');

            $table->string('nama_ruas');
            $table->string('panjang_ruas');
            $table->dateTime('tgl_mulai_operasional');
            $table->foreignId('category_id');
            $table->integer('jumlah_rest_area');
            $table->integer('jumlah_gerbang_tol');

            $table->integer('status');
            $table->boolean('tipe_sertifikasi');
            $table->dateTime('tgl_pendaftaran');
            $table->dateTime('tgl_approve')->nullable();
            $table->dateTime('tgl_masa_berlaku')->nullable();

            $table->json('contact');
            $table->foreignId('user_id');
            $table->foreignId('verifikator')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
