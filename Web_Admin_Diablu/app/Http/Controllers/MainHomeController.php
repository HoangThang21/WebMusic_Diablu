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
        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Auth::guard('api')->check()) {

            return view(
                'MainMusic',
                [
                    'infouser' =>   Auth::guard('api')->user(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                    'baidau' => $nhac,    'nhacsearch' => '',
                    'nghesidau' => $nghesi,
                    'albumdau' => $album,


                ]
            );
        } else {
            return view(
                "MainMusic",
                [
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                    'baidau' => $nhac,
                    'nhacsearch' => '',
                    'nghesidau' => $nghesi,
                    'albumdau' => $album,
                ]
            );
        }
    }
    public function thuvien()
    {
        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Auth::guard('api')->check()) {

            return view(
                'Web.thuvien',
                [
                    'infouser' =>   Auth::guard('api')->user(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                    'baidau' => $nhac,    'nhacsearch' => '',
                    'nghesidau' => $nghesi,
                    'albumdau' => $album,


                ]
            );
        } else {
            return view("Web.login");
        }
    }
    public function login()
    {

        return view("Web.login");
    }
    public function login_dangky(Request $request)
    {
        $request->validate([
            'txtten' => ['required'],
            'email' => ['required'],
            'passwordnew' => ['required'],
            'passwordnewxn' => ['required'],
            'fhinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::where('email', $request->input('email'))->first();

        if ($user != null) {
            return view('Web.register', ['message' => 'Email đã có hãy nhập email khác.']);
        }

        if ($request->input('passwordnew') == $request->input('passwordnewxn')) {
            $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
            $request->file('fhinh')->move(public_path('images'), $generatedimage);
            $us = new User();
            $us->name = $request->input('txtten');
            $us->email = $request->input('email');
            $us->password = Hash::make($request->input('passwordnew'));
            $us->image = $generatedimage;
            $us->quyen = 3;
            $us->trangthai = 1;
            $us->save();
            return redirect()->intended('/login');
        } else {
            $se = 'Lỗi,mật khẩu không giống nhau';
            return view('Web.register', ['message' => $se]);
        }
    }
    public function register()
    {

        return view("Web.register", ['message' => '']);
    }
    public function doimatkhau()
    {
        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        return view("Web.doimatkhau", [
            'infouser' =>   Auth::guard('api')->user(),
            'nghesi' => Nghesi::all(),
            'nhac' => Nhac::all(),
            'theloai' => Theloai::all(),
            'album' => Album::all(),
            'baidau' => $nhac,    'nhacsearch' => '',
            'nghesidau' => $nghesi,
            'albumdau' => $album, 'loi' => ''
        ]);
    }
    public function doiten(Request $request)
    {

        $request->validate([
            'txtdoiten' => ['required'],
            'usid' => ['required'],
        ]);
        $us = User::where('id', $request->input('usid'))->update([
            'name' => $request->input('txtdoiten')
        ]);

        $user = User::where('id', $request->input('usid'))->first();
        Auth::guard('api')->setUser($user);
        return redirect()->intended('/trangchu/profile');
    }
    public function doimatkhau_user(Request $request)
    {

        $request->validate([
            'txtpascu' => ['required'],
            'txtmatkhaumoi' => ['required'],
            'txtmatkhaumoixn' => ['required'],
        ]);
        $user = User::where('id', $request->input('iduser'))->first();
        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Hash::check($request->input('txtpascu'), $user->password)) {
            if ($request->input('txtmatkhaumoi') === $request->input('txtmatkhaumoixn')) {
                $us = User::where('id', $request->input('iduser'))->update([
                    'password' => Hash::make($request->input('txtmatkhaumoi')),
                ]);
                Auth::guard('web')->logout();

                return  redirect()->intended('/login');
            } else {
                $se = 'Lỗi,mật khẩu không giống nhau';
                return view("Web.doimatkhau", [
                    'infouser' =>   Auth::guard('api')->user(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                    'baidau' => $nhac,    'nhacsearch' => '',
                    'nghesidau' => $nghesi,
                    'albumdau' => $album, 'loi' =>  $se
                ]);
            }
        } else {
            $se = 'Lỗi,mật khẩu cũ';
            return view("Web.doimatkhau", [
                'infouser' =>   Auth::guard('api')->user(),
                'nghesi' => Nghesi::all(),
                'nhac' => Nhac::all(),
                'theloai' => Theloai::all(),
                'album' => Album::all(),
                'baidau' => $nhac,    'nhacsearch' => '',
                'nghesidau' => $nghesi,
                'albumdau' => $album, 'loi' =>  $se
            ]);
        }
    }
    public function doihinhdaidien(Request $request)
    {

        $request->validate([
            'fhinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'usid' => ['required'],
        ]);
        $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
        $request->file('fhinh')->move(public_path('images'), $generatedimage);
        $us = User::where('id', $request->input('usid'))->update([
            'image' => $generatedimage,
        ]);

        $user = User::where('id', $request->input('usid'))->first();
        Auth::guard('api')->setUser($user);
        return redirect()->intended('/trangchu/profile');
    }
    public function logout()
    {
        Auth::guard('api')->logout();
        return  redirect()->intended('/trangchu');
    }
    public function trangchu(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $users = User::where("email", $request->input('email'))->first();
        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        if (Hash::check($request->password, $users->password)) {
            if ($users->trangthai != 0) {
                Auth::guard('api')->login($users);
                if (Auth::guard('api')->check()) {

                    return view(
                        'MainMusic',
                        [
                            'infouser' =>   Auth::guard('api')->user(),
                            'nghesi' => Nghesi::all(),
                            'nhac' => Nhac::all(),
                            'theloai' => Theloai::all(),
                            'nhacsearch' => '',
                            'album' => Album::all(),
                            'baidau' => $nhac,
                            'nghesidau' => $nghesi,
                            'albumdau' => $album,


                        ]
                    );
                }
            } else {
                return view('Web.login');
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


        return response()->json(['success' => $id, 'success1' => $request]);
    }
    public function search(Request $request)
    {

        $credentials = $request->validate([
            'searchvv' => ['required'],

        ]);
        $results = Nhac::where('tennhac', 'like', '%' . $request->input('searchvv') . '%')->get();


        $nhacmax = Nhac::max('luotnghe');
        $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        $album = Album::where('id', $nhac->album_idnhac)->first();
        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        return view(
            "MainMusic",
            [
                'infouser' =>   Auth::guard('api')->user(),
                'nghesi' => Nghesi::all(),
                'nhac' => Nhac::all(),
                'nhacsearch' => $results,
                'theloai' => Theloai::all(),
                'album' => Album::all(),
                'baidau' => $nhac,
                'nghesidau' => $nghesi,
                'albumdau' => $album,
            ]
        );
    }
    public function addmusic(Request $request, $user, $ida)
    {
        $user = User::where('id', $user)->first();
        if ($user != null) {
            if (strpos($user->thuvien, $ida) === false) {
                // Nếu không tìm thấy số  trong chuỗi $
                $newThuvien = $user->thuvien . $ida . '-';

                User::where('id', $user->id)
                    ->update([
                        'thuvien' => $newThuvien,
                    ]);

                $nhacmax = Nhac::max('luotnghe');
                $nhac = Nhac::where('luotnghe', $nhacmax)->first();
                $album = Album::where('id', $nhac->album_idnhac)->first();
                $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
                return view(
                    "MainMusic",
                    [
                        'infouser' =>   Auth::guard('api')->user(),
                        'nghesi' => Nghesi::all(),
                        'nhac' => Nhac::all(),
                        'nhacsearch' => '',
                        'theloai' => Theloai::all(),
                        'album' => Album::all(),
                        'baidau' => $nhac,
                        'nghesidau' => $nghesi,
                        'albumdau' => $album,
                    ]
                );
            }
        }
    }
    public function xoamusic(Request $request, $user, $ida)
    {
        // $user = User::where('id', $user)->first();
        // if ($user != null) {
        //     if (strpos($user->thuvien, $ida) === false) {
        //         // Nếu không tìm thấy số  trong chuỗi $
        //         $arrayA = explode('-', $user->thuvien);
        //         $key = array_search($ida, $arrayA);

        //         if ($key !== false) {
        //             unset($arrayA[$key]);
        //             $newThuvien = implode('-', $arrayA);
        //             User::where('id', $user->id)
        //                 ->update([
        //                     'thuvien' => $newThuvien,
        //                 ]);

        //             $nhacmax = Nhac::max('luotnghe');
        //             $nhac = Nhac::where('luotnghe', $nhacmax)->first();
        //             $album = Album::where('id', $nhac->album_idnhac)->first();
        //             $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
        //             return view(
        //                 "Web.profile",
        //                 [
        //                     'infouser' =>   Auth::guard('api')->user(),
        //                     'nghesi' => Nghesi::all(),
        //                     'nhac' => Nhac::all(),
        //                     'nhacsearch' => '',
        //                     'theloai' => Theloai::all(),
        //                     'album' => Album::all(),
        //                     'baidau' => $nhac,
        //                     'nghesidau' => $nghesi,
        //                     'albumdau' => $album,
        //                 ]
        //             );
        //         }
        //     }
        // }
    }
    public function loadmusic(Request $request, string $id)
    {

        $nhac = Nhac::where('id', $id)->first();

        if (!$nhac) {
            return response()->json(['error' => 'Không tìm thấy bản ghi nhạc'], 404);
        }

        $album = Album::where('id', $nhac->album_idnhac)->first();

        if (!$album) {
            return response()->json(['error' => 'Không tìm thấy bản ghi album'], 404);
        }

        $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();

        if (!$nghesi) {
            return response()->json(['error' => 'Không tìm thấy bản ghi nghệ sĩ'], 404);
        }

        // Trả về dữ liệu thành công
        return response()->json(['success' => $nhac, 'successns' => $nghesi]);
    }
    public function profile()
    {
        if (Auth::guard('api')->check()) {
            $nhacmax = Nhac::max('luotnghe');
            $nhac = Nhac::where('luotnghe', $nhacmax)->first();
            $album = Album::where('id', $nhac->album_idnhac)->first();
            $nghesi = Nghesi::where('id', $album->nghesi_idalbum)->first();
            return view(
                "Web.profile",
                [
                    'infouser' =>   Auth::guard('api')->user(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                    'baidau' => $nhac,
                    'nhacsearch' => '',
                    'nghesidau' => $nghesi,
                    'albumdau' => $album,
                ]
            );
        } else {
            return view('Web.login');
        }
    }
}
