<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieukhaibaosvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieukhaibaosv', function (Blueprint $table) {
            $table->increments('ma_phieu');
            $table->dateTime('ngay_gio_bao_benh');
            $table->dateTime('ngay_gio_bao_khoi');
            $table->unsignedInteger('ma_sv');
            $table->foreign('ma_sv')->references('ma_sv')->on('sinhvien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieukhaibaosv');
    }
}
