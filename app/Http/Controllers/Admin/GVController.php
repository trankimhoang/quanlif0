<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GV;
use Illuminate\Http\Request;

class GVController extends Controller
{
    public function index(Request $request){
        $searchTxt = $request->get('search') ?? null;
        $listGV = GV::with('Phieu')
            ->where(function ($query) use ($searchTxt) {
                $query->where('ten_gv', 'like', '%' . $searchTxt . '%')
                    ->orWhere('email', 'like', '%' . $searchTxt . '%');
            })
            ->whereHas('Phieu')->paginate(5);

        return view('admin.gv.index', compact('listGV'));
    }
}
