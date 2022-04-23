<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhieuGV;
use App\Models\PhieuSV;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\GV;

class IndexController extends Controller
{
    public function index(Request $request) {
        $dataIndex = [];
        $monthNow = Carbon::now()->month;

        // gv
        $dataIndex[] = [
            'title' => 'GV da bi f0 tu truoc toi gio',
            'count' => PhieuGV::all()->count()
        ];
        $dataIndex[] = [
            'title' => 'GV da bi f0 trong thang nay',
            'count' =>  PhieuGV::whereMonth('ngay_gio_bao_benh', '=', $monthNow)->count()
        ];

        // sv
        $dataIndex[] = [
            'title' => 'SV da bi f0 tu truoc toi gio',
            'count' => PhieuSV::all()->count()
        ];
        $dataIndex[] = [
            'title' => 'SV da bi f0 trong thang nay',
            'count' =>  PhieuSV::whereMonth('ngay_gio_bao_benh', '=', $monthNow)->count()
        ];

        return view('admin.index', compact('dataIndex'));
    }
}
