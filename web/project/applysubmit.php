<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Apply for a job</title>
     <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'db.php';
require 'session.php';

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        if ( 
                isset($_POST['job_id']) && 
                isset($_POST['freelance_id']) &&
                isset($_POST['title']) &&
                isset($_POST['description']) &&
                isset($_POST['rate']) &&
                isset($_POST['hours']) 
                ) {
	        	$jobId =        $_POST['job_id'];
	        	$freelanceId =  $_POST['freelance_id'];
	        	$userId = getSessionUser();
                $title =        $_POST['title'];
                $description =  $_POST['description'];
                $rate =         $_POST['rate'];
                $hours =        $_POST['hours'];

	        	insertApplication($db, $jobId, $freelanceId, $userId, $description, $hours, $rate);
				}
} 

    
$newPage = "freelance.php?my=true";
header("Location: $newPage");
die();
?>	

</body>
</html>