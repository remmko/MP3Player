<?php


$_SERVER['HTTP_RANGE'] = "bytes:0-100485759000000";

    // Start or resume a session
    session_start();

    // Read the contents of the "songs.json" and "playlists.json" files and store them as strings
    $allsongs = file_get_contents("data/songs.json");
    $playlists = file_get_contents("data/playlists.json");

    // Initialize variables
    $currentPlaylist = "[]"; // Empty JSON array
    $src = "data/metalica.json"; // Default source file
    $cookieCount[$src] = 0; // Initialize a cookie count for the default source

    // Check if a cookie named "cookieCount" exists, and if so, decode it into an associative array
    if(isset($_COOKIE["cookieCount"])){
        $cookieCount = json_decode($_COOKIE["cookieCount"], true);
    }

    // If the "src" parameter is set in the URL, update the $song and $currentPlaylist variables
    if(isset($_GET["src"])) {
        $song = $_GET["src"];
        $currentPlaylist = file_get_contents($song);
    }

    // If the "username" parameter is set in the URL, store it in the session as "user"
    if(isset($_GET["username"])){
        $_SESSION["user"]= $_GET["username"];
    }

    // If the "logout" parameter is set in the URL, unset the session
    if(isset($_GET["logout"])){
        session_unset();
    }

    // If the "src" parameter is set in the URL, update the $src and $cookieCount variables,
    // and set a cookie named "cookieCount" with the updated $cookieCount array
    if(isset($_GET["src"])) {
        $src = $_GET["src"];
        $cookieCount[$src] = $cookieCount[$src]+1;
        setcookie("cookieCount", json_encode($cookieCount), time()+3600);
    } else {
        // If "src" is not set, set a cookie named "cookieCount" with the current $cookieCount array
        setcookie("cookieCount", json_encode($cookieCount), time()+3600);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <script src="app/app.js"></script>
    <title>Juckbox</title>
</head>
<body class=container>
    <div class="mainmenu">
        <ul>
            <li id ="moreinfo" onclick="moreinfo()">More information</li>
            <li id="auth">
                <?php
                    if(isset($_SESSION["user"])){
                        echo 'Hello';
                    }
                ?>    
            </li>


            <li>

                <?php 
                    if(isset($_SESSION["user"])){
                        echo $_SESSION["user"]."!";
                    }
                ?>

            </li>

            <li>
            <?php
                    if(!isset($_SESSION["user"])){
                        echo ' <form method="GET" id = "hideLog" action= "index.php">
                        <input type="text" name = "username" placeholder = "type you name">
                        <input type="submit" value="Log in">
                        </form>';
                    }else{
                        echo ' <form action="index.php">
                        <input type="submit" name = "logout" value="Log out">
                        </form>';
                    }
                ?> 
        
            </li>
        </ul>
    </div>

    <div class="content">
        <div id="song-container">
        

        </div>
       
    </div>

    


    <div class="navigation">
        <ul>
            <li onclick="playAllSongs()">All Songs</li>
            <li onclick="showPlayer()">Playlists</li>
            <li onclick="addSong()">Add new song</li>
            <li onclick="createPlaylist()">Create playlist</li>
        </ul>
    </div>

    

    <div class="player">

        <div class="currentsong">
            <span id="autor">&nbsp</span>
            <br>
            <span id="songname">&nbsp</snap>
        </div>
        
        <div id="playercontent">
            <div class="playcontrol">
                <img src="img/left.png" alt=""  id="back" onclick="back()" class="controls">
                <img src="img/play.png" alt="" onclick="play()" id="pp" class="stop">
                <img src="img/right.png" alt="" id="next" onclick="next()" class="controls">
            </div>

            <div class="volume">
                <img src="img/volume.png" id="mute" alt="" onclick="mute()">
                <input type="range" id="volume" max="10" value="5" onclick="volume()">
            </div>

            <div id="timebar">
                <span id="currentTime">00:00</span>
                <input id="bar" onclick="setTime()" type="range" min="0" max="100" step="1" value="0">
                <span id= "duration">00:00</span> 
            </div>
        </div>
    </div>


   
    
    <script type="text/javascript">
       
        // Create an Audio object for playing music
        var audio = new Audio();
        audio.preload = "auto";

        // Initialize playlists and currentPlaylist variables using PHP data
        let playlists = <?php echo $playlists ?>;
        let song = <?php echo $currentPlaylist ?>;

        // Call the showPlayer function and add an event listener when the DOM is loaded
        showPlayer();
        window.addEventListener('DOMContentLoaded', () => {
            showPlayer();
        });

// Function to display playlists in the player section
    function showPlayer() {
        // Retrieve currentPlaylist data using PHP
        song = <?php echo $currentPlaylist ?>;
        
        // Clear the song-container element
        var content = document.getElementById("song-container");
        content.innerHTML = "";

        // Create a new table element for displaying playlists
        var newTable = document.createElement("table");
        content.appendChild(newTable);
        newTable.setAttribute("class", "songs");
        newTable.setAttribute("id", "songL");

        // Loop through playlists data and create table rows for each playlist
        for (var i = 0; i < playlists.length; i++) {
            var newTr = document.createElement("tr");
            newTable.appendChild(newTr);
            newTr.setAttribute("id", "songDelete");

            var newTd = document.createElement("td");
            newTr.appendChild(newTd);

            // Create an image element for the playlist thumbnail
            var img = document.createElement("img");
            newTd.appendChild(img);
            img.src = playlists[i].imgSrc;

            var scndTd = document.createElement("td");
            newTr.appendChild(scndTd);
            scndTd.setAttribute("onclick", "playing(" + i + ")");
            scndTd.textContent = playlists[i].name;

            // Create edit and delete buttons for each playlist
            var edit = document.createElement("img");
            newTd.appendChild(edit);
            edit.src = "img/edit.png";
            edit.setAttribute("id", "edit");
            edit.setAttribute("onclick", "editPlaylist(" + i + ")");

            var del = document.createElement("img");
            newTd.appendChild(del);
            del.src = "img/delete.png"
            del.setAttribute("id", "edit");
            del.setAttribute("onclick", "deletePlaylist(" + i + ")");
        }

        // Call the showSongs function
        showSongs();
    }

// Function to play a playlist when clicked
    function playing(i) {
        var src = playlists[i].src;
        window.location = "index.php?src=" + src;
        showSong();
    }

// Function to play all songs
    function playAllSongs() {
        song = <?php echo $allsongs ?>;
        showAllSongs();
    }

// Function to display more information
    function moreinfo() {
        var content = document.getElementById("song-container");
        content.innerHTML = "";
        var newTable = document.createElement("table");
        content.appendChild(newTable);
        newTable.setAttribute("id", "infoTable");
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        var empty = document.createElement("th");
        newTr.appendChild(empty);
        var newTh = document.createElement("th")
        newTr.appendChild(newTh);
        newTh.textContent = "Playlist name";
        var scndTh = document.createElement("th");
        newTr.appendChild(scndTh);
        scndTh.textContent = "Plays";
        var cookieCount = <?php if (isset($_COOKIE["cookieCount"])) { echo $_COOKIE["cookieCount"]; } else { echo "1"; } ?>;
        for (var i = 0; i < playlists.length; i++) {
            var scndTr = document.createElement("tr");
            newTable.appendChild(scndTr);
            var newTd = document.createElement("td");
            scndTr.appendChild(newTd);
            var img = document.createElement("img");
            newTd.appendChild(img);
            img.src = playlists[i].imgSrc;
            img.setAttribute("style", "width: 100px; height: 100px");
            var scndTd = document.createElement("td");
            scndTr.appendChild(scndTd);
            scndTd.textContent = playlists[i].name;
            var trdTd = document.createElement("td");
            scndTr.appendChild(trdTd);
            trdTd.textContent = cookieCount[playlists[i].src];
        }
    }


    </script>
</body>
</html>