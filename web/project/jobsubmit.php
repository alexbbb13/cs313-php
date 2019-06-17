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
		   if (isset($_POST['delete']) && $_POST['delete']=='true' && isset($_POST['job_id'])) {
		   	// a request to delete the freelance service
		   	        $db = getDb();
		   			$jobId = htmlspecialchars($_POST['job_id']);
		   			deleteJob($db, $user, $jobId);
		   } elseif (isset($_POST['title']) && 
		   	         isset($_POST['rate_in_dollars']) &&
		   	         isset($_POST['projected_hours']) 
		   	     ){

						$title = htmlspecialchars($_POST['title']);
						$rate_in_cents = (int)htmlspecialchars(($_POST['rate_in_dollars']*100));
						if (isset($_POST['description'])) {
							$description = htmlspecialchars($_POST['description']);
						} else {
							$description = "";
						}
						$projectedHours = htmlspecialchars($_POST['projected_hours']);

						$db = getDb();
						if (isset($_POST['job_id'])) {
							$jobId = htmlspecialchars($_POST['job_id']);
							//var_dump($freelanceServiceId)
							updateJob($db, $user, $jobId, $title, $description, $rate_in_cents, $projectedHours);
						} else {
							//id is not set, insering new freelance service
							$jobId  = insertJob($db, $user, $title, $description, $rate_in_cents, $projectedHours);
						}
						
			} else {
						echo '<b>Error! Title, rate, and hours are required</b>';
			}

    
$newPage = "jobs.php?my=true";
header("Location: $newPage");
die();
}
?> 