<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNgayGioBaoKhoiToNullablePhieukhaibaogvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieukhaibaogv', function (Blueprint $table) {
            $table->dateTime('ngay_gio_bao_khoi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phieukhaibaogv', function (Blueprint $table) {
            //
        });
    }
}
