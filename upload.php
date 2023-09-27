<?php

if (isset($_POST["submit"])) {
    if (isset($_POST["ans"])) {
    $answer = $_POST['ans'];
       if ($answer == "ans1") {
           $uploaddir="music/metallica/";
           $songlist = "data/metallica.json";
       } elseif($answer == "ans2") {
           $uploaddir = "music/soad/";
           $songlist = "data/soad.json";
       }elseif($answer == "ans3"){
            $uploaddir = "music/rammstein/";
            $songlist = "data/rammstein.json";
       }elseif($answer == "ans4"){
            $uploaddir = "music/scorpions/";
            $songlist = "data/scorpions.json";
       }    

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
}



echo "true";

?>
<meta http-equiv="Refresh" content="1; url=index.php">

