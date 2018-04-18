<?php
    if (array_key_exists("favs", $_POST)) {
        $myData = $_POST["favs"];

        $myFile = "favorites.json";
        $fileHandle = fopen($myFile, "w");

        fwrite($fileHandle, $myData);
        fclose($fileHandle);   
    }
?>