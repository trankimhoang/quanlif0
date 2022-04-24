<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use App\Models\SV;
use Illuminate\Http\Request;

class SVController extends Controller
{
    public function index(Request $request){
        $searchTxt = $request->get('search') ?? null;
        $listSV = SV::with('Phieu')
            ->where(function ($query) use ($searchTxt) {
                $query->where('ten_sv', 'like', '%' . $searchTxt . '%')
                    ->orWhere('email', 'like', '%' . $searchTxt . '%');
            })->whereHas('Phieu')->paginate(5);

        return view('admin.sv.index', compact('listSV'));
    }
}
