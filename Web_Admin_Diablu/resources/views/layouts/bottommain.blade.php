

</div>

</div>
{{-- botom --}}
<div class="master_play">
    <div class="wave">
        <div class="wave1"></div>
        <div class="wave1"></div>
        <div class="wave1"></div>
    </div>
    <img src="../../images/{{ $baidau->imagemusic }}" alt=""  class="IgMuSc"/>
    <div class="info_ns">
        <h5 class="NameBai">{{ $baidau->tennhac }}<br />
        
        </h5>
        <div class="subtitle NameNS">{{ $nghesidau->tennghesi }}</div>
    </div>
    <div class="icon">
        <i class="bi bi-skip-start-fill" id="back"></i>

        <i class="bi bi-play-fill" id="masterPlay"></i>
        <i class="bi bi-skip-end-fill" id="next"></i>
    </div>
    <span id="currentStart">0:00</span>
    <div class="bar">
       
        <input type="range" name="range" id="seek" class="range"  />

        <div class="bar2" id="bar2"></div>
        <div class="dot" id="dot_music"></div>
    </div>
    <span id="currentEnd">0:00</span>

    
</div>
</header>
<script type="text/javascript" src="../../inc/js/index.js">

</script>
@if (Auth::guard('api')->check()) 
    <script>
     const user='{{ $infouser->id }}';
    </script>
@endif
<script>

    var csrfToken =` {{ csrf_token() }}`;
    var baidau='{{ $baidau->nhaclink }}';
    var idbaidau='{{ $baidau->id }}';
    
   


</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
