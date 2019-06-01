<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2></h2>
<br>
<form action="./login.php" method="POST">
  E-mail:
  <input name="login" type="email">
  Password:
  <input name="password" type="text">
  <br><br>
  <input type="submit">
</form>


<?php
   require 'db.php';
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && isset($_POST['password'])){
        // retrieve the form data by using the element's name attributes value as key
        $login = $_POST['login'];
        $password = $_POST['password'];
        $db = getDb();
        $user_id = selectByLoginPassword($db, $login, $password);
        if(sizeof($user_id) == 0) {
            //User not found
        }

        foreach($allRows as $r) 
        {
                    echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'</b>';
                    echo ' <span class="text_content">'.$r['content'].'</span><br>';
                    echo '<br>';
        }
    }
    if(sizeof($user_id) == 0) {
            //User not found
    } else if (sizeof($user_id) == 1) {
            // user is found

    } else {
        // multiple users, 
        echo '<h2>Error</h2>';
    }
        
?>
</body>
</html>