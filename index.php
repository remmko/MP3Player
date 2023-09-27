<?php
    include "test.php";
    $allsongs = file_get_contents("data/songs.json");
    $playlists = file_get_contents("data/playlists.json");
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="app/app.js"></script>
    <title>Juckbox</title>
</head>
<body class=container>
    <div class="mainmenu">
        <ul>
            <li>Player</li>
            <li>About It</li>
            <li>Contact</li>
        </ul>
    </div>
    <div class="hidden"></div>

    <div class="content">
        <div id="song-container">
        

        </div>
       
    </div>

    


    <div class="navigation">
        <ul>
            <li onclick="playAllSongs()">AllSongs</li>
            <li onclick="showPlayer()">Playlists</li>
            <li><a href="newsong.html">Add new song</a></li>
            <li>Somthing</li>
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
                <img src="img/left.png" alt=""  onclick="back()" class="controls">
                <img src="img/play.png" alt="" onclick="play()" id="pp" class="stop">
                <img src="img/right.png" alt="" onclick="next()" class="controls">
            </div>

            <div class="volume">
                <img src="img/volume.png" id="mute" alt="" onclick="mute()">
                <input type="range" id="volume" max="10" value="10" onclick="volume()">
            </div>

            <div id="timebar">
                <span id="currentTime">00:00</span>
                <input id="bar" onclick="setTime()" type="range" min="0" max="100" step="1" value="0">
                <span id= "duration">00:00</span> 
            </div>
        </div>
    </div>


   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">

        var audio = new Audio();
        audio.preload = "auto";
        let playlists;
        let song;

        window.addEventListener('load', () => {
            playlists = JSON.parse(<?php echo json_encode($playlists)?>);
            showPlayer();
        });


        function playing(i) {
            var src = playlists[i].src;
            $.ajax({
                type: 'GET',              
                url: 'test.php?src=' + src, 
                success: function(data) {
                }
            });

            song = JSON.parse(<?php include "test.php"; echo json_encode($song)?>);

        }
        
        
    
        function playAllSongs(){
            song = JSON.parse(<?php echo json_encode($allsongs)?>);
            showAllSongs()

        }
    </script>
</body>
</html>