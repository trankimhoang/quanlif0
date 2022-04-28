<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LopMonHoc;
use App\Models\PhieuGV;
use App\Models\PhieuSV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GVController extends Controller
{
    public function index(Request $request) {
        $user = Auth::guard('gv')->user();
        $maToTenHt = DB::table('hinhthucday')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->ma_ht => $item->ten_ht];
            })->toArray();

        return view('web.gv.index', compact('user', 'maToTenHt'));
    }

    public function sendData(Request $request) {
        $ngayBaoBenh = $request->get('ngay_gio_bao_benh') ?? null;
        $ngayKhoiBenh = $request->get('ngay_gio_bao_khoi') ?? null;
        $user = Auth::guard('gv')->user();
        $lops = $request->get('lop') ?? null;
        $hts = $request->get('ht') ?? null;
        $tungays = $request->get('tu_ngay') ?? null;
        $denngays = $request->get('den_ngay') ?? null;
        $arrayInsertLopMh = [];
        $arrayInsertLopMhHt = [];

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

            foreach ($lops as $key => $lop) {
                $ht = $hts[$key] ?? null;
                $tungay = $tungays[$key] ?? null;
                $denngay = $denngays[$key] ?? null;
                $arrayInsertLopMh[$lop . '_' . $user->ma_gv] = [
                    'ma_gv' => $user->ma_gv,
                    'ma_lop_mh' => $lop
                ];
                $arrayInsertLopMhHt[$lop . '_' . $user->ma_gv . '_' . $ht] = [
                    'ma_gv' => $user->ma_gv,
                    'ma_lop_mh' => $lop,
                    'ma_ht' => $ht,
                    'tu_ngay' => $tungay,
                    'den_ngay' => $denngay
                ];
            }
            DB::table('gvlopmh')
                ->where('ma_gv', $user->ma_gv)
                ->delete();
            DB::table('gvlopmhhinhthucday')
                ->where('ma_gv', $user->ma_gv)
                ->delete();

            DB::table('gvlopmh')
                ->insert($arrayInsertLopMh);
            DB::table('gvlopmhhinhthucday')
                ->insert($arrayInsertLopMhHt);

        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect()->back()->with(['success' => 'Khai báo thành công']);
    }

    public function chiTietLop(Request $request) {
        $lop = LopMonHoc::find($request->get('ma_lop_mh')) ?? null;

        if (empty($lop)) {
            abort(404);
        }

        return view('web.gv.chitietlop', compact('lop'));
    }
}
