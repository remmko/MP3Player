<?php
    if(isset($_GET["index"])) {
        $index = $_GET["index"];
    }


$currentPlaylist = json_decode(file_get_contents("data/songs.json"), true);

$songSrc = $currentPlaylist[$index]["route"];

unlink($songSrc);

unset($currentPlaylist[$index]);

file_put_contents("data/songs.json", json_encode($currentPlaylist));
echo "Succesful";

?>    
<meta http-equiv="Refresh" content="2; url=index.php">