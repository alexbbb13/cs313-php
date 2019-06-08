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
                isset($_POST['description']) &&
                isset($_POST['rate']) &&
                isset($_POST['hours']) 
                ) {
    	        	$jobId =        $_POST['job_id'];
    	        	$freelanceId =  $_POST['freelance_id'];
    	        	$userId = getSessionUser();
                    $description =  $_POST['description'];
                    $rate =         $_POST['rate'];
                    $hours =        $_POST['hours'];

                    $allRows = selectApplications($db, $jobId, $freelanceId, $userId);
                    if(sizeof($allRows) > 0) {
                        //Already have the application for the job
                        echo '<em>Error:You already have active applications for that job!</em>';
                        die();
                    } else {
                        //Inserting new application
                        insertApplication($db, $jobId, $freelanceId, $userId, $description, $hours, $rate * 100);
                        $newPage = "freelance.php?my=true";
                        header("Location: $newPage");
                        die();
                    } 
	        	}
} 
?>	

</body>
</html>