<?php


use App\Http\Controllers\AdminHomeControllers;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateOnceWithBasicAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// php artisan serve --port=8001


Route::get('/Administrator/login', function () {
    return view('login');
})->middleware('auth');
Route::resource(
    "/Administrator",
    AdminHomeControllers::class
);
Route::get('/Administrator/login', [
    AdminHomeControllers::class, 'login'
])->name('login');
Route::get('/Administrator/user', [
    AdminHomeControllers::class, 'index'
])->name('Admin');
Route::get('/Administrator/suand', [
    AdminHomeControllers::class, 'update'
]);
Route::put('/Administrator/qltheloai/suatheloai', [
    AdminHomeControllers::class, 'suatheloai'
]);
Route::put('/Administrator/qlnghesi/suanghesi', [
    AdminHomeControllers::class, 'suanghesi'
]);
Route::put('/Administrator/qlalbum/suaalbum', [
    AdminHomeControllers::class, 'suaalbum'
]);
Route::put('/Administrator/qlnhac/suanhac', [
    AdminHomeControllers::class, 'suanhac'
]);
Route::get('/logout', [AdminHomeControllers::class, 'logout'])->name('logout');

Route::get('/Administrator/themnguoidung', [
    AdminHomeControllers::class, 'themnguoidung'
])->name('themnguoidung');


Route::get('/Administrator/qltheloai/themtheloai', [
    AdminHomeControllers::class, 'themtheloai'
]);
Route::get('/Administrator/qltheloai/xoatheloai&{id}', [
    AdminHomeControllers::class, 'destroy'
]);
Route::get('/Administrator/qltheloai/suatheloai&{id}', [
    AdminHomeControllers::class, 'formchuyensua'
]);
Route::get('/Administrator/qlnghesi/themnghesi', [
    AdminHomeControllers::class, 'themnghesi'
]);
Route::get('/Administrator/qlnghesi/xoanghesi&{id}', [
    AdminHomeControllers::class, 'destroy'
]);
Route::get('/Administrator/qlnghesi/suanghesi&{id}', [
    AdminHomeControllers::class, 'formchuyensua'
]);
Route::get('/Administrator/qlalbum/themalbum', [
    AdminHomeControllers::class, 'themalbum'
]);
Route::get('/Administrator/qlalbum/xoaalbum&{id}', [
    AdminHomeControllers::class, 'destroy'
]);
Route::get('/Administrator/qlalbum/suaalbum&{id}', [
    AdminHomeControllers::class, 'formchuyensua'
]);
Route::get('/Administrator/qlnhac/themnhac', [
    AdminHomeControllers::class, 'themnhac'
]);
Route::get('/Administrator/qlnhac/xoanhac&{id}', [
    AdminHomeControllers::class, 'destroy'
]);
Route::get('/Administrator/qlnhac/suanhac&{id}', [
    AdminHomeControllers::class, 'formchuyensua'
]);
// Route::get('/Administrator/{id}&{username}', [
//     AdminHomeControllers::class, 'ktuser'
// ])->name('ktuser')->where('id', '[0-9]+')->where('username', '[a-z][A-Z]+');
// Route::get('/Administrator', [
//     AdminHomeControllers::class, 'kichhoatnguoidung'
// ])->name('kichhoatnguoidung');
Route::post('/Administrator/themnd', [
    AdminHomeControllers::class, 'themnd'
])->name('themnd');
Route::post('/Administrator/themtl', [
    AdminHomeControllers::class, 'themtl'
])->name('themtl');
Route::post('/Administrator/themns', [
    AdminHomeControllers::class, 'themns'
])->name('themns');
Route::post('/Administrator/themalb', [
    AdminHomeControllers::class, 'themalb'
])->name('themalb');
Route::post('/Administrator/themnhac', [
    AdminHomeControllers::class, 'themmusic'
])->name('themnhac');
// Route::post('/Administrator/suand', [
//     AdminHomeControllers::class, 'suand'
// ])->name('suand');
Route::get('/Administrator/qlnghesi', [
    AdminHomeControllers::class, 'chuyentrang'
])->name('qlnghesi');
Route::get('/Administrator/qlnhac', [
    AdminHomeControllers::class, 'chuyentrang'
])->name('qlnhac');
Route::get('/Administrator/qlalbum', [
    AdminHomeControllers::class, 'chuyentrang'
])->name('qlalbum');
Route::get('/Administrator/qltheloai', [
    AdminHomeControllers::class, 'chuyentrang'
])->name('qltheloai');