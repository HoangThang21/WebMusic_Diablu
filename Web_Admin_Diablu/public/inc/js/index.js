let myMusic = [];

let setplay = 0;

var playButtonId = document.querySelectorAll(".songItem i");

let wave = document.querySelector(".wave");
let currentStart = document.getElementById("currentStart");
let currentEnd = document.getElementById("currentEnd");
let rangeBar = document.getElementById("seek");
let bar2 = document.getElementById("bar2");
let dot_music = document.getElementById("dot_music");
playButtonId.forEach(function (playButton, indexi) {
    playButton.addEventListener("click", () => {
        playButtonId.forEach(function (playButton, indexi) {
            playButton.classList.remove("bi-pause-circle-fill");
            playButton.classList.add("bi-play-circle-fill");
        });
        var playButtonIdplay = playButton.id;
        myMusic = [...myMusic, playButtonIdplay];

        if (myMusic.length > 0) {
            Playing();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            setplay = 1;
        } else {
            PlayingEnd();
            setplay = 0;
        }
        myMusic.splice(0, 1);

        playButton.classList.remove("bi-play-circle-fill");
        playButton.classList.add("bi-pause-circle-fill");
        var id = playButton.title;
        $.ajax({
            type: "POST",
            url: "/ln/" + id,
            dataType: "json",
            data: { _token: csrfToken },
            success: function (data) {
                console.log("wellcome to diablu music");
            },
            error: function (error) {
                console.error("Đã xảy ra lỗi: ", error);
            },
        });
    });
});

let timer = setInterval(displayTimer, 100);
let masterPlay = document.getElementById("masterPlay");
let music = new Audio();
masterPlay.addEventListener("click", () => {
    if (setplay == 0) {
        if (myMusic.length === 0) {
            PlayingEnd();
        } else {
            Playing();
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            setplay = 1;
            timer = setInterval(displayTimer, 100);
        }
    } else {
        PlayingEnd();
        setplay = 0;
    }
});
music.addEventListener("ended", () => {
    myMusic.splice(0, 1);
    setplay = 0;

    if (myMusic.length == 0) {
        PlayingEnd();
    } else {
        Playing();
    }

    playButtonId.forEach(function (playButton1, indexi) {
        playButton1.classList.remove("bi-pause-circle-fill");
        playButton1.classList.add("bi-play-circle-fill");
    });
});
function Playing() {
    music.src = "../../music/" + myMusic[0];
    music.addEventListener("loadedmetadata", function () {
        rangeBar.max = music.duration;
    });
    music.play();
}
function PlayingEnd() {
    music.pause();
    masterPlay.classList.remove("bi-pause-fill");
    masterPlay.classList.add("bi-play-fill");
    wave.classList.remove("active2");
}
let setcurrenttime = 0;
rangeBar.addEventListener("change", handleChangeBar);
function handleChangeBar() {
    setcurrenttime = rangeBar.value;
    a = false;
}

let a = true;
music.addEventListener("timeupdate", displayTimer);

function displayTimer() {
    let { duration, currentTime } = music;
    rangeBar.max = music.duration;
    music.volume = 0.5;
    if (a == false) {
        currentTime = Number(setcurrenttime);
        a = true;
    }
    currentEnd.textContent = formatTimer((duration - currentTime) | "00:00");
    if (!duration) {
        currentStart.textContent = "00:00";
    } else {
        currentStart.textContent = formatTimer(currentTime);
    }
    let pro = parseInt((currentTime / duration) * 100);

    let seek = pro;
    bar2.style.width = `${seek}%`;
    dot_music.style.left = `${seek}%`;
}

function formatTimer(time) {
    const m = Math.floor(time / 60);
    const s = Math.floor(time - m * 60);
    return `${m}:${s < 10 ? "0" : ""}${s}`;
}
const imgdropdow = document.querySelector(".user");
const dropdow = document.querySelector(".user .dropdow");
const dropdo_login = document.querySelector(".user .dropdo_login");
imgdropdow.addEventListener("click", function () {
    if (dropdow) {
        const isHidden =
            dropdow.style.display === "none" ||
            getComputedStyle(dropdow).display === "none";
        dropdow.style.display = isHidden ? "block" : "none";
    }
    if (dropdo_login) {
        const isHidden1 =
            dropdo_login.style.display === "none" ||
            getComputedStyle(dropdo_login).display === "none";
        dropdo_login.style.display = isHidden1 ? "block" : "none";
    }
});
