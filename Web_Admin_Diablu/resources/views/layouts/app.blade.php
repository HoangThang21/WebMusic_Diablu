<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diablu musict</title>
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
            <h1>Playlist</h1>
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
                <li class="songItem">
                    <span>01</span>
                    <img src="{{ URL('storage/1.png') }}" alt="" />
                    <h5>
                        On a way
                        <div class="subtitle">Alan</div>
                    </h5>
                    <i
                        class="bi playListPlay bi-play-circle-fill"
                        id="test1.mp3"
                    ></i>
                </li>
            </div>
        </div>
       
        <div class="song_side">
            <nav>
                <ul>
                    <li>Discord <span></span></li>
                    <li>My larbarry</li>
                    <li>audio</li>
                </ul>
                <div class="search">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="tim kiem" />
                </div>
                <div class="user">
                    <img
                        src="storage/1.png"
                        alt=""
                        title="Diablu"
                    />
                </div>
            </nav>
            <div class="content">content</div>
        </div>
        {{-- botom --}}
        <div class="master_play">
            <div class="wave">
                <div class="wave1"></div>
                <div class="wave1"></div>
                <div class="wave1"></div>
            </div>
            <img src="storage/1.png" alt="" />
            <h5>
                On a way <br />
                <div class="subtitle">Alan</div>
            </h5>
            <div class="icon">
                <i class="bi bi-skip-start-fill" id="back"></i>
    
                <i class="bi bi-play-fill" id="masterPlay"></i>
                <i class="bi bi-skip-end-fill" id="next"></i>
            </div>
            <span id="currentStart">0:00</span>
            <div class="bar">
                <!-- {{--
                <audio id="song" controls>
                    <source
                        src="storage/music/holo.mp3"
                        type="audio/mpeg"
                        preload="auto"
                    />
                </audio>
                --}} -->
               {{-- <audio src="" id="song"></audio> --}}
                <input type="range" name="range" id="seek" class="range"  />
    
                <div class="bar2" id="bar2"></div>
                <div class="dot" id="dot_music"></div>
            </div>
            <span id="currentEnd">0:00</span>
    
            <div class="listmusic">
                <ul>
                    <li>
                        <span>01</span>
                        <img src="" alt="" />
                        <h5>
                            On a way
                            <div class="subtitle">Alan</div>
                        </h5>
                        <i
                            class="bi playListPlay bi-play-circle-fill"
                            id="test1.mp3"
                        ></i>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <script type="text/javascript" src="../../inc/js/index.js">

</script>
</body>
</html>
