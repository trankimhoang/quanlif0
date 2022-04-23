<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhieuSV;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SVController extends Controller
{
    public function index(Request $request) {
        $user = Auth::guard('sv')->user();

        return view('web.sv.index', compact('user'));
    }

    public function sendData(Request $request) {
        $dateTimeF0 = $request->get('ngay_gio_bao_benh') ?? null;
        $user = Auth::guard('sv')->user();

        try {
            $phieuBaoBenh = new PhieuSV();
            $phieuBaoBenh->ngay_gio_bao_benh = $dateTimeF0;
            $phieuBaoBenh->ma_sv = $user->ma_sv;
            $phieuBaoBenh->save();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return redirect()->back()->with(['success' => 'Khai báo thành công']);
    }
}
