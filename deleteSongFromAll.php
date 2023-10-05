<?php
if(isset($_GET["index"])) {
    $index = $_GET["index"]; // Get the index of the song to be deleted.
}

$currentPlaylist = json_decode(file_get_contents("data/songs.json"), true); // Load the current songs playlist data from its JSON file.

$songSrc = $currentPlaylist[$index]["route"]; // Get the file path (source) of the song to be deleted.

unlink($songSrc); // Delete the song file from the server.

unset($currentPlaylist[$index]); // Remove the song entry from the current playlist based on the provided index.

file_put_contents("data/songs.json", json_encode($currentPlaylist)); // Save the updated playlist data back to its JSON file.
echo "Successful"; // Display a success message.
?>

<meta http-equiv="Refresh" content="2; url=index.php"> <!-- This code creates an automatic redirection to the index.php page after 2 seconds following the operation. -->
