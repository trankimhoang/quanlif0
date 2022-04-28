<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GV extends Authenticatable
{
    protected $primaryKey = 'ma_gv';
    use Notifiable;

    protected $table = 'giangvien';

    public function Phieu() {
        return $this->hasMany(PhieuGV::class, 'ma_gv', 'ma_gv');
    }

    public function LopHinhThucDay() {
        return $this->belongsToMany(LopMonHoc::class, 'gvlopmhhinhthucday', 'ma_gv', 'ma_lop_mh')->withPivot(['ma_ht', 'tu_ngay', 'den_ngay']);
    }

    public function isBenh() {
        $isBenh = false;

        foreach ($this->Phieu as $item) {
            if (empty($item->ngay_gio_bao_khoi)) {
                $isBenh = true;
                break;
            }
        }

        return $isBenh;
    }
}
