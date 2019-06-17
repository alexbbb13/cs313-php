<?php
session_start();
require('db.php');
require('session.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // retrieve the form data by using the element's name attributes value as key
	       $user = getSessionUser();
	       if($user==null) {
		   	  echo 'Login data required';
		   	  die();
		   } 
		   //
		   if (isset($_POST['delete']) && $_POST['delete']=='true' && isset($_POST['freelance_id'])) {
		   	// a request to delete the freelance service
		   	        $db = getDb();
		   			$freelanceServiceId = htmlspecialchars($_POST['freelance_id']);
		   			deleteFreelanceService($db, $user, $freelanceServiceId);
		   } elseif (isset($_POST['title']) && isset($_POST['subtitle']) && isset($_POST['rate_in_dollars'])){

						$title = htmlspecialchars($_POST['title']);
						$subtitle = htmlspecialchars($_POST['subtitle']);
						$rate_in_cents = (int)htmlspecialchars(($_POST['rate_in_dollars']*100));
						if (isset($_POST['description'])) {
							$description = htmlspecialchars($_POST['description']);
						} else {
							$description = "";
						}
						$db = getDb();
						if (isset($_POST['freelance_id'])) {
							$freelanceServiceId = htmlspecialchars($_POST['freelance_id']);
							//var_dump($freelanceServiceId)
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