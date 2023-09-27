var x = 0;
var time;
var cr = 0;
var timebar;

function showSongs(){
    if(document.getElementById("songlist")){
        var table = document.getElementById("songlist");
        table.remove();
    }
    
    var content = document.getElementById("song-container");
    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("id", "songlist");


    for(var i = 0; i < song.length; i++){
        var newLine = document.createElement("tr");
        newTable.appendChild(newLine);
       
        var songname = document.createElement("td");
        songname.textContent = song[i].songname;
        songname.setAttribute("id", i);
        songname.setAttribute("onclick","select("+i+")")
        newLine.appendChild(songname);    
    }      
}


function showPlayer(){
    var content = document.getElementById("song-container");
    content.innerHTML="";
    var newTable = document.createElement("table");
    content.appendChild(newTable)
    newTable.setAttribute("class", "songs");


    for(var i = 0; i<playlists.length; i++){
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        newTr.setAttribute("onclick", "playing("+i+")")
        var newTd = document.createElement("td");
        newTr.appendChild(newTd);
        var img = document.createElement("img");
        newTd.appendChild(img);
        img.src = playlists[i].imgSrc;
        var scndTd = document.createElement("td");
        newTr.appendChild(scndTd);
        scndTd.textContent = playlists[i].name;
    }
}


function showAllSongs(){
    var content = document.getElementById("song-container");
    content.innerHTML="";
    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("class", "songs");
    var newTr = document.createElement("tr");
    newTable.appendChild(newTr);
    var newTh = document.createElement("th");
    newTr.appendChild(newTh);
    newTh.textContent = "Autor";
    var scndTh = document.createElement("th");
    newTr.appendChild(scndTh);
    scndTh.textContent="Songname";

    for(var i = 0; i<song.length; i++){
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        newTd = document.createElement("td");
        newTr.appendChild(newTd);
        newTd.textContent = song[i].autor;
        newTd.setAttribute("onclick","select("+i+")");
        newTd = document.createElement("td");
        newTr.appendChild(newTd);
        newTd.textContent = song[i].songname;
        newTd.setAttribute("onclick","select("+i+")");
    }

    content.setAttribute("style","justify-content: center;")
}



function select(s) {
    x = s; 
    audio.src = song[x].route

    var autor = document.getElementById("autor");
    autor.textContent = (song[x].autor);
    var songname = document.getElementById("songname");
    songname.textContent = (song[x].songname)
    var a = document.getElementById("pp");

    a.ClassList == "start";
    a.src = "img/pause.png";
    loaddata();
}

function loaddata() {
    audio.addEventListener("loadeddata", onPlay);
}

function onPlay() {
    var bar = document.getElementById("bar");
    audio.play();
    time = this.duration;
    bar.max = audio.duration;

    var dt = document.getElementById("duration");
    time = parseInt(audio.duration);
    var mins = Math.floor(time / 60);
    var seconds = time - mins * 60;
    dt.textContent = ("0" + mins + ":" + seconds);

    timebar = setInterval(() => {

        bar.value = audio.currentTime;
        var ct = document.getElementById("currentTime");
        time = parseInt(audio.currentTime);
        mins = Math.floor(time / 60);
        seconds = time - mins * 60;
        if (seconds < 10) {
            ct.textContent = ("0" + mins + ":0" + seconds);
        } else {
            ct.textContent = ("0" + mins + ":" + seconds);
        }

        if (bar.value == parseInt(bar.max)) {
            next();
        }

    }, 100);


}



function setTime() {
    clearInterval(timebar);
    var bar = document.getElementById("bar");
    audio.currentTime = bar.value;
    var a = document.getElementById("pp");
    a.src = "img/pause.png";
    a.classList = "start";
    onPlay();
}

function mute(){
    var mutebar = document.getElementById("volume");
    var onmute = document.getElementById("mute");
    if(audio.volume==0){
        audio.volume = 1;
        mutebar.value = 10;
        onmute.src = "img/volume.png"

    }else{
        audio.volume = 0;
        mutebar.value = 0;
        onmute.src="img/mute.png"
    }
}


function volume() {
    var volume = document.getElementById("volume");
    audio.volume = volume.value / 10;
}



function play() {
    var a = document.getElementById("pp");
    if (a.classList == "stop") {
        loaddata();
        a.src = "img/pause.png";
        a.classList = "start";

    } else {
        audio.pause();
        a.src = "img/play.png";
        a.classList = "stop"

    }
}


function next() {
    var a = document.getElementById("pp");
    x = x + 1;
    cr = 0;

    if (x >= song.length) {
        audio.pause();
        a.src = "img/play.png";
        a.classList = "stop";
        alert("Select another playlist");
    } else {
        audio.src = song[x].route;
        var autor = document.getElementById("autor");
        autor.textContent = (song[x].autor);
        var songname = document.getElementById("songname");
        songname.textContent = (song[x].songname)
        a.src = "img/pause.png";
        a.classList = "start";
        loaddata();
    }

}



function back() {
    var a = document.getElementById("pp");
    x = x - 1;
    cr = 0;

    if (x < 0) {
        x = 0
        audio.src = song[x].route;
        var autor = document.getElementById("autor");
        autor.textContent = (song[x].autor);
        var songname = document.getElementById("songname");
        songname.textContent = (song[x].songname)
        var a = document.getElementById("pp");
        a.src = "img/pause.png";
        a.classList = "start";
        loaddata();
    } else {
        audio.src = song[x].route;
        var autor = document.getElementById("autor");
        autor.textContent = (song[x].autor);
        var songname = document.getElementById("songname");
        songname.textContent = (song[x].songname)
        var a = document.getElementById("pp");
        a.src = "img/pause.png";
        a.classList = "start";
        loaddata();
    }

}