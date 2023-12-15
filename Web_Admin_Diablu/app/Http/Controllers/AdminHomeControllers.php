<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Theloai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminHomeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            // Người dùng đã đăng nhập
            return view(
                'Auth/index',
                [
                    'ttnguoidung' =>  Auth::user(),
                    'user' => User::all(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),


                ]
            );
        }
        return view('Auth.index');
    }
    public function login()
    {
        
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $users = User::where("email", $request->input('email'))->first();

        if (Hash::check($request->password, $users->password)) {
            Auth::login($users);
            if (Auth::check()) {

                return view(
                    'Auth/index',
                    [
                        'ttnguoidung' =>  Auth::user(),
                        'user' => User::all(),
                        'nghesi' => Nghesi::all(),
                        'nhac' => Nhac::all(),
                        'theloai' => Theloai::all(),
                        'album' => Album::all(),


                    ]
                );
            }
        } else {
            return view('Auth.login');
        }
    }
    public function themnguoidung()
    {
        return view('Auth.qlnguoidung.themnguoidung', ['ttnguoidung' => Auth::user()]);
    }

    public function show(string $id, Request $request)
    {

        switch ($id) {
            case 'themnguoidung':
                return view('Auth.qlnguoidung.themnguoidung', ['ttnguoidung' => Auth::user()]);
            case 'hoso':
                return view('Auth.qlnguoidung.profile', ['ttnguoidung' => Auth::user()]);
                // case 'qltheloai':
                //     return view('Auth.qltheloai.home', ['ttnguoidung' => Auth::user()]);
                // case 'qlnhac':
                // case 'qlalbum':
                // case 'qltheloai':
            default:
                break;
        }
        if ($id == 'qlnghesi' || $id == 'qlnhac' || $id == 'qlalbum' || $id == 'qltheloai') {

            if (Auth::check()) {
                return view('Auth.' . $id . '.home', [
                    'ttnguoidung' =>  Auth::user(),
                    'user' => User::all(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                ]);
            } else {
                return view('Auth.login');
            }
        } elseif (strpos($id, '&') !== false) {
            $parts = explode('&', $id);
            if (count($parts) == 3 && is_numeric($parts[0]) && is_numeric($parts[1]) && is_string($parts[2])) {
                if ($parts[2] == 'users') {
                    $user = User::where('id', $parts[0])
                        ->update([
                            'trangthai' => $parts[1],
                        ]);

                    return redirect()->intended('/Administrator');
                }


                // Now you can use $numericPart and $stringPart as needed
            }
        } else {
            return view(
                'Auth/index',
                [
                    'ttnguoidung' =>  Auth::user(),
                    'user' => User::all(),
                    'nghesi' => Nghesi::all(),
                    'nhac' => Nhac::all(),
                    'theloai' => Theloai::all(),
                    'album' => Album::all(),
                ]
            );
        }

        // return view('Auth.index');
    }

    public function themnd(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'txtemail' => ['required', 'email'],
            'txtmatkhau' => ['required'],
            'txthinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'txthoten' => ['required'],
            'optloaind' => ['required'],
        ]);
        $generatedimage = 'image' . time() . '-' . $request->file('txthinh')->getClientOriginalName();
        $request->file('txthinh')->move(public_path('images'), $generatedimage);
        $user = new User();
        $user->name = $request->input('txthoten');
        $user->password = Hash::make($request->input('txtmatkhau'));
        $user->email = $request->input('txtemail');
        $user->image = $generatedimage;
        $user->quyen = $request->input('optloaind');
        $user->trangthai = 1;
        $user->save();
        return redirect()->intended('/Administrator');
    }
    public function themtheloai()
    {
        return view('Auth.qltheloai.themtheloai', ['ttnguoidung' => Auth::user()]);
    }
    public function themnghesi()
    {
        return view('Auth.qlnghesi.themnghesi', ['ttnguoidung' => Auth::user()]);
    }
    public function themnhac()
    {
        return view('Auth.qlnhac.themnhac', ['ttnguoidung' => Auth::user(), 'album' => Album::all(),]);
    }
    public function themalbum()
    {
        return view('Auth.qlalbum.themalbum', [
            'ttnguoidung' => Auth::user(),
            'nghesi' => Nghesi::all(),
            'theloai' => Theloai::all(),
        ]);
    }
    public function themtl(Request $request)
    {
        $request->validate([
            'txttheloai' => ['required'],
        ]);
        $tl = new Theloai();
        $tl->tentheloai = $request->input('txttheloai');
        $tl->save();
        return redirect()->intended('/Administrator/qltheloai');
    }
    public function themns(Request $request)
    {
        $request->validate([
            'txtnghesi' => ['required'],
        ]);
        $ns = new Nghesi();
        $ns->tennghesi = $request->input('txtnghesi');
        $ns->save();
        return redirect()->intended('/Administrator/qlnghesi');
    }
    public function themalb(Request $request)
    {
        $request->validate([
            'txttenalbum' => ['required'],
            'txtnamphathanh' => ['required'],
            'optloains' => ['required'],
            'optloaitl' => ['required'],

        ]);

        $ns = new Album();
        $ns->tenalbum = $request->input('txttenalbum');
        $ns->namphathanh = $request->input('txtnamphathanh');
        $ns->nghesi_idalbum  = $request->input('optloains');
        $ns->theloai_idalbum  = $request->input('optloaitl');
        $ns->save();
        return redirect()->intended('/Administrator/qlalbum');
    }
    public function themmusic(Request $request)
    {
        $request->validate([
            'txttennhac' => ['required'],
            'fnhac' => 'required|mimes:mp3',
            'fhinh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'optloains' => ['required'],

        ]);
        $generatedmusic = 'music' . time() . '-' . $request->file('fnhac')->getClientOriginalName();
        $request->file('fnhac')->move(public_path('music'), $generatedmusic);
        $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
        $request->file('fhinh')->move(public_path('images'), $generatedimage);
        $ns = new Nhac();
        $ns->tennhac = $request->input('txttennhac');
        $ns->nhaclink = $generatedmusic;
        $ns->imagemusic  = $generatedimage;
        $ns->album_idnhac   = $request->input('optloains');
        $ns->save();
        return redirect()->intended('/Administrator/qlnhac');
    }
    public function logout()
    {
        Auth::logout();

        return  redirect()->intended('/Administrator');
    }
    public function chuyentrang(string $id)
    {
        // dd('chuyentrang');
        return view('Auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd('edit');
    }
    public function suatheloai(Request $request)
    {

        $request->validate([
            'txttentheloai' => ['required'],
        ]);
        // dd('', $request->input());
        $tl = Theloai::where('id', $request->input('txtidtheloai'))->update([
            'tentheloai' => $request->input('txttentheloai'),
        ]);

        return redirect()->intended('/Administrator/qltheloai');
    }
    public function suanghesi(Request $request)
    {

        $request->validate([
            'txttennghesi' => ['required'],
        ]);
        // dd('', $request->input());
        $tl = Nghesi::where('id', $request->input('txtidnghesi'))->update([
            'tennghesi' => $request->input('txttennghesi'),
        ]);

        return redirect()->intended('/Administrator/qlnghesi');
    }
    public function suaalbum(Request $request)
    {

        $request->validate([
            'txttenalbum' => ['required'],
            'txtnamphathanh' => ['required'],
            'optloains' => ['required'],
            'optloaitl' => ['required'],

        ]);
        $tl = Album::where('id', $request->input('txtidalbum'))->update([
            'tenalbum' => $request->input('txttenalbum'),
            'namphathanh' => $request->input('txtnamphathanh'),
            'nghesi_idalbum'  => $request->input('optloains'),
            'theloai_idalbum' => $request->input('optloaitl'),
        ]);

        return redirect()->intended('/Administrator/qlalbum');
        // dd('', $request->input());



    }
    public function suanhac(Request $request)
    {
        $request->validate([
            'txttennhac' => ['required'],
            'fnhac' => 'mimes:mp3',
            'fhinh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'optloains' => ['required'],

        ]);
        if ($request->file('fnhac') != null) {
            $generatedmusic = 'music' . time() . '-' . $request->file('fnhac')->getClientOriginalName();
            $request->file('fnhac')->move(public_path('music'), $generatedmusic);
            if ($request->file('fhinh') != null) {

                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'nhaclink' => $generatedmusic,
                        'imagemusic' => $generatedimage,
                        'album_idnhac'   => $request->input('optloains'),

                    ]);
            } else {
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'nhaclink' => $generatedmusic,

                        'album_idnhac'   => $request->input('optloains'),

                    ]);
            }
        } else {
            if ($request->file('fhinh') != null) {

                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        'imagemusic' => $generatedimage,
                        'album_idnhac'   => $request->input('optloains'),

                    ]);
            } else {
                $nhac = Nhac::where('id', $request->input('txtidnhac'))
                    ->update([
                        'tennhac' => $request->input('txttennhac'),
                        

                        'album_idnhac'   => $request->input('optloains'),

                    ]);
            }
        }




        return redirect()->intended('/Administrator/qlnhac');
        // dd('', $request->input());



    }
    public function formchuyensua(string $id)
    {
        if (strpos($id, '-') !== false) {
            list($number, $text) = array_map('trim', explode('-', $id));

            switch ($text) {
                case 'tl':
                    $theloai = Theloai::where('id', $number)->first();

                    return view('Auth.qltheloai.suatheloai', ['ttnguoidung' => Auth::user(), 'theloai' => $theloai]);
                case 'ns':
                    $nghesi = Nghesi::where('id', $number)->first();

                    return view('Auth.qlnghesi.suanghesi', ['ttnguoidung' => Auth::user(), 'nghesi' => $nghesi]);
                case 'alb':

                    $album = Album::where('id', $number)->first();
                    $nghesi = Nghesi::all();
                    $theloai = Theloai::all();
                    return view('Auth.qlalbum.suaalbum', [
                        'ttnguoidung' => Auth::user(), 'album' => $album,
                        'nghesi' => $nghesi, 'theloai' => $theloai,
                    ]);
                case 'music':
                    $music = Nhac::where('id', $number)->first();
                    return view('Auth.qlnhac.suamusic', ['ttnguoidung' => Auth::user(), 'album' => Album::all(), 'music' => $music]);
                    // case 'qltheloai':
                    //     return view('Auth.qltheloai.home', ['ttnguoidung' => Auth::user()]);
                    // case 'qlnhac':
                    // case 'qlalbum':
                    // case 'qltheloai':
                default:
                    break;
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (strpos($id, '-') !== false) {

            list($number, $text) = array_map('trim', explode('-', $id));
            switch ($text) {
                case 'tl':
                    $request->validate([
                        'txttheloai' => ['required'],
                    ]);
                    $tl = Theloai::where('id', $number)
                        ->update([
                            'tentheloai' => $request->input(''),
                        ]);

                    return redirect()->intended('/Administrator/qltheloai');
                    // case 'qltheloai':
                    //     return view('Auth.qltheloai.home', ['ttnguoidung' => Auth::user()]);
                    // case 'qlnhac':
                    // case 'qlalbum':
                    // case 'qltheloai':
                default:
                    break;
            }
        }
        if ($id == 'suand') {
            $request->validate([

                'fhinh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'txthinhanhcu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'txthoten' => ['required'],
            ]);

            if ($request->file('fhinh') != null) {
                $generatedimage = 'image' . time() . '-' . $request->file('fhinh')->getClientOriginalName();
                $request->file('fhinh')->move(public_path('images'), $generatedimage);
                $user = User::where('id', $request->input('txtiduser'))
                    ->update([
                        'name' => $request->input('txthoten'),
                        'image' => $generatedimage
                    ]);
            } else {
                $user = User::where('id', $request->input('txtiduser'))
                    ->update([
                        'name' => $request->input('txthoten'),

                    ]);
            }



            return redirect()->intended('/Administrator/hoso');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        list($number, $text) = array_map('trim', explode('-', $id));
        switch ($text) {
            case 'tl':
                $tl = Theloai::where('id', $number)
                    ->delete();

                return redirect()->intended('/Administrator/qltheloai');
            case 'ns':
                $ns = Nghesi::where('id', $number)
                    ->delete();

                return redirect()->intended('/Administrator/qlnghesi');
            case 'alb':
                $ns = Album::where('id', $number)
                    ->delete();

                return redirect()->intended('/Administrator/qlalbum');
            case 'music':
                $ns = Nhac::where('id', $number)
                    ->delete();

                return redirect()->intended('/Administrator/qlnhac');
                // case 'qltheloai':
                //     return view('Auth.qltheloai.home', ['ttnguoidung' => Auth::user()]);
                // case 'qlnhac':
                // case 'qlalbum':
                // case 'qltheloai':
            default:
                break;
        }

        // dd('destroy');
    }
}