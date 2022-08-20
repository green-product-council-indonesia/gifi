<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('jumlah_jembatan')->after('jumlah_gerbang_tol');
            $table->string('jumlah_jpo')->after('jumlah_gerbang_tol');
            $table->string('jumlah_underpass')->after('jumlah_gerbang_tol');
            $table->string('jumlah_terowongan')->after('jumlah_gerbang_tol');
            $table->string('jumlah_underpass_satwa')->after('jumlah_gerbang_tol');
            $table->string('status_dokumen')->after('status')->nullable();
            $table->string('note_dokumen')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['jumlah_jembatan', 'jumlah_jpo', 'jumlah_underpass', 'jumlah_terowongan', 'jumlah_underpass_satwa', 'status_dokumen', 'note_dokumen']);
        });
    }
}
