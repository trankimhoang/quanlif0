<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use App\Models\HinhThucDay;
use App\Models\LopMonHoc;
use App\Models\MonHoc;
use App\Models\SV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuanLiLopOnlineController extends Controller
{
    public function index(Request $request)
    {
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

    public function detailLop(Request $request)
    {
        $lop = LopMonHoc::with(['GV', 'MonHoc', 'SV', 'GVHinhThucDay'])->where('ma_lop_mh', $request->get('ma_lop_mh'))->first();
        $listMonHoc = MonHoc::all();
        $listSV = SV::all();
        $listGV = GV::all();
        $listHt = HinhThucDay::all();
        $maToTenHt = DB::table('hinhthucday')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->ma_ht => $item->ten_ht];
            })->toArray();

        return view('admin.lop_online.edit', compact('lop', 'listMonHoc', 'listSV', 'listGV', 'listHt', 'maToTenHt'));
    }

    public function updateLop(Request $request)
    {
        $dataUpdate = $request->toArray();
        $maLopMh = $request->get('ma_lop_mh') ?? null;
        $svLopMh = $request->get('sv') ?? null;
        unset($dataUpdate['_token']);
        unset($dataUpdate['ma_lop_mh']);
        unset($dataUpdate['sv']);
        unset($dataUpdate['gv']);

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

    public function addLop(Request $request)
    {

    }

    public function removeLop(Request $request)
    {
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

            return redirect()->back()->with(['success' => 'Xóa thành công lớp [' . $maLop . ']']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function addSinhVien(Request $request)
    {
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

            Mail::send('email_template.sinhvien', array('lop' => $lop, 'title' => 'Bạn đã được thêm vào lớp học bên dưới'), function ($message) use ($sv) {
                $message->to($sv->email, '')->subject('Thông báo lớp học online - ' . env('APP_NAME', ''));
            });

            return response()->json(['success' => '1', 'html' => view('admin.lop_online.ajax.sinhvien_row', compact('sv'))->render()]);
        } else {
            return response()->json(['success' => '0', 'mgs' => 'Sinh viên này đã có trong lớp rồi']);
        }
    }

    public function addGiangVien(Request $request)
    {
        $maToTenHt = DB::table('hinhthucday')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->ma_ht => $item->ten_ht];
            })->toArray();

        $gv = GV::where('ma_gv', $request->get('ma_gv'))->first() ?? null;
        $lop = LopMonHoc::with('GVHinhThucDay')->where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;
        $arrayInsert = [
            'ma_gv' => $gv->ma_gv,
            'ma_lop_mh' => $lop->ma_lop_mh
        ];
        $tuNgay = $request->get('tu_ngay');
        $denNgay = $request->get('den_ngay');
        $tuNgaySend = $request->get('tu_ngay');
        $denNgaySend = $request->get('den_ngay');

        $tuNgay = \Carbon\Carbon::createFromFormat('d/m/Y', $tuNgay)->format('Y-m-d');
        $denNgay = \Carbon\Carbon::createFromFormat('d/m/Y', $denNgay)->format('Y-m-d');

        $arrayInsertHinhThuc = [
            'ma_gv' => $gv->ma_gv,
            'ma_lop_mh' => $lop->ma_lop_mh,
            'ma_ht' => $request->get('ma_ht'),
            'tu_ngay' => $tuNgay,
            'den_ngay' => $denNgay,
        ];

        $isExists = DB::table('gvlopmh')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->exists();
        $isExistsHt = DB::table('gvlopmhhinhthucday')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->where('ma_ht', $request->get('ma_ht'))
            ->exists();

        if (!$isExists) {
            DB::table('gvlopmh')
                ->insert($arrayInsert);

            $arraySendMail = ['lop' => $lop,
                'title' => 'Bạn đã được phân công dạy lớp bên dưới',
                'hinhthuc' => $maToTenHt[$request->get('ma_ht')],
                'tungay' => $tuNgaySend, 'denngay' => $denNgaySend
            ];

            @Mail::send('email_template.giangvien', $arraySendMail, function ($message) use ($gv) {
                $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
            });
        }

        if (!$isExistsHt) {
            DB::table('gvlopmhhinhthucday')
                ->insert($arrayInsertHinhThuc);
            @Mail::send('email_template.giangvien', $arraySendMail, function ($message) use ($gv) {
                $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
            });
        } else {
            DB::table('gvlopmhhinhthucday')
                ->where('ma_gv', $gv->ma_gv)
                ->where('ma_lop_mh', $lop->ma_lop_mh)
                ->where('ma_ht', $request->get('ma_ht'))
                ->update($arrayInsertHinhThuc);
            // gửi mail thông báo cập nhật hình thức dạy cho giảng viên đó
            $arraySendMail = ['lop' => $lop,
                'title' => 'Lịch phân công dạy của bạn đã bị thay đổi (Cập nhật hình thức dạy)',
                'hinhthuc' => $maToTenHt[$request->get('ma_ht')],
                'tungay' => $tuNgaySend, 'denngay' => $denNgaySend
            ];

            @Mail::send('email_template.giangvien', $arraySendMail, function ($message) use ($gv) {
                $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
            });
        }

        // get lấy dữ liệu mới
        $lop = LopMonHoc::with('GVHinhThucDay')->where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;

        return response()->json(['success' => '1', 'html' => view('admin.lop_online.ajax.giang_vien_rows', ['gvs' => $lop->GVHinhThucDay, 'maToTenHt' => $maToTenHt])->render()]);
    }

    public function removeSinhVien(Request $request)
    {
        $sv = SV::where('ma_sv', $request->get('ma_sv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;

        DB::table('svlopmonhoc')
            ->where('ma_sv', $sv->ma_sv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->delete();

        Mail::send('email_template.sinhvien', array('lop' => $lop, 'title' => 'Bạn đã bị xóa khỏi lớp học bên dưới'), function ($message) use ($sv) {
            $message->to($sv->email, '')->subject('Thông báo lớp học online - ' . env('APP_NAME', ''));
        });
    }

    public function removeGiangVien(Request $request)
    {
        $gv = GV::where('ma_gv', $request->get('ma_gv'))->first() ?? null;
        $lop = LopMonHoc::where('ma_lop_mh', $request->get('ma_lop_mh'))->first() ?? null;
        $maToTenHt = DB::table('hinhthucday')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->ma_ht => $item->ten_ht];
            })->toArray();

        DB::table('gvlopmhhinhthucday')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->where('ma_ht', $request->get('ma_ht'))
            ->delete();

        $checkExistsHinhThuc = DB::table('gvlopmhhinhthucday')
            ->where('ma_gv', $gv->ma_gv)
            ->where('ma_lop_mh', $lop->ma_lop_mh)
            ->exists();

        if (!$checkExistsHinhThuc) {
            DB::table('gvlopmh')
                ->where('ma_gv', $gv->ma_gv)
                ->where('ma_lop_mh', $lop->ma_lop_mh)
                ->delete();
        }

        $arraySendMail = [
            'lop' => $lop,
            'title' => 'Bạn đã bị xóa khỏi phân công của lớp bên dưới',
            'hinhthuc' => $maToTenHt[$request->get('ma_ht')],
            'tungay' => $request->get('tu_ngay'),
            'denngay' => $request->get('den_ngay'),
        ];

        @Mail::send('email_template.giangvien', $arraySendMail, function ($message) use ($gv) {
            $message->to($gv->email, '')->subject('Thông báo phân công lớp học online - ' . env('APP_NAME', ''));
        });
    }
}
