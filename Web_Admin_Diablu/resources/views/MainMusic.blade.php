@include('layouts.topmain')
<div>
    <div class="Thumbnail" >
        <img class="ThubmnailPodcast"  src="../../images/adam.jpg" />
        <div class="TitlePlaylist" >
          <div class="Frame1" >
              <div class="HowToStartPodcast" >How to start podcast</div>
            <div class="MonthlyListeners" >40,142 Lượt nghe</div>
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
        <div class="Creator" >
          <img class="AngleLeft"  src="../../images/1.png" />
          <div class="Frame3" >
            <div class="KenAdam" >Ken Adam</div>
            <div class="KFolAlbum" >Album Top</div>
          </div>
        </div>
      </div>
      <table>
        <tr>
          <th>#</th>
          <th>Thông tin</th>
          <th>Tên nhạc</th>
          <th>Lượt nghe</th>
          <th></th>
        </tr>
        <tr>
          <td>
            <li class="songItem">
             
              <i
                  class="bi bi-play-circle-fill Listenmusic"
                  id="b.mp3"
              ></i>
            </li>
          </td>
          <td> 
            <img src="../../images/1.png" alt="" />
            <h5>
                On a way
                <div class="subtitle">Alan</div>
            </h5>
          </td>
          
        </tr>
      </table>
</div>
@include('layouts.bottommain')