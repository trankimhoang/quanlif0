<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use App\Models\PhieuGV;
use App\Models\PhieuSV;
use App\Models\SV;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index(Request $request) {
        $dataIndex = [];
        $monthNow = Carbon::now()->month;

        // gv
        $dataIndex[] = [
            'title' => 'GV da bi f0 tu truoc toi gio',
            'count' => GV::has('Phieu')->get()->count()
        ];
        $dataIndex[] = [
            'title' => 'GV da bi f0 trong thang nay',
            'count' => GV::has('Phieu')->whereHas('Phieu', function ($query) use ($monthNow) {
                $query->whereMonth('ngay_gio_bao_benh', '=', $monthNow);
            })->get()->count()
        ];

        // sv
        $dataIndex[] = [
            'title' => 'SV da bi f0 tu truoc toi gio',
            'count' => SV::has('Phieu')->get()->count()
        ];
        $dataIndex[] = [
            'title' => 'SV da bi f0 trong thang nay',
            'count' => SV::has('Phieu')->whereHas('Phieu', function ($query) use ($monthNow) {
                $query->whereMonth('ngay_gio_bao_benh', '=', $monthNow);
            })->get()->count()
        ];

        return view('admin.index', compact('dataIndex'));
    }
}
