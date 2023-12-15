<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diablu music</title>
    <link href="../../inc/css/index.css" rel="stylesheet">
	<link rel="shortcut icon" href="../../images/iconlogoweb.png" type="image/png">
	{{-- <script src="../../inc/js/index.js"></script> --}}
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <div class="menu_side">
            <h1>Music Diablu</h1>
            <div class="playlist">
                <h4 class="active">
                    <span></span
                    ><i class="bi bi-music-note-beamed"></i>Playlist
                </h4>
                <h4>
                    <span></span><i class="bi bi-music-note-beamed"></i>Last
                    listening
                </h4>
                <h4>
                    <span></span><i class="bi bi-music-note-beamed"></i>Reco
                </h4>
            </div>
            <div class="menu_song">
                
                @foreach ($nhac as $index => $n)
                    @foreach ($album as $alb)
                        @foreach ($nghesi as $ns)
                            @if ($n->album_idnhac == $alb->id&& $alb->nghesi_idalbum == $ns->id)
                            <li class="songItem">
                                <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <img src="../../images/{{ $n->imagemusic }}" alt="" />
                                <h5>
                                    {{ $n->tennhac }}
                                    <div class="subtitle">{{ $ns->tennghesi }}</div>
                                </h5>
                                <i
                                    class="bi playListPlay bi-play-circle-fill"
                                    id="{{ $n->nhaclink }}"
                                    title="{{ $n->id }}"
                                ></i>
                            </li>
                           
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
       
        <div class="song_side">
            <nav>
                
                <div class="search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="tim kiem" />
                </div>
                
                <div class="user">
                    @if (Auth::guard('api')->check())
                    <img class="img_user" src="../../images/{{ $infouser->image }}" alt="">
                   
                    <div class="dropdow">
                        <div class="info_user">
                            <img src="../../images/{{ $infouser->image }}" alt="">
                            <p>{{ $infouser->name }}</p>
                        </div>
                        <li><a href="">Thông tin tài khoản</a></li>
                        <li><a href="">Thoát</a></li>
                    </div>
                    
                    @else
                    <div class="dropdo_login">
                        <li><a href="/login"><i class="align-middle me-1" data-feather="log-in"></i>Đăng nhập</a></li>
                    </div>
                 
                    @endif
                
                    
                </div>
            </nav>
        
            <div class="content">