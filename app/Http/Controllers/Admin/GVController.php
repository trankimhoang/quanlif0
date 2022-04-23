<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use Illuminate\Http\Request;

class GVController extends Controller
{
    public function index(Request $request){
        $listGV = GV::with('Phieu')->whereHas('Phieu')->paginate(5);

        return view('admin.gv.index', compact('listGV'));
    }
}
