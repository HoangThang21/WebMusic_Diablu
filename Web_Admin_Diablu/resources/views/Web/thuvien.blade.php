@include('layouts.topmain')
<div>
  
     
      <div class="table">
        <div class="PodcastItem" >
          <div class="IDprocas">#</div>
          <div class="Title">Thông tin</div>
          <div class="Playlist" >Tên bài</div>
        </div>
        @php
            $inputString = $infouser->thuvien;
            $parts = explode("-", $inputString);
        @endphp
        @foreach ($parts as $index => $part)
          @php
              $currentNumber = (int)$part;
          @endphp
      
              @foreach ($nhac as $index => $n)
              @foreach ($album as $alb)
                  @foreach ($nghesi as $ns)
                      @if ($n->album_idnhac == $alb->id&& $alb->nghesi_idalbum == $ns->id && $currentNumber === $n->id)
                      <div class="PodcastItemMusic" >
                        <div class="ItemGroup" >
                          <div class="AngleLeft" >
                            <div class="Play1" >
                              <li class="songItemALLlabary ">
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
                          <div class="Xoa" title="{{ $n->id }}">
                            Xóa
                            
                        </div>
                        </div>
                      </div>
                      @endif
                  @endforeach
              @endforeach
          @endforeach
        @endforeach
      </div>
</div>
@include('layouts.bottommain')