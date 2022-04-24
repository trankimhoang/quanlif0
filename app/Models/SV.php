<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SV extends Authenticatable
{
    protected $primaryKey = 'ma_sv';
    use Notifiable;

    protected $table = 'sinhvien';

    public function Phieu() {
        return $this->hasMany(PhieuSV::class, 'ma_sv', 'ma_sv');
    }

    public function Lop() {
        return $this->hasOne(Lop::class, 'ma_lop', 'ma_lop');
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
