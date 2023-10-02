<?php

    if(isset($_GET["src"])) {
        $temp = $_GET["src"];
        $index = $temp;
    }

$playlist = json_decode(file_get_contents("data/playlists.json"),true);

$dir = $playlist[$index]["src"];
$img =$playlist[$index]["imgSrc"];

unlink($dir);
unlink($img);

unset($playlist[$index]);

file_put_contents("data/playlists.json", json_encode($playlist));
echo "Succesful";

?>    
<meta http-equiv="Refresh" content="2; url=index.php">
