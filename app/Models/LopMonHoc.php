<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopMonHoc extends Model
{
    protected $table = 'lopmonhoc';
    protected $primaryKey = 'ma_lop_mh';

    protected $fillable = ['id_zoom', 'pass_zoom', 'phong_hoc', 'ca_hoc', 'thu', 'host_key_zoom', 'ma_mh'];

    public function GV() {
        return $this->belongsToMany(GV::class, 'gvlopmh', 'ma_lop_mh', 'ma_gv');
    }

    public function GVHinhThucDay() {
        return $this->belongsToMany(GV::class, 'gvlopmhhinhthucday', 'ma_lop_mh', 'ma_gv')->withPivot(['ma_ht', 'tu_ngay', 'den_ngay']);
    }

    public function SV() {
        return $this->belongsToMany(SV::class, 'svlopmonhoc', 'ma_lop_mh', 'ma_sv');
    }

    public function MonHoc() {
        return $this->hasOne(MonHoc::class, 'ma_mh', 'ma_mh');
    }
}
