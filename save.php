<?php
    session_start();

    if (array_key_exists("user", $_POST) && array_key_exists("favs", $_POST)) {
        $user = $_POST["user"];
        $favs = json_decode($_POST["favs"]);

        $jsonData = file_get_contents("favorites.json");
        $jsonArray = json_decode($jsonData, true);

        $userDataExists = false;
        $userIndex = 0;
        foreach($jsonArray as $index){
            if(array_key_exists($user,$index)){
                $userDataExists = true;
                $userIndex = $index;
            }
        }
        if($userDataExists) {
            unset($jsonArray[$userIndex]);  // honestly don't know if this works properly
        }

        $formData = array($user=>$favs);
        array_push($jsonArray,$formData);

        $jsonData = json_encode($jsonArray, true);

        file_put_Contents('favorites.json',$jsonData);
    }

    $_SESSION["username"] = "";
    $_SESSION["password"] = "";
    header("Location:login.php");
?>