<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhieuSV;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SVController extends Controller
{
    public function index(Request $request) {
        $user = Auth::guard('sv')->user();

        return view('web.sv.index', compact('user'));
    }

    public function sendData(Request $request) {
        $ngayBaoBenh = $request->get('ngay_gio_bao_benh') ?? null;
        $ngayKhoiBenh = $request->get('ngay_gio_bao_khoi') ?? null;
        $user = Auth::guard('sv')->user();

        try {
            if (!empty($ngayBaoBenh)) {
                $phieuBaoBenh = new PhieuSV();
                $phieuBaoBenh->ngay_gio_bao_benh = $ngayBaoBenh;
                $phieuBaoBenh->ma_sv = $user->ma_sv;
                $phieuBaoBenh->save();
            } else if (!empty($ngayKhoiBenh)) {
                DB::table('phieukhaibaosv')
                    ->where('ma_sv', $user->ma_sv)
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
