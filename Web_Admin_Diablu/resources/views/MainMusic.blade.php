@include('layouts.topmain')
<div>
    <div class="Thumbnail" >
        <img class="ThubmnailPodcast"  src="../../images/adam.jpg" />
        <div class="TitlePlaylist" >
          <div class="Frame1" >
            
              <div class="HowToStartPodcast" >How to start podcast</div>
              
           
            <div class="MonthlyListeners" >40,142 Monthly Listeners</div>
          </div>
          <div class="Frame2" >
            <li class="songItem">
                <i
                    class="bi bi-play-circle-fill Listenmusic"
                    id="b.mp3"
                ></i>
            </li>
          </div>
        </div>
        {{-- <div class="Creator" style="left: 940px; top: 200px; position: absolute; justify-content: flex-start; align-items: center; gap: 15px; display: inline-flex">
          <img class="AngleLeft3" style="width: 50px; height: 50px; position: relative; background: linear-gradient(0deg, #1F1F1F 0%, #1F1F1F 100%); border-radius: 15px" src="https://via.placeholder.com/50x50" />
          <div class="Frame1" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
            <div class="KenAdam" style="color: white; font-size: 16px; font-family: Quicksand; font-weight: 500; word-wrap: break-word">Ken Adam</div>
            <div class="KFollowers" style="color: rgba(255, 255, 255, 0.60); font-size: 14px; font-family: Quicksand; font-weight: 500; word-wrap: break-word">51k Followers</div>
          </div>
        </div> --}}
      </div>
</div>
@include('layouts.bottommain')