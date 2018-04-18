<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            session_start();
            if($_SESSION["username"] == "" && $_SESSION["password"] == "") {
                header("Location:login.php");
            }
            $USER_NAME = $_SESSION["username"];
            $PASS_WORD = $_SESSION["password"];
        ?>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <title>News Feed Project</title>
        
        <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <script type="text/javascript">
            var USER_NAME = '<?php echo $USER_NAME;?>';
            var PASS_WORD = '<?php echo $PASS_WORD;?>';
        </script>
        <script src="scripts.js"></script>
    </head>
    <body>
        <div id="header">
            <img src="http://a.espncdn.com/i/espn/teamlogos/lrg/trans/espn_dotcom_black.gif" />
            <h1 id="newsTitle">Sports News</h1>
        </div>

        <p><b>Hi, <?php echo $USER_NAME?>! The last visit in this browser was: </b><div id="last"></div></p>
        <a id="logout" href="clearsessions.php">Log out</a>
        <br/>
        <br/>

        <p><b>Favorites:</b></p>
        <div id="favorites">
            You haven't selected any favorites!
        </div>
        <br/>
        <br/>
        
        <div>
            <input type="checkbox" id="nfl" onchange="checkBoxes(this)">
            <label style="color:blue">American Football News</label>
            <input type="checkbox" id="mlb" onchange="checkBoxes(this)">
            <label style="color:red">Baseball News</label>
            <input type="checkbox" id="nhl" onchange="checkBoxes(this)">
            <label style="color:green">Hockey News</label>
        </div>
        <button onclick="refreshData()">Refresh feed</button>
        <div id="newsContent">
        </div>

    </body>
</html>
