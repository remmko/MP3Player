<?php
    if (isset($_GET['src'])) {
        echo $_GET["src"];
        $song = @file_get_contents($_GET["src"]);
    }
    $cur = $song;

?>
