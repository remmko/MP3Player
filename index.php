<?php
    $src = "data/playlists.json";
    session_start();
    $allsongs = file_get_contents("data/songs.json");
    $playlists = file_get_contents("data/playlists.json");
    $currentPlaylist = "[]";
    $cookieCount[$src];

    if(isset($_COOKIE["cookieCount"])){
        $cookieCount = json_decode($_COOKIE["cookieCount"], true);
    }
    
    
    if(isset($_GET["src"])) {
        $song = $_GET["src"];
        $currentPlaylist = file_get_contents($song);
    }

    if(isset($_GET["username"])){
        $_SESSION["user"]= $_GET["username"];
    }


    if(isset($_GET["logout"])){
        session_unset();
    }


    if(isset($_GET["src"])) {
        $src = $_GET["src"];
        $cookieCount[$src] = $cookieCount[$src]+1;
        setcookie("cookieCount", json_encode($cookieCount), time()+3600);

    }else{
        $src = json_decode($playlists,true )[0]["src"];
        $cookieCount[$src] = $cookieCount[$src]+1;
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
        var cookieCount = <?php echo $_COOKIE["cookieCount"]?>;
        var audio = new Audio();
        audio.preload = "auto";
        let playlists=<?php echo $playlists?>;
        let song = <?php echo $currentPlaylist?>;

        showPlayer();
        window.addEventListener('DOMContentLoader', () => {
            showPlayer();
        });

        
        function playing(i) {
            var src = playlists[i].src;
            window.location = "index.php?src="+src;
            showSong();

        }
        
        
    
        function playAllSongs(){
            song = <?php echo $allsongs?>;
            showAllSongs()
            
        }

        function moreinfo(){
        var content = document.getElementById("song-container")
        content.innerHTML="";
        var newTable = document.createElement("table");
        content.appendChild(newTable);
        newTable.setAttribute("id", "infoTable");
        var newTr = document.createElement("tr");
        newTable.appendChild(newTr);
        var empty = document.createElement("th");
        newTr.appendChild(empty);
        var newTh = document.createElement("th")
        newTr.appendChild(newTh);
        newTh.textContent="Playlist name";
        var scndTh = document.createElement("th");
        newTr.appendChild(scndTh);
        scndTh.textContent = "Plays";
        for(var i = 0; i<playlists.length; i++){
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
            scndTd.textContent=playlists[i].name;
            var trdTd = document.createElement("td");
            scndTr.appendChild(trdTd);
            trdTd.textContent= cookieCount[playlists[i].src];
        }
}

    </script>
</body>
</html>