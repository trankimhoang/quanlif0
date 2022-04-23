<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailPasswordToSinhvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sinhvien', function (Blueprint $table) {
            $table->string('email');
            $table->string('password');
            $table->unsignedInteger('ma_lop')->nullable();
            $table->foreign('ma_lop')->references('ma_lop')->on('lop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinhvien', function (Blueprint $table) {
            //
        });
    }
}
