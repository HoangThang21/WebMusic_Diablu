@include('layouts.topmain')
<div>
    <div class="GeneralInfoPhoto">
        <div class="UserProfile" >Thông tin tài khoản</div>
        <div class="Gachngang" ></div>
        <div class="ImageUser" >
          <div class="ImageUserItem" >
            <img class="EllipseImage"  src="../../images/{{ $infouser->image }}" />
          </div>
          <div class="infous">
            <div class="AlaaMohamed" >{{ $infouser->name }}</div>
            <div class="ProductDesignEmail" >{{ $infouser->email }}</div>
            <div class="Urlinstru">
                <div class="ProductDesignName" >Đổi tên</div>
                <div class="ProductDesignImage" >Đổi hình đại diện</div>
            </div>
            <div class="info">
              <form class="fname" action="trangchu/profile/doiten" method="post">
                @csrf
                        @method('put')
                        <input type="hidden" name="usid" value="{{ $infouser->id }}"  >
                <input type="text" placeholder="Nhập tên cần đổi" name ='txtdoiten'required>
                <button type="submit">Xác nhận</button>
              </form>
            </div>
            <div class="image">
            
              <form class="fimage"  action="trangchu/profile/doihinhdaidien" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="usid" value="{{ $infouser->id }}"  >
                <input class="form-control" type="file" name="fhinh"  required>

                <button type="submit">Xác nhận</button>
              </form>
            </div>
          </div>
        </div>
        
      </div>
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