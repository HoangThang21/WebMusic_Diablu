

</div>

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
        On a way a <br />
        <div class="subtitle">Alan</div>
    </h5>
    <div class="icon">
        <i class="bi bi-skip-start-fill" id="back"></i>

        <i class="bi bi-play-fill" id="masterPlay"></i>
        <i class="bi bi-skip-end-fill" id="next"></i>
    </div>
    <span id="currentStart">0:00</span>
    <div class="bar">
       {{-- <audio controls>
        <source src="../../music/test1.mp3" type="audio/mp3">
        </audio> --}}
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
                    On a way a
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
<script>

    var csrfToken =` {{ csrf_token() }}`;

</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
