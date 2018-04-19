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

      if($_SESSION["username"] != "" && $_SESSION["password"] != "") {
        // redirect to main page if logged in
        header("Location:newsfeed.php");
      }
      
      if (isset($_POST['signup']) && !empty($_POST['signUpName']) 
         && !empty($_POST['signUpPass'])) {

         $formData = array($_POST['signUpName']=>$_POST['signUpPass']);  // 100% secure, Meneely-approved operation here

         $jsonData = file_get_contents('users.json');
         $jsonArray = json_decode($jsonData, true);

         $userAlreadyExists = false;
         foreach ($jsonArray as $index){
           if(array_key_exists($_POST['signUpName'],$index)){
             $userAlreadyExists = true;
           }
         } 
         if($userAlreadyExists) {
          echo "<p style='color:red'>Name taken! Please choose another.</p>";
         } else {
           array_push($jsonArray,$formData);

           $jsonData = json_encode($jsonArray, true);

           file_put_contents('users.json',$jsonData);
           echo "<p style='color:green'>Account created! Please log in.</p>";  
         }
      }
      ?>

      </div>
      
      <div>

        <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <input type = "text" placeholder="Enter name" name = "signUpName" required autofocus>
            <br/>
            <input type = "password"  placeholder="Enter password" name = "signUpPass" required>
            <br/>
            <button type = "submit" 
               name = "signup">Sign Up</button>
         </form>
         <br/>

         <?php
            if (isset($_POST['login']) && !empty($_POST['username']) 
              && !empty($_POST['password'])) {
               $formData = array($_POST['username']=>$_POST['password']);

               $jsonData = file_get_contents('users.json');
               $jsonArray = json_decode($jsonData, true);

               $userPassCorrect = false;
               foreach ($jsonArray as $index){
                 if(array_key_exists($_POST['username'],$index)){
                   if($index[$_POST['username']] == $_POST['password']){
                     $userPassCorrect = true;
                   }
                 }
               } 
               if($userPassCorrect) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                header("Location:newsfeed.php");
               } else {
                 echo "<p style='color:red'>Account credentials incorrect. Please try again.</p>";  
               }
            }
         ?>
         
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <input type = "text" placeholder="Enter name" name = "username" required autofocus>
            <br/>
            <input type = "password"  placeholder="Enter password" name = "password" required>
            <br/>
            <button type = "submit" 
               name = "login">Log In</button>
         </form>
         
      </div> 
   </body>
</html>
