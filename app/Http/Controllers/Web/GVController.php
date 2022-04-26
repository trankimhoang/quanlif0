<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhieuGV;
use App\Models\PhieuSV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GVController extends Controller
{
    public function index(Request $request) {
        $user = Auth::guard('gv')->user();

        return view('web.gv.index', compact('user'));
    }

    public function sendData(Request $request) {
        $ngayBaoBenh = $request->get('ngay_gio_bao_benh') ?? null;
        $ngayKhoiBenh = $request->get('ngay_gio_bao_khoi') ?? null;
        $user = Auth::guard('gv')->user();

        try {
            if (!empty($ngayBaoBenh)) {
                $phieuBaoBenh = new PhieuGV();
                $phieuBaoBenh->ngay_gio_bao_benh = $ngayBaoBenh;
                $phieuBaoBenh->ma_gv = $user->ma_gv;
                $phieuBaoBenh->save();
            } else if (!empty($ngayKhoiBenh)) {
                DB::table('phieukhaibaogv')
                    ->where('ma_gv', $user->ma_gv)
                    ->where('ngay_gio_bao_khoi', '=', null)
                    ->update([
                        'ngay_gio_bao_khoi' => $ngayKhoiBenh
                    ]);
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect()->back()->with(['success' => 'Khai báo thành công']);
    }
}
