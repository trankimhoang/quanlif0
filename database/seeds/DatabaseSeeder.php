<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $monHocs = [];
        $lopMonHoc = [];

        for ($i = 1; $i < 50; ++$i) {
            $monHocs[] = [
                'ma_mh' => $i,
                'ten_mh' => 'mon hoc ' . $i
            ];
            $lopMonHoc[] = [
                'ma_lop_mh' => $i,
                'id_zoom' => '34234234aaa' . $i,
                'pass_zoom' => '2324' . $i,
                'phong_hoc' => 'phong ' . $i,
                'ca_hoc' => 'ca1' . $i,
                'thu' => 'thu 1' . $i,
                'host_key_zoom' => '234234234' . $i,
                'ma_mh' => $i
            ];
        }


        \Illuminate\Support\Facades\DB::table('monhoc')
            ->insert($monHocs);
        \Illuminate\Support\Facades\DB::table('lopmonhoc')
            ->insert($lopMonHoc);


        for($i = 1; $i < 100; ++$i) {
            \Illuminate\Support\Facades\DB::table('sinhvien')
                ->insert([
                    'ma_sv' => $i,
                    'ten_sv' => 'Nguyen Van ' . $i
                ]);
            \Illuminate\Support\Facades\DB::table('phieukhaibaosv')
                ->insert([
                    'ngay_gio_bao_benh' => new \Carbon\Carbon('2022-01-20'),
                    'ngay_gio_bao_khoi' => new \Carbon\Carbon('2022-02-20'),
                    'ma_sv' => $i
                ]);

            \Illuminate\Support\Facades\DB::table('svlopmonhoc')
                ->insert([
                    'ma_sv' => $i,
                    'ma_lop_mh' => rand(1, 50)
                ]);
        }
    }
}
