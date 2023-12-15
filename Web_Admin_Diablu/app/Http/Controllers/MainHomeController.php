<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Theloai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainHomeController extends Controller
{
    public function index()
    {

        return view("MainMusic",
        [
            'nghesi' => Nghesi::all(),
            'nhac' => Nhac::all(),
            'theloai' => Theloai::all(),
            'album' => Album::all(),
        ]);
    }
    public function login()
    {

        return view("Web.login");
    }
    public function trangchu(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $users = User::where("email", $request->input('email'))->first();

        if (Hash::check($request->password, $users->password)) {
            Auth::guard('api')->login($users);
            if (Auth::guard('api')->check()) {

                return view(
                    'MainMusic',
                    [
                        'infouser' =>   Auth::guard('api')->user(),
                        'nghesi' => Nghesi::all(),
                        'nhac' => Nhac::all(),
                        'theloai' => Theloai::all(),
                        'album' => Album::all(),


                    ]
                );
            }
        } else {
            return view('Web.login');
        }
    }
    public function luotnghe(Request $request, string $id)
    {

        // Xử lý tăng lượt nghe ở đây
        $luotnghe = Nhac::find($id);
        $nhac = Nhac::where('id', $id)->update([
            'luotnghe' => $luotnghe->luotnghe + 1,
        ]);
        // $nhac->luotnghe = $nhac->luotnghe + 1;
        // $nhac->save();
        // Ví dụ: Tăng lượt nghe trong CSDL
        // $id = $request->input('id');
        // Thực hiện logic tăng lượt nghe cho bản ghi có id là $id

        return response()->json(['success' => $id, 'success1' => $request]);
    }
}