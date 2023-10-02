<?php
$temp = "";
    if(isset($_GET["index"])&&isset($_GET["currentPlaylist"])) {
        $index = $_GET["index"];
        $temp =  $_GET["currentPlaylist"];
    }


$currentPlaylist = json_decode(file_get_contents($temp), true);



unset($currentPlaylist[$index]);

file_put_contents($temp, json_encode($currentPlaylist));
echo "Succesful";

?>    
<meta http-equiv="Refresh" content="2; url=index.php">