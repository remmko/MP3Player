<?php
$play = "data/playlists.json"; // Path to the file where playlist data is stored.

if (isset($_POST["submit"])) { // Check if the form has been submitted.

    if (isset($_POST["playlistname"])) { // Check if a playlist name has been provided in the form.
        $answer = $_POST['playlistname']; // Store the playlist name from the form in the variable $answer.
        $uploaddir = "data/".$answer.".json"; // Generate the path to the playlist's JSON file based on its name.

    } else {
        echo "Please select playlist"; // If the playlist name was not provided in the form, display an error message.
    }
}

if (isset($_FILES) && $_FILES["userfile"]["error"] == UPLOAD_ERR_OK) { // Check if an image file has been successfully uploaded.

    $name = "img/" . $_FILES["userfile"]["name"]; // Generate the path to the uploaded image.
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $name); // Move the uploaded image to the required directory.

    $playlists = json_decode(file_get_contents($play), true); // Load the current playlists from the JSON file into an array.

    // Create a new playlist and add it to the playlists array.
    $newPlaylist = array(
        "name" => $_POST["playlistname"], // The playlist name from the form.
        "src" => $uploaddir, // The path to the playlist's JSON file.
        "imgSrc" => $name // The path to the uploaded image.
    );
    $playlists[] = $newPlaylist;

    file_put_contents($play, json_encode($playlists)); // Save the updated playlists list to the JSON file.
    echo "Successful"; // Display a success message.
}
?>

<meta http-equiv="Refresh" content="2; url=index.php"> <!-- This code creates an automatic redirection to the index.php page after 2 seconds following the operation. -->
