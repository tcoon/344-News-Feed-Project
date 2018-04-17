<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <title>News Feed Login</title>
    </head>
    <body>
        <div id="header">
            <img src="http://a.espncdn.com/i/espn/teamlogos/lrg/trans/espn_dotcom_black.gif" />
            <h1 id="newsTitle">Sports News</h1>
        </div>
      
      <h2>Welcome!</h2>
      <h4>Please sign up or log in with an existing account.</h4>
      <div>
         
      <?php

      // Start the session
      session_start();


      $msg = '';
      
      if (isset($_POST['login']) && !empty($_POST['username']) 
         && !empty($_POST['password'])) {
          
         $_SESSION['username'] = $_POST['username'];
         $_SESSION['password'] = $_POST['password'];
         header("Location:newsfeed.php");
      }?>

      </div>
      
      <div>
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <input type = "text" placeholder="Enter name" name = "username" required autofocus>
            <br/>
            <input type = "password"  placeholder="Enter password" name = "password" required>
            <br/>
            <button type = "submit" 
               name = "login">Sign Up / Login</button>
         </form>
         
      </div> 
   </body>
</html>
