<?php

$songs = json_decode(file_get_contents("data/songs.json"),true);
if(isset($_GET["src"])&& isset($_GET["id"])){
    $file = $_GET["src"];
    $id = $_GET["id"];
    header('Content-Type: music/mp3');
    header('Content-Disposition: attachment; filename='.$songs[$id]["autor"].'_'.$songs[$id]["songname"].'.mp3');
    readfile($file);
    echo "Succes";

}

?>
