<?php
$temp = "";

if(isset($_GET["index"]) && isset($_GET["currentPlaylist"])) {
    $index = $_GET["index"]; // Get the index of the item to be removed from the playlist.
    $temp = $_GET["currentPlaylist"]; // Get the file path of the current playlist.
}

$currentPlaylist = json_decode(file_get_contents($temp), true); // Load the current playlist data from its JSON file.

unset($currentPlaylist[$index]); // Remove the item from the current playlist based on the provided index.

file_put_contents($temp, json_encode($currentPlaylist)); // Save the updated playlist data back to its JSON file.
echo "Successful"; // Display a success message.
?>

<meta http-equiv="Refresh" content="2; url=index.php"> <!-- This code creates an automatic redirection to the index.php page after 2 seconds following the operation. -->
