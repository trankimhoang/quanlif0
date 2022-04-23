<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use App\Models\SV;
use Illuminate\Http\Request;

class SVController extends Controller
{
    public function index(Request $request){
        $listSV = SV::with('Phieu')->whereHas('Phieu')->paginate(5);

        return view('admin.sv.index', compact('listSV'));
    }
}
