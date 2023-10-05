<?php
// Load the playlists from a JSON file
$playlists = file_get_contents("data/playlists.json");

// Directory where uploaded music files will be stored
$uploaddir = "music/";

// Check if the form is submitted
if (isset($_POST["submit"])) {

    // Check if a playlist is selected
    if (isset($_POST["playlist"])) {
        $answer = $_POST['playlist'];
        $songlist = $answer;
    } else {
        echo "Please select a playlist";
    }
}

// Check if a file was uploaded successfully
if (isset($_FILES) && $_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
    // Construct the file name and move the uploaded file to the target directory
    $name = $uploaddir . $_FILES["userfile"]["name"];
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $name);

    // Load the selected playlist and all songs
    $songs = json_decode(file_get_contents($songlist), true);
    $allsongs = json_decode(file_get_contents("data/songs.json"));

    // Create a new song entry
    $newSong = array(
        "autor" => $_POST["autor"],
        "songname" => $_POST["songname"],
        "route" => $name
    );

    // Add the new song to the selected playlist and to the list of all songs
    $songs[] = $newSong;
    $allsongs[] = $newSong;

    // Update the selected playlist and the list of all songs in their respective JSON files
    file_put_contents($songlist, json_encode($songs));
    file_put_contents("data/songs.json", json_encode($allsongs));

    // Output a success message
    echo "Successful";
}
?>
<meta http-equiv="Refresh" content="2; url=index.php">
