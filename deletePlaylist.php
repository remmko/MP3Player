<?php
if(isset($_GET["src"])) {
    $temp = $_GET["src"]; // Get the source (file path) of the playlist to be deleted.
    $index = $temp; // Assign the source to the index.
}

$playlist = json_decode(file_get_contents("data/playlists.json"), true); // Load the playlists data from the "playlists.json" file.

$dir = $playlist[$index]["src"]; // Get the directory path of the playlist.
$img = $playlist[$index]["imgSrc"]; // Get the image path associated with the playlist.

unlink($dir); // Delete the playlist directory.
unlink($img); // Delete the associated image.

unset($playlist[$index]); // Remove the playlist entry from the playlists data.

file_put_contents("data/playlists.json", json_encode($playlist)); // Save the updated playlists data back to the "playlists.json" file.
echo "Successful"; // Display a success message.
?>

<meta http-equiv="Refresh" content="2; url=index.php"> <!-- This code creates an automatic redirection to the index.php page after 2 seconds following the operation. -->
