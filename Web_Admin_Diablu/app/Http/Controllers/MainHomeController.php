<?php

namespace App\Http\Controllers;

use App\Models\Nhac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainHomeController extends Controller
{
    public function index()
    {
     
        return view("MainMusic");
    }
    public function luotnghe(Request $request, string $id)
    {

        // Xử lý tăng lượt nghe ở đây
        $luotnghe=Nhac::find($id);
        $nhac = Nhac::where('id', $id)->update([
            'luotnghe'=>$luotnghe->luotnghe+1,
        ]);
        // $nhac->luotnghe = $nhac->luotnghe + 1;
        // $nhac->save();
        // Ví dụ: Tăng lượt nghe trong CSDL
        // $id = $request->input('id');
        // Thực hiện logic tăng lượt nghe cho bản ghi có id là $id

        return response()->json(['success' => $id, 'success1' => $request]);
    }
}