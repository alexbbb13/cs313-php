<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<br>
<?php
   require 'db.php';
   require 'session.php';
   
    function printNoUser($inRed) {
        if ($inRed === true) {
            $asterisk = 'Passwords do not match ';
        } else {
            $asterisk = '';    
        }
        echo '<h2>Signup</h2>
        <br>
        <form action="./signup.php" method="POST">
        Username:
        <input name="username" type="text"><br><br>
        E-mail:
        <input name="login" type="text"><br><br>
        Password:
        <em>'.$asterisk.'</em><input name="password" type="text">
        <br>
        Confirm password:
        <em>'.$asterisk.'</em><input name="password_copy" type="text">
        <br><br>
        <input type="submit">
        </form>';
    }

   function insertUserToDb($db, $username, $login, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return insertUser($db, $username, $login, $hashedPassword);
    }


    function redirectToWelcome() {
         $newPage = "index.php";
         header("Location: $newPage");
         die();    
    }

    function checkValid($password){
        //@TODO uncomment in production and make password strength message
        //$regexLength = "/[0-9a-zA-Z]{7,}/";
        //$regexNum = "/[0-9]/";
        //return (preg_match($regexLength, $password) && preg_match($regexNum, $password));
        return true;
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && 
        isset($_POST['username']) && 
        isset($_POST['login']) && 
        isset($_POST['password']) && 
        isset($_POST['password_copy'])
    ){
        // retrieve the form data by using the element's name attributes value as key
        $username = htmlspecialchars($_POST['username']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $passwordCopy = htmlspecialchars($_POST['password_copy']);
        $db = getDb();
        $users = selectByLogin($db, $login);
        //$users = selectByLoginPassword($db, $login, $password);
        $countUsers =count($users); 
        if($countUsers == 0) {
                //User not found
                //Cheking password match 
                if($password == $passwordCopy && checkValid($password)) {
                   $user_id = insertUserToDb($db, $username, $login, $password);
                   if ($user_id !== null) {
                        setSessionUser($user_id, $username);
                        redirectToWelcome();
                    }
                } else {
                    // Passwords do not match
                    printNoUser(true);
                }
        } else {
            // multiple users with same login not allowed, 
            echo '<h2>Error</h2>';
        }
    } else {
        //Get or no login/ password info
        printNoUser(false);
    }
?>
</body>
</html>