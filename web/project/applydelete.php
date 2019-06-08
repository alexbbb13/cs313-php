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
                isset($_POST['application_id'])
                
                ) {
    	        	$jobId =        $_POST['job_id'];
    	        	$freelanceId =  $_POST['freelance_id'];
                    $applicationId = $_POST['application_id'];
    	        	$userId = getSessionUser();
                   
                    $allRows = selectApplicationById($db, $applicationId, $jobId, $freelanceId, $userId);
                    if(sizeof($allRows) > 0) {
                        //Already have the application for the job
                        deleteApplication($db, $applicationId);
                        $newPage = "sentapplications.php";
                        header("Location: $newPage");
                        die();
                    } 
	        	}
} 
?>	

</body>
</html>