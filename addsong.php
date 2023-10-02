<?php
$playlists = file_get_contents("data/playlists.json");
$uploaddir = "music/";

if (isset($_POST["submit"])) {

    if (isset($_POST["playlist"])) {
    $answer = $_POST['playlist'];
    $songlist = $answer;

    }else{
        echo "Please select playlist";
         }
  }


if (isset($_FILES) && $_FILES["userfile"]["error"]== UPLOAD_ERR_OK){
    $name = $uploaddir . $_FILES["userfile"]["name"];
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $name);
    $songs = json_decode(file_get_contents($songlist), true);
    $allsongs = json_decode(file_get_contents("data/songs.json"));

    $newSong = array(
        "autor" => $_POST["autor"],
        "songname" => $_POST["songname"],
        "route" => $name 
    );
    $songs[] = $newSong;
    $allsongs[] = $newSong;
    file_put_contents($songlist, json_encode($songs));
    file_put_contents("data/songs.json", json_encode($allsongs));
    echo "Succesful";
}




?>
<meta http-equiv="Refresh" content="2; url=index.php">

