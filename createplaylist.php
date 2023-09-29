<?php
$play = "data/playlists.json";
if (isset($_POST["submit"])) {

    if (isset($_POST["playlistname"])) {
    $answer = $_POST['playlistname'];
    $uploaddir = "data/".$answer.".json";

    }else{
        echo "Please select playlist";
         }
  }


if (isset($_FILES) && $_FILES["userfile"]["error"]== UPLOAD_ERR_OK){
    $name = "img/" . $_FILES["userfile"]["name"];
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $name);
    $playlists = json_decode(file_get_contents($play), true);

    $newPlaylist = array(
        "name" => $_POST["playlistname"],
        "src" => $uploaddir,
        "imgSrc" => $name
    );
    $playlists[] = $newPlaylist;
    file_put_contents($play, json_encode($playlists));
    echo "Succesful";
}

?>


<meta http-equiv="Refresh" content="2; url=index.php">

