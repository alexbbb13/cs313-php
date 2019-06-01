<?php
require('db.php');
require('session.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // retrieve the form data by using the element's name attributes value as key
	       $user = getSessionUser();
	       var_dump($user);
		   if($user==null) {
		   	  echo 'Login data required';
		   	  die();
		   } 
           if (isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['rate_in_dollars'])){

						$title = $_POST['title'];
						$subtitle = $_POST['subtitle'];
						$rate_in_cents = (int)($_POST['rate_in_dollars']*100);
						if (isset($_POST['description'])) {
							$description = $_POST['description'];
						} else {
							$description = "";
						}
						$db = getDb();
						if (isset($_POST['id'])) {
							$freelanceServiceId = $_POST['id'];
							updateFreelanceService($db, $user, $freelanceServiceId, $title, $subtitle, $description, $rate_in_cents);
						} else {
							//id is not set, insering new freelance service
							$freelanceServiceId  = insertFreelanceService($db, $user, $title, $subtitle, $description, $rate_in_cents);
						}
						
					} else {
					    echo '<b>Error! Title, subtitle and rate are required</b>';
					}

    
$newPage = "freelance.php?my=true";
header("Location: $newPage");
die();
}
?> 