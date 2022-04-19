<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieukhaibaogvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieukhaibaogv', function (Blueprint $table) {
            $table->increments('ma_phieu');
            $table->dateTime('ngay_gio_bao_benh');
            $table->dateTime('ngay_gio_bao_khoi');
            $table->unsignedInteger('ma_gv');
            $table->foreign('ma_gv')->references('ma_gv')->on('giangvien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieukhaibaogv');
    }
}
