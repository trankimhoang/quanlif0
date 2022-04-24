<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use App\Models\LopMonHoc;
use App\Models\MonHoc;
use App\Models\SV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuanLiLopOnlineController extends Controller
{
    public function index(Request $request) {
        $searchTxt = $request->get('search') ?? null;
        $listLop = LopMonHoc::with(['GV', 'MonHoc'])
            ->where(function ($query) use ($searchTxt) {
                $query->where('ma_lop_mh', 'like', '%' . $searchTxt . '%')
                    ->orWhere('id_zoom', 'like', '%' . $searchTxt . '%')
                    ->orWhere('phong_hoc', 'like', '%' . $searchTxt . '%');
            })
            ->paginate(10);

        return view('admin.lop_online.index', compact('listLop'));
    }

    public function detailLop(Request $request) {
        $lop =  LopMonHoc::with(['GV', 'MonHoc', 'SV'])->where('ma_lop_mh', $request->get('ma_lop_mh'))->first();
        $listMonHoc = MonHoc::all();
        $listSV = SV::all();
        $listGV = GV::all();

        return view('admin.lop_online.edit', compact('lop', 'listMonHoc', 'listSV', 'listGV'));
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

        $isExists = DB::table('svlopmonhoc')
            ->where('ma_sv', $sv->ma_sv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->exists();

        if (!$isExists) {
            DB::table('svlopmonhoc')
                ->insert($arrayInsert);

            Mail::send('email_template.sinhvien', array('lop' => $lop, 'title' => 'Bạn đã được thêm vào lớp học bên dưới'), function($message) use ($sv) {
                $message->to($sv->email, '')->subject('Thông báo lớp học online - ' . env('APP_NAME', ''));
            });

            return response()->json(['success' => '1', 'html' => view('admin.lop_online.ajax.sinhvien_row', compact('sv'))->render()]);
        } else {
            return response()->json(['success' => '0', 'mgs' => 'Sinh viên này đã có trong lớp rồi']);
        }
    }

    public function addGiangVien(Request $request) {
        $gv = GV::where('ma_gv', $request->get('ma_gv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;
        $arrayInsert = [
            'ma_gv' => $gv->ma_gv,
            'ma_lop_mh' => $lop->ma_lop_mh
        ];
        $isExists = DB::table('gvlopmh')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->exists();

        if (!$isExists) {
            DB::table('gvlopmh')
                ->insert($arrayInsert);

            Mail::send('email_template.giangvien', array('lop' => $lop, 'title' => 'Bạn đã được phân công dạy lớp bên dưới'), function($message) use ($gv) {
                $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
            });

            return response()->json(['success' => '1', 'html' => view('admin.lop_online.ajax.giangvien_row', compact('gv'))->render()]);
        } else {
            return response()->json(['success' => '0', 'mgs' => 'Giảng viên này đã có trong lớp rồi']);
        }
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

    public function removeGiangVien(Request $request) {
        $gv = GV::where('ma_gv', $request->get('ma_gv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;

        DB::table('gvlopmh')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->delete();

        Mail::send('email_template.giangvien', array('lop' => $lop, 'title' => 'Bạn đã bị xóa khỏi phân công của lớp bên dưới'), function($message) use ($gv) {
            $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
        });
    }
}
