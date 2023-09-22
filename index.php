<?php
    $scorpions = file_get_contents("data/scorpions.json");
    $metallica = file_get_contents("data/metallica.json");
    $rammstein = file_get_contents("data/rammstein.json");
    $soad = file_get_contents("data/soad.json");

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
<body>
    <div class="mainmenu">
        <ul>
            <li>Player</li>
            <li>About It</li>
            <li>Contact</li>
        </ul>
    </div>

    
    

    <div class="content">
        <table class="songs">
           

            <tr onclick="scorp()">
                <td><img src="img/img.jpeg" alt="" style="width: 150px;"></td>
                <td id="scorpions">Scorpions Playlist</td>
            </tr>

            <tr onclick = "metal()">
                <td><img src="img/metalica.jpeg" style="width: 150px;" alt=""> </td>
                <td id="metalica">Metallica Playlist</td>
            </tr>

            <tr onclick="ramm()">
                <td><img src="img/rammstein.jpeg" style="width: 150px;" alt=""></td>
                <td id="rammstain">Rammstein Playlist</td>
            </tr>

            <tr onclick="soad()">
                <td><img src="img/soad.jpeg" style="width: 150px;" alt=""></td>
                <td id="soad">System Of A Down</td>
            </tr>
            
        </table>
    </div>


    <div class="navigation">
        <ul>
            <li>Songs</li>
            <li>Playlist</li>
            <li>Somthing</li>
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

            <div id="timebar">
                <span id="currentTime">00:00</span>
                <input id="bar" onclick="setTime()" type="range" min="0" max="100" step="1" value="0">
                <span id= "duration">00:00</span> 
            </div>
        </div>
       
    </div>


    <script>
        var audio = new Audio();
        audio.preload = "auto";
        var x = 0;
        var time;
        var cr = 0;
        let song;
        var timebar;

        function scorp(){
             song = JSON.parse(<?php echo json_encode($scorpions)?>);
             select();
        }

        function metal(){
            song = JSON.parse(<?php echo json_encode($metallica)?>);
            select();
        }

        function ramm(){
            song = JSON.parse(<?php echo json_encode($rammstein)?>);
            select();
        }

        function soad(){
            song = JSON.parse(<?php echo json_encode($soad)?>);
            select()
        }



        

        function select(){
            x = 0;
            audio.src = song[x].route

            var autor = document.getElementById("autor");
            autor.textContent = (song[x].autor);
            var songname = document.getElementById("songname");
            songname.textContent = (song[x].songname)
            var a = document.getElementById("pp");
            
            a.ClassList == "start";
            a.src="img/pause.png";
            loaddata();
        }

        function onPlay(){
            var bar = document.getElementById("bar");
                audio.play();
                time = this.duration;
                bar.max = time;

                console.log(audio.currentTime);


            
                var dt = document.getElementById("duration");
            
                time = parseInt(audio.duration);
                var mins = Math.floor(time/60);
                var seconds = time - mins*60;
                dt.textContent = ("0"+mins+":"+seconds);
        
                timebar = setInterval(() => {
                    bar.value = audio.currentTime;
                    var ct = document.getElementById("currentTime");
                    time=parseInt(audio.currentTime);
                    mins = Math.floor(time/60);
                    seconds = time - mins*60;
                    if(seconds<10){
                        ct.textContent = ("0"+mins+":0"+seconds);
                    }else{
                        ct.textContent = ("0"+mins+":"+seconds);
                    }
                    
                    
                }, 100);
                    
                if(bar.value==bar.max){
                    console.log(true)
                    next();
                }
        }

        function loaddata(){
            audio.addEventListener("loadeddata", onPlay);
        }




        function setTime(){
            clearInterval(timebar);
            var bar = document.getElementById("bar");
            audio.currentTime=bar.value;
            console.log(audio.currentTime);
            onPlay();
        }

        



        function play(){
            var a = document.getElementById("pp");
            if (a.classList=="stop"){
                onPlay();
                a.src="img/pause.png";
                a.classList="start";
                a.scrList

            }else{
                audio.pause();
                a.src="img/play.png";
                a.classList="stop"

            }
        }


        function next(){
            var a = document.getElementById("pp");
            x = x + 1;
            cr = 0;

            if(x>=song.length){
                audio.pause();
                a.src="img/play.png";
                a.classList="stop";
                alert("Select another playlist");
            }else{
                audio.src = song[x].route;
                var autor = document.getElementById("autor");
                autor.textContent = (song[x].autor);
                var songname = document.getElementById("songname");
                songname.textContent = (song[x].songname)
                a.src="img/pause.png";
                a.classList="start";
                onPlay();
            }
            
        }



        function back(){
            var a = document.getElementById("pp");
            x = x-1;
            cr = 0;

            if(x<0){
                x = 0
                audio.src = song[x].route;
                var autor = document.getElementById("autor");
                autor.textContent = (song[x].autor);
                var songname = document.getElementById("songname");
                songname.textContent = (song[x].songname)
                var a = document.getElementById("pp");
                a.src="img/pause.png";
                a.classList="start";
                onPlay();
            }else{
                audio.src = song[x].route;
                var autor = document.getElementById("autor");
                autor.textContent = (song[x].autor);
                var songname = document.getElementById("songname");
                songname.textContent = (song[x].songname)
                var a = document.getElementById("pp");
                a.src="img/pause.png";
                a.classList="start";
                onPlay();
            }
           
        }


     
     

    </script>
</body>
</html>