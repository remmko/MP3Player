var x = 0;
var time;
var cr = 0;
var timebar;

var currentIndex = 0;

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
    newTable.setAttribute("id", "songL");



    for(var i = 0; i<playlists.length; i++){
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        newTr.setAttribute("id", "songDelete")
        var newTd = document.createElement("td");
        newTr.appendChild(newTd);

        var img = document.createElement("img");
        newTd.appendChild(img);
        img.src = playlists[i].imgSrc;
        var scndTd = document.createElement("td");
        newTr.appendChild(scndTd);
        scndTd.setAttribute("onclick", "playing("+i+")")
        scndTd.textContent = playlists[i].name;
        var edit = document.createElement("img");
        newTd.appendChild(edit);
        edit.src="img/edit.png";
        edit.setAttribute("id", "edit");
        edit.setAttribute("onclick", "editPlaylist("+i+")");
        var del = document.createElement("img");
        newTd.appendChild(del);
        del.src = "img/delete.png"
        del.setAttribute("id", "edit");
        del.setAttribute("onclick", "deletePlaylist("+i+")");
    }

    showSongs();
}


function editPlaylist(i){
   currentIndex = i;
    var content = document.getElementById("song-container");
    content.innerHTML="";
    img = document.createElement("img");
    content.appendChild(img);
    img.src = playlists[i].imgSrc;
    img.setAttribute("id","editImg");
      if(document.getElementById("songlist")){
        var table = document.getElementById("songlist");
        table.remove();
    }
    
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
        var del = document.createElement("img");
        newLine.appendChild(del);
        del.src = "img/delete.png"
        del.setAttribute("id", "delete2");
        del.setAttribute("onclick", "deletefromplaylist("+i+")");
    }


    

}



function deleteSong(i){
    var result = confirm("Delete "+song[i].autor+" "+song[i].songname+" from anythere?");
    if(result){
        window.location="deleteSongFromAll.php?index="+i;
        return false;
    }else{
        alert("Canceling");
    }
}

function deletefromplaylist(i){
    var result = confirm("Delete "+song[i].autor+" "+song[i].songname+" from playlist?");
    if(result){
        window.location="deleteSong.php?index="+i+"&currentPlaylist="+playlists[currentIndex].src;
        return false;
    }else{
        alert("Canceling");
    }
   
}


function deletePlaylist(i){
    var result = confirm("Are you sure?")
    if (result == true){
        window.location = "deletePlaylist.php?src="+i;
        return false;
    }else{
        alert("Canceling");
    }
    
}

function addSong(){
    var content = document.getElementById("song-container");
    content.innerHTML="";
    var newForm = document.createElement("form");
    content.appendChild(newForm);
    newForm.setAttribute("enctype", "multipart/form-data");
    newForm.setAttribute("action", "addsong.php");
    newForm.setAttribute("method", "POST");
    newForm.setAttribute("id","addSong")

    var autor = document.createElement("p");
    newForm.appendChild(autor);
    autor.textContent = "Autor";
    var newInput = document.createElement("input");
    newForm.appendChild(newInput);
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name","autor");
   

   

    var songname = document.createElement("p");
    newForm.appendChild(songname);
    songname.textContent = "Song name";
    var scndInput = document.createElement("input");
    newForm.appendChild(scndInput);
    scndInput.setAttribute("type","text");
    scndInput.setAttribute("name", "songname")
    


   ;

    var format = document.createElement("p");
    newForm.appendChild(format);
    format.textContent ="Select a .mp3 file";
   

    var sendFile = document.createElement("input");
    newForm.appendChild(sendFile);
    sendFile.setAttribute("name","userfile");
    sendFile.setAttribute("type", "file");
    

    for (var i = 0; i<playlists.length; i++){
        var playlistName = document.createElement("p");
        newForm.appendChild(playlistName);
        playlistName.textContent = playlists[i].name;
        playlistName.setAttribute("id", "text");

        var playlist = document.createElement("input");
        newForm. appendChild(playlist);
        playlist.setAttribute("type", "radio");
        playlist.setAttribute("name", "playlist");
        playlist.setAttribute("value", playlists[i].src);
    }

    var sendButton = document.createElement("input");
    newForm.appendChild(sendButton);
    sendButton.setAttribute("type", "submit");
    sendButton.setAttribute("name", "submit");
    sendButton.setAttribute("value","Send");
   
}


function createPlaylist(){
    var content = document.getElementById("song-container");
    content.innerHTML="";
    var newForm = document.createElement("form");
    content.appendChild(newForm);
    newForm.setAttribute("enctype", "multipart/form-data");
    newForm.setAttribute("action", "createplaylist.php");
    newForm.setAttribute("method", "POST");
    newForm.setAttribute("id","addPlaylist")
    var playlistName = document.createElement("p");
    newForm.appendChild(playlistName);
    playlistName.textContent = "Playlist name";
    var newInput = document.createElement("input");
    newForm.appendChild(newInput);
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name","playlistname");

    var format = document.createElement("p");
    newForm.appendChild(format);
    format.textContent = "Select a imatge";
    var sendFile = document.createElement("input");
    newForm.appendChild(sendFile);
    sendFile.setAttribute("name","userfile");
    sendFile.setAttribute("type", "file");
    var sendButton = document.createElement("input");
    newForm.appendChild(sendButton);
    sendButton.setAttribute("type", "submit");
    sendButton.setAttribute("name", "submit");
    sendButton.setAttribute("value","Send");
    
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
        var add = document.createElement("img");
        newTr.appendChild(add);
        add.src = "img/add.png"
        add.setAttribute("id", "delete2");
        add.setAttribute("onclick", "showtoadd("+i+")");
        var del = document.createElement("img");
        newTr.appendChild(del);
        del.src = "img/delete.png"
        del.setAttribute("id", "delete2");
        del.setAttribute("onclick", "deleteSong("+i+")");
    }

    content.setAttribute("style","justify-content: center;")
}


function showtoadd(i){
    currentIndex = i;
    var content = document.getElementById("song-container");
    content.innerHTML="";

    var text = document.createElement("p");
    content.appendChild(text);
    text.textContent = "Select playlist: ";

    var newTable = document.createElement("table");
    content.appendChild(newTable);
    newTable.setAttribute("class", "songs");


    for(var e = 0; e<playlists.length; e++){
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
        scndTd.setAttribute("onclick", "addtoplaylist("+e+")");
        scndTd.textContent = playlists[e].name;
    }    
}


function addtoplaylist(e){
    result = confirm("Do you want to add "+song[currentIndex].autor +
    "  "+ song[currentIndex].songname + " to "+playlists[e].name+" playlist?")
    if(result){
        window.location = "addtoplaylist.php?songIndex="+currentIndex+"&&playlistIndex="+e;
        return false;
    }else{
        alert("Canceling")
        window.location="index.php";
    }
   
}


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

    if(x==song.length-1){
        next.src="img/nonext.png";
        next.setAttribute("onclick", "0");

    }else{
        next.src="img/right.png";
    }

    if(x==0){
        back.src = "img/noback.png";
        back.setAttribute("onclick","0");
    }else{
        back.src = "img/left.png"
    }

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


function next() {
    var a = document.getElementById("pp");

    x = x + 1;
    cr = 0;

    var next = document.getElementById("next");
    var back = document.getElementById("back");

    if(x==song.length-1){
        next.src="img/nonext.png";
        next.setAttribute("onclick", "0");

    }else{
        next.src="img/right.png";
    }

    if(x==0){
        back.src = "img/noback.png";
        back.setAttribute("onclick","0");
    }else{
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



function back() {
    var a = document.getElementById("pp");
    x = x - 1;
    cr = 0;

    var next = document.getElementById("next");
    var back = document.getElementById("back");

    if(x==song.length-1){
        next.src="img/nonext.png";
        next.setAttribute("onclick", "0");

    }else{
        next.src="img/right.png";
    }

    if(x==0){
        back.src = "img/noback.png";
        back.setAttribute("onclick","0");
    }else{
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