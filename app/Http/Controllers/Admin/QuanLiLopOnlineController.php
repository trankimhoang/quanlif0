<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LopMonHoc;
use App\Models\MonHoc;
use App\Models\SV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuanLiLopOnlineController extends Controller
{
    public function index() {
        $listLop = LopMonHoc::with(['GV', 'MonHoc'])->paginate(10);

        return view('admin.lop_online.index', compact('listLop'));
    }

    public function detailLop(Request $request) {
        $lop =  LopMonHoc::with(['GV', 'MonHoc', 'SV'])->where('ma_lop_mh', $request->get('ma_lop_mh'))->first();
        $listMonHoc = MonHoc::all();
        $listSV = SV::all();

        return view('admin.lop_online.edit', compact('lop', 'listMonHoc', 'listSV'));
    }

    public function updateLop(Request $request) {
        $dataUpdate = $request->toArray();
        $maLopMh = $request->get('ma_lop_mh') ?? null;
        $svLopMh = $request->get('sv') ?? null;
        unset($dataUpdate['_token']);
        unset($dataUpdate['ma_lop_mh']);
        unset($dataUpdate['sv']);

        foreach ($svLopMh as $key => $item) {
            $svLopMh[$key] = [
                'ma_sv' => $item,
                'ma_lop_mh' => $maLopMh
            ];
        }

        try {
            DB::table('lopmonhoc')
                ->where('ma_lop_mh', $maLopMh)
                ->update($dataUpdate);
            DB::table('svlopmonhoc')
                ->where('ma_lop_mh', $maLopMh)
                ->delete();
            DB::table('svlopmonhoc')
                ->insert($svLopMh);

            return redirect()->back()->with(['success' => 'Cập nhật lớp học [' . $maLopMh . '] thành công']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function addLop(Request $request) {

    }

    public function removeLop(Request $request) {
        $maLop = $request->get('ma_lop_mh');

        try {
            DB::table('svlopmonhoc')
                ->where('ma_lop_mh', $maLop)
                ->delete();
            DB::table('gvlopmh')
                ->where('ma_lop_mh', $maLop)
                ->delete();
            DB::table('lopmonhoc')
                ->where('ma_lop_mh', $maLop)
                ->delete();

            return redirect()->back()->with(['success' => 'Xóa thành công lớp ['. $maLop . ']']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function addSinhVien(Request $request) {
        $sv = SV::where('ma_sv', $request->get('ma_sv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;
        $arrayInsert = [
            'ma_sv' => $sv->ma_sv,
            'ma_lop_mh' => $lop->ma_lop_mh
        ];
        DB::table('svlopmonhoc')
            ->insert($arrayInsert);

        Mail::send('email_template.sinhvien', array('lop' => $lop, 'title' => 'Bạn đã được thêm vào lớp học bên dưới'), function($message) use ($sv) {
            $message->to($sv->email, '')->subject('Thông báo lớp học online - ' . env('APP_NAME', ''));
        });

        return view('admin.lop_online.ajax.sinhvien_row', compact('sv'));
    }

    public function removeSinhVien(Request $request) {
        $sv = SV::where('ma_sv', $request->get('ma_sv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;

        DB::table('svlopmonhoc')
            ->where('ma_sv', $sv->ma_sv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->delete();

        Mail::send('email_template.sinhvien', array('lop' => $lop, 'title' => 'Bạn đã bị xóa khỏi lớp học bên dưới'), function($message) use ($sv) {
            $message->to($sv->email, '')->subject('Thông báo lớp học online - ' . env('APP_NAME', ''));
        });
    }
}
