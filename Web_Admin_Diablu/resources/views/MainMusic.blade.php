@include('layouts.topmain')
<div>
  @if ($nhacsearch!=null)
 
    <div class="table">
      <div class="PodcastItem" >
        <div class="IDprocas">#</div>
        <div class="Title">thông tin</div>
        <div class="Playlist" >Tên bài</div>
        <div class="HeadSideHeadphones1" >
          Lượt nghe
        </div>
      </div>
    @foreach ($nhacsearch as $index => $n)
      @foreach ($album as $alb)
          @foreach ($nghesi as $ns)
              @if ($n->album_idnhac == $alb->id&& $alb->nghesi_idalbum == $ns->id)
              <div class="PodcastItemMusic" >
                <div class="ItemGroup" >
                  <div class="AngleLeft" >
                    <div class="Play1" >
                      <li class="songItem">
                        <i
                            class="bi playListPlay bi-play-circle-fill"
                            id="{{ $n->nhaclink }}"
                            title="{{ $n->id }}"
                        ></i>
                    </li>
                    </div>
                  </div>
                  <img class="Rectangleimg"  src="../../images/{{ $n->imagemusic }}" />
                  <div class="FrameInfo" >
                    <div class="YourFriendsInstead" >  {{ $n->tennhac }}</div>
                    <div class="KenAdam" >{{ $ns->tennghesi }}</div>
                  </div>
                  <div class="HowToStartPodcast" > {{ $n->tennhac }}</div>
                  <div class="View" > {{ number_format($n->luotnghe) }}</div>
                  <div class="Add">
                      ...
                      <div class="addmusic">Thêm nhạc vào tài khoản</div>
                  </div>
                 
                  
                </div>
              </div>
              @endif
          @endforeach
      @endforeach
  @endforeach
  
     
      
    
  </div>
{{-- ------------------------------------------------------------------------------------------- --}}
  @else
  <div class="Thumbnail" >
    <img class="ThubmnailPodcast"  src="../../images/adam.jpg" />
    <div class="TitlePlaylist" >
      <div class="Frame1" >
          <div class="HowToStartPodcast" >{{ $baidau->tennhac }}</div>
        <div class="MonthlyListeners" >{{ number_format($baidau->luotnghe) }} Lượt nghe</div>
      </div>
      <div class="Frame2" >
        <li class="songItem">
            <i
                class="bi bi-play-circle-fill Listenmusic"
                id="{{ $baidau->nhaclink }}"
                title="{{ $baidau->id }}"
            ></i>
        </li>
      </div>
    </div>
    <div class="Creator" >
      <img class="AngleLeft"  src="../../images/{{ $baidau->imagemusic }}" />
      <div class="Frame3" >
        <div class="KenAdam" >{{ $nghesidau->tennghesi }}</div>
        <div class="KFolAlbum" >Album {{ $albumdau->tenalbum }}</div>
      </div>
    </div>
  </div>
  <div class="table">
    <div class="PodcastItem" >
      <div class="IDprocas">#</div>
      <div class="Title">Title</div>
      <div class="Playlist" >Playlist</div>
      <div class="HeadSideHeadphones1" >
        Lượt nghe
      </div>
    </div>
    @foreach ($nhac as $index => $n)
      @foreach ($album as $alb)
          @foreach ($nghesi as $ns)
              @if ($n->album_idnhac == $alb->id&& $alb->nghesi_idalbum == $ns->id)
              <div class="PodcastItemMusic" >
                <div class="ItemGroup" >
                  <div class="AngleLeft" >
                    <div class="Play1" >
                      <li class="songItem">
                        <i
                            class="bi playListPlay bi-play-circle-fill"
                            id="{{ $n->nhaclink }}"
                            title="{{ $n->id }}"
                        ></i>
                    </li>
                    </div>
                  </div>
                  <img class="Rectangleimg"  src="../../images/{{ $n->imagemusic }}" />
                  <div class="FrameInfo" >
                    <div class="YourFriendsInstead" >  {{ $n->tennhac }}</div>
                    <div class="KenAdam" >{{ $ns->tennghesi }}</div>
                  </div>
                  <div class="HowToStartPodcast" > {{ $n->tennhac }}</div>
                  <div class="View" > {{ number_format($n->luotnghe) }}</div>
                 
                 
                  
                </div>
              </div>
              @endif
          @endforeach
      @endforeach
  @endforeach
  
     
      
    
  </div>
  @endif
  
    
</div>
@include('layouts.bottommain')