// Initialize variables
var x = 0; // Current song index
var time; // Current song duration
var cr = 0; // Variable for tracking song progress
var timebar; // Interval for updating the time progress



var currentIndex = 0; // Index of the current playlist

// Function to display songs in the player
function showSongs() {
    // Remove any existing songlist table
    if (document.getElementById("songlist")) {
        var table = document.getElementById("songlist");
        table.remove();
    }

    var content = document.getElementById("song-container");
    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("id", "songlist");

    // Loop through songs and create table rows for each song
    for (var i = 0; i < song.length; i++) {
        var newLine = document.createElement("tr");
        newTable.appendChild(newLine);

        var songname = document.createElement("td");
        songname.textContent = song[i].songname;
        songname.setAttribute("id", i);
        songname.setAttribute("onclick", "select(" + i + ")");
        newLine.appendChild(songname);
    }
}

// Function to edit a playlist
function editPlaylist(i) {
    currentIndex = i;
    var content = document.getElementById("song-container");
    content.innerHTML = "";
    img = document.createElement("img");
    content.appendChild(img);
    img.src = playlists[i].imgSrc;
    img.setAttribute("id", "editImg");

    // Remove any existing songlist table
    if (document.getElementById("songlist")) {
        var table = document.getElementById("songlist");
        table.remove();
    }

    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("id", "songlist");

    // Loop through songs and create table rows for each song
    for (var i = 0; i < song.length; i++) {
        var newLine = document.createElement("tr");
        newTable.appendChild(newLine);

        var songname = document.createElement("td");
        songname.textContent = song[i].songname;
        songname.setAttribute("id", i);
        songname.setAttribute("onclick", "select(" + i + ")");
        newLine.appendChild(songname);

        var del = document.createElement("img");
        newLine.appendChild(del);
        del.src = "img/delete.png"
        del.setAttribute("id", "delete2");
        del.setAttribute("onclick", "deletefromplaylist(" + i + ")");
    }
}

// Function to delete a song from anywhere
function deleteSong(i) {
    var result = confirm("Delete " + song[i].autor + " " + song[i].songname + " from anywhere?");
    if (result) {
        window.location = "deleteSongFromAll.php?index=" + i;
        return false;
    } else {
        alert("Canceling");
    }
}

// Function to delete a song from a playlist
function deletefromplaylist(i) {
    var result = confirm("Delete " + song[i].autor + " " + song[i].songname + " from playlist?");
    if (result) {
        window.location = "deleteSong.php?index=" + i + "&currentPlaylist=" + playlists[currentIndex].src;
        return false;
    } else {
        alert("Canceling");
    }
}

// Function to delete a playlist
function deletePlaylist(i) {
    var result = confirm("Are you sure?")
    if (result == true) {
        window.location = "deletePlaylist.php?src=" + i;
        return false;
    } else {
        alert("Canceling");
    }
}

// Function to add a new song
function addSong() {
    // Create a form for adding a new song
    var content = document.getElementById("song-container");
    content.innerHTML = "";
    var newForm = document.createElement("form");
    content.appendChild(newForm);
    newForm.setAttribute("enctype", "multipart/form-data");
    newForm.setAttribute("action", "addsong.php");
    newForm.setAttribute("method", "POST");
    newForm.setAttribute("id", "addSong")

    // Create form fields for autor and song name
    var autor = document.createElement("p");
    newForm.appendChild(autor);
    autor.textContent = "Autor";
    var newInput = document.createElement("input");
    newForm.appendChild(newInput);
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name", "autor");

    var songname = document.createElement("p");
    newForm.appendChild(songname);
    songname.textContent = "Song name";
    var scndInput = document.createElement("input");
    newForm.appendChild(scndInput);
    scndInput.setAttribute("type", "text");
    scndInput.setAttribute("name", "songname");

    // Create form fields for selecting a .mp3 file
    var format = document.createElement("p");
    newForm.appendChild(format);
    format.textContent = "Select a .mp3 file";

    var sendFile = document.createElement("input");
    newForm.appendChild(sendFile);
    sendFile.setAttribute("name", "userfile");
    sendFile.setAttribute("type", "file");

    // Create radio buttons for selecting a playlist
    for (var i = 0; i < playlists.length; i++) {
        var playlistName = document.createElement("p");
        newForm.appendChild(playlistName);
        playlistName.textContent = playlists[i].name;
        playlistName.setAttribute("id", "text");

        var playlist = document.createElement("input");
        newForm.appendChild(playlist);
        playlist.setAttribute("type", "radio");
        playlist.setAttribute("name", "playlist");
        playlist.setAttribute("value", playlists[i].src);
    }

    // Create a submit button
    var sendButton = document.createElement("input");
    newForm.appendChild(sendButton);
    sendButton.setAttribute("type", "submit");
    sendButton.setAttribute("name", "submit");
    sendButton.setAttribute("value", "Send");
}

// Function to create a new playlist
function createPlaylist() {
    // Create a form for creating a new playlist
    var content = document.getElementById("song-container");
    content.innerHTML = "";
    var newForm = document.createElement("form");
    content.appendChild(newForm);
    newForm.setAttribute("enctype", "multipart/form-data");
    newForm.setAttribute("action", "createplaylist.php");
    newForm.setAttribute("method", "POST");
    newForm.setAttribute("id", "addPlaylist")

    // Create form field for entering the playlist name
    var playlistName = document.createElement("p");
    newForm.appendChild(playlistName);
    playlistName.textContent = "Playlist name";
    var newInput = document.createElement("input");
    newForm.appendChild(newInput);
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name", "playlistname");

    // Create form field for selecting an image
    var format = document.createElement("p");
    newForm.appendChild(format);
    format.textContent = "Select an image";
    var sendFile = document.createElement("input");
    newForm.appendChild(sendFile);
    sendFile.setAttribute("name", "userfile");
    sendFile.setAttribute("type", "file");

    // Create a submit button
    var sendButton = document.createElement("input");
    newForm.appendChild(sendButton);
    sendButton.setAttribute("type", "submit");
    sendButton.setAttribute("name", "submit");
    sendButton.setAttribute("value", "Send");
}

// Function to display all songs
function showAllSongs() {
    var content = document.getElementById("song-container");
    content.innerHTML = "";
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
    scndTh.textContent = "Songname";

    // Loop through songs and create table rows for each song
    for (var i = 0; i < song.length; i++) {
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        newTd = document.createElement("td");
        newTr.appendChild(newTd);
        newTd.textContent = song[i].autor;
        newTd.setAttribute("onclick", "select(" + i + ")");
        newTd = document.createElement("td");
        newTr.appendChild(newTd);
        newTd.textContent = song[i].songname;
        newTd.setAttribute("onclick", "select(" + i + ")");

        // Create buttons for adding, deleting, and downloading songs
        var add = document.createElement("img");
        newTr.appendChild(add);
        add.src = "img/add.png"
        add.setAttribute("id", "delete2");
        add.setAttribute("onclick", "showtoadd(" + i + ")");

        var del = document.createElement("img");
        newTr.appendChild(del);
        del.src = "img/delete.png"
        del.setAttribute("id", "delete2");
        del.setAttribute("onclick", "deleteSong(" + i + ")");

        var down = document.createElement("img");
        newTr.appendChild(down);
        down.src = "img/download.png"
        down.setAttribute("id", "download");
        down.setAttribute("onclick", "download(" + i + ")");
    }

    content.setAttribute("style", "justify-content: center;")
}

// Function to download a song
function download(i) {
    window.location = "download.php?src=" + song[i].route + "&&id=" + i;
    return false;
}

// Function to display playlists for adding a song
function showtoadd(i) {
    currentIndex = i;
    var content = document.getElementById("song-container");
    content.innerHTML = "";

    var text = document.createElement("p");
    content.appendChild(text);
    text.textContent = "Select playlist: ";

    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("class", "songs");

    // Loop through playlists and create table rows for each playlist
    for (var e = 0; e < playlists.length; e++) {
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        newTr.setAttribute("id", "songDelete")
        var newTd = document.createElement("td");
        newTr.appendChild(newTd);

        var img = document.createElement("img");
        newTd.appendChild(img);
        img.src = playlists[e].imgSrc;
        var scndTd = document.createElement("td");
        newTr.appendChild(scndTd);
        scndTd.setAttribute("onclick", "addtoplaylist(" + e + ")");
        scndTd.textContent = playlists[e].name;
    }
}

// Function to add a song to a playlist
function addtoplaylist(e) {
    result = confirm("Do you want to add " + song[currentIndex].autor +
        "  " + song[currentIndex].songname + " to " + playlists[e].name + " playlist?")
    if (result) {
        window.location = "addtoplaylist.php?songIndex=" + currentIndex + "&&playlistIndex=" + e;
        return false;
    } else {
        alert("Canceling")
        window.location = "index.php";
    }
}

// Function to select a song for playback
function select(s) {
    x = s;
    audio.src = song[x].route
    audio.volume = 0.5;

    var autor = document.getElementById("autor");
    autor.textContent = (song[x].autor);
    var songname = document.getElementById("songname");
    songname.textContent = (song[x].songname)
    var a = document.getElementById("pp");

    a.ClassList == "start";
    a.src = "img/pause.png";

    var next = document.getElementById("next");
    var back = document.getElementById("back");

    if (x == song.length - 1) {
        next.src = "img/nonext.png";
        next.setAttribute("onclick", "0");

    } else {
        next.src = "img/right.png";
    }

    if (x == 0) {
        back.src = "img/noback.png";
        back.setAttribute("onclick", "0");
    } else {
        back.src = "img/left.png"
    }

    loaddata();
}

// Function to load data for a song
function loaddata() {
    audio.addEventListener("loadeddata", onPlay);
}

// Function to handle song playback
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

// Function to set the current time for the song
function setTime() {
    clearInterval(timebar);
    var bar = document.getElementById("bar");
    audio.currentTime = bar.value;
    var a = document.getElementById("pp");
    a.src = "img/pause.png";
    a.classList = "start";
    onPlay();
}

// Function to mute/unmute the song
function mute() {
    var mutebar = document.getElementById("volume");
    var onmute = document.getElementById("mute");
    if (audio.volume == 0) {
        audio.volume = 1;
        mutebar.value = 10;
        onmute.src = "img/volume.png"

    } else {
        audio.volume = 0;
        mutebar.value = 0;
        onmute.src = "img/mute.png"
    }
}

// Function to adjust the volume of the song
function volume() {
    var volume = document.getElementById("volume");
    audio.volume = volume.value / 10;
}

// Function to play/pause the song
function play() {
    audio.volume = 0.5;
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

// Function to play the next song
function next() {
    var a = document.getElementById("pp");

    x = x + 1;
    cr = 0;

    var next = document.getElementById("next");
    var back = document.getElementById("back");

    if (x == song.length - 1) {
        next.src = "img/nonext.png";
        next.setAttribute("onclick", "0");

    } else {
        next.src = "img/right.png";
    }

    if (x == 0) {
        back.src = "img/noback.png";
        back.setAttribute("onclick", "0");
    } else {
        back.src = "img/left.png"
    }

    if (x >= song.length) {
        audio.pause();
        a.src = "img/play.png";
        a.classList = "stop";
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

// Function to play the previous song
function back() {
    var a = document.getElementById("pp");
    x = x - 1;
    cr = 0;

    var next = document.getElementById("next");
    var back = document.getElementById("back");

    if (x == song.length - 1) {
        next.src = "img/nonext.png";
        next.setAttribute("onclick", "0");

    } else {
        next.src = "img/right.png";
    }

    if (x == 0) {
        back.src = "img/noback.png";
        back.setAttribute("onclick", "0");
    } else {
        back.src = "img/left.png"
    }

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
