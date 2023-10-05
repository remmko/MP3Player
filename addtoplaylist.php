<?php
$songs = json_decode(file_get_contents("data/songs.json"), true); // Load song data from the "songs.json" file into an array.
$playlists = json_decode(file_get_contents("data/playlists.json"), true); // Load playlist data from the "playlists.json" file into an array.

if(isset($_GET["songIndex"]) && isset($_GET["playlistIndex"])) {
    $playlistIndex = $_GET["playlistIndex"]; // Get the playlist index from the URL.
    $songIndex = $_GET["songIndex"]; // Get the song index from the URL.
}

$playlistroute = $playlists[$playlistIndex]["src"]; // Get the route (file path) of the selected playlist from the loaded playlists data.
$playlist = json_decode(file_get_contents($playlistroute), true); // Load the selected playlist data from its JSON file.

$newSong = array(
    "autor" => $songs[$songIndex]["autor"], // Get the author of the selected song.
    "songname" => $songs[$songIndex]["songname"], // Get the name of the selected song.
    "route" => $songs[$songIndex]["route"] // Get the file route (path) of the selected song.
);

$playlist[] = $newSong; // Add the new song to the selected playlist.
file_put_contents($playlistroute, json_encode($playlist)); // Save the updated playlist back to its JSON file.
echo "Successful"; // Display a success message.

?>
<meta http-equiv="Refresh" content="2; url=index.php"> <!-- This code creates an automatic redirection to the index.php page after 2 seconds following the operation. -->
