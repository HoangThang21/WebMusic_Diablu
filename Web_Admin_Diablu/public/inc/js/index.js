
let myMusic = [];

let setplay = 0;
var playButtonId = document.querySelector(".songItem i");
// let song = document.getElementById("song");
var playButtonIdplay = document.querySelector(".songItem i").id;
let wave = document.querySelector(".wave");
let currentStart = document.getElementById("currentStart");
let currentEnd = document.getElementById("currentEnd");
let rangeBar = document.getElementById("seek");
let bar2 = document.getElementById("bar2");
let dot_music = document.getElementById("dot_music");
playButtonId.addEventListener("click", () => {
    myMusic = [...myMusic, playButtonIdplay];
    if (setplay == 0) {
        if (myMusic.length == 0) {
            music.pause();
        } else {
            masterPlay.classList.remove("bi-play-fill");
            masterPlay.classList.add("bi-pause-fill");
            wave.classList.add("active2");
            Playing();
            setplay = 1;
        }
    }
    console.log(myMusic);
});
let timer = setInterval(displayTimer, 100);
let masterPlay = document.getElementById("masterPlay");
let music = new Audio();
masterPlay.addEventListener("click", () => {
    console.log(setplay);

    if (setplay == 0) {
        if (myMusic.length == 0) {
            PlayingEnd();
        } else {
            console.log("1", myMusic, music.paused);

            Playing();
        }
        masterPlay.classList.remove("bi-play-fill");
        masterPlay.classList.add("bi-pause-fill");
        wave.classList.add("active2");
        setplay = 1;
    } else {
        PlayingEnd();
        setplay = 0;
    }
});
music.addEventListener("ended", () => {
    console.log("end");
    myMusic.splice(0, 1);
    setplay = 0;
    if (myMusic.length == 0) {
        PlayingEnd();
    } else {
        Playing();
    }
    // audioElement.src
});
function Playing() {
    music.src = "../../music/" + myMusic[0];
    music.addEventListener("loadedmetadata", function () {
        rangeBar.max = music.duration;
    });
    music.play();
    timer = setInterval(displayTimer, 100);
}
function PlayingEnd() {
    music.pause();
    masterPlay.classList.remove("bi-pause-fill");
    masterPlay.classList.add("bi-play-fill");
    wave.classList.remove("active2");
    clearInterval(timer);
}
let setcurrenttime = 0;
rangeBar.addEventListener("change", handleChangeBar);
function handleChangeBar() {
    // let { duration, currentTime } = song;
    // rangeBar.min = rangeBar.value;
    setcurrenttime = rangeBar.value;
    a = false;
    // music.currentTime = rangeBar.value;
    console.log("abc:", setcurrenttime, rangeBar.value);

    // console.log(rangeBar.value, music.currentTime);
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
        console.log("chay", music.currentTime);
    }
    currentEnd.textContent = formatTimer((duration - currentTime) | "00:00");
    if (!duration) {
        currentStart.textContent = "00:00";
    } else {
        currentStart.textContent = formatTimer(currentTime);
    }
    let pro = parseInt((currentTime / duration) * 100);
    console.log("chay1", currentTime);
    // rangeBar.value = music.currentTime;
    let seek = pro;
    bar2.style.width = `${seek}%`;
    dot_music.style.left = `${seek}%`;
}

function formatTimer(time) {
    const m = Math.floor(time / 60);
    const s = Math.floor(time - m * 60);
    return `${m}:${s < 10 ? "0" : ""}${s}`;
}
displayTimer();

// let vol_bar = document.getElementsByClassName(".vol_bar");
// let vol = document.getElementById("vol");
// let vol_icon = document.getElementById("vol_icon");
// let dot = document.getElementById("dot");

// vol.addEventListener("change", () => {
//     if (vol.value == 0) {
//         vol_icon.classList.remove("bi bi-volume-down-fill");
//         vol_icon.classList.add("bi bi-volume-mute-fill");
//         vol_icon.classList.remove("bi bi-volume-up-fill");
//     }
//     if (vol.value > 0) {
//         vol_icon.classList.add("bi bi-volume-down-fill");
//         vol_icon.classList.remove("bi bi-volume-mute-fill");
//         vol_icon.classList.remove("bi bi-volume-up-fill");
//     }
//     if (vol.value > 50) {
//         vol_icon.classList.remove("bi bi-volume-down-fill");
//         vol_icon.classList.remove("bi bi-volume-mute-fill");
//         vol_icon.classList.add("bi bi-volume-up-fill");
//     }
//     let vol_a = vol.value;
//     vol_bar.style.width = `${vol_a}%`;
//     vol_bar.style.left = `${vol_a}%`;
//     song.onvolumechange = vol_a / 100;
// });
