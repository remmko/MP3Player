<?php
$songs = json_decode(file_get_contents("data/songs.json"), true);
$playlists = json_decode(file_get_contents("data/playlists.json"), true);


if(isset($_GET["songIndex"])&&isset($_GET["playlistIndex"])) {
    $playlistIndex = $_GET["playlistIndex"];
    $songIndex = $_GET["songIndex"];
}

$playlistroute = $playlists[$playlistIndex]["src"];
$playlist = json_decode(file_get_contents($playlistroute), true);

$newSong = array(
    "autor" => $songs[$songIndex]["autor"],
    "songname" => $songs[$songIndex]["songname"],
    "route" => $songs[$songIndex]["route"]
);


$playlist[] = $newSong;
file_put_contents($playlistroute, json_encode($playlist));
echo "Succesful";


?>
<meta http-equiv="Refresh" content="2; url=index.php">

