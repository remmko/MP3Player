<?php

$songs = json_decode(file_get_contents("data/songs.json"), true); // Load song data from the JSON file into an array.

if (isset($_GET["src"]) && isset($_GET["id"])) { // Check if "src" and "id" parameters are provided in the URL.

    $file = $_GET["src"]; // Get the source (file path) from the URL.
    $id = $_GET["id"]; // Get the song ID from the URL.

    header('Content-Type: music/mp3'); // Set the response content type to MP3.
    header('Content-Disposition: attachment; filename=' . $songs[$id]["autor"] . '_' . $songs[$id]["songname"] . '.mp3'); // Set the filename for download.

    readfile($file); // Output the file for download.
    echo "Success"; // Display a success message.

}

?>
