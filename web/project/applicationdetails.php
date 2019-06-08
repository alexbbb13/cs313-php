<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Job details</title>
     <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'navbar.php';
?>	
<br>

<?php
require 'db.php';

/*
jobs.id as jobId,
  			applications.id as applicationId,
  			jobs.user_id as clientUserId,
  			applications.user_id as freelancerUserId,
  			applications.freelance_service_id as freelancerServiceId,
  			freelance_services.title,
  			applications.rate_in_cents,
  			applications.projected_hours
*/
//Local or Heroku
function printRow($name, $value){
	echo '<tr>';
	echo '<th>'.$name.'</th>';
	echo '<td>'.$value.'</td>';
	echo ' </tr>';
}
/*
            jobs.id as jobId,
  			applications.id as applicationId,
  			jobs.user_id as clientUserId,
  			applications.user_id as freelancerUserId,
  			applications.freelance_service_id as freelancerServiceId,
  			freelance_services.title,
  			applications.rate_in_cents,
  			applications.projected_hours,
  			applications.cover_letter
*/
function printTableRow($r) {
 	echo'<h2>Application details:</h2><br>
	<table class="fancy">';
  printRow('Freelancer', '<a href="freelancedetails.php?id='.$r['freelancerserviceid'].'">More</a>');
	printRow('Title', $r['title']);
	printRow('Cover Letter:', $r['cover_letter']);
	$money  = $r['rate_in_cents']/100;
	setlocale(LC_MONETARY, 'en_US');
	printRow('Rate', money_format('%(#10n', $money));
	printRow('Projected hours:', $r['projected_hours']);
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if ( isset($_GET['application_id']) && 
           	   isset($_GET['job_id']) && 
           	   getSessionUser() != null 
              )
					{
					    $applicationId = $_GET['application_id'];
					    $jobId = $_GET['job_id'];
					    $userId = getSessionUser();
						$allRows = selectOneApplicationForMyJob($db, $jobId, $applicationId, $userId);
          } else {
					    echo '<b>Error!</b>';
					}
				if(sizeof($allRows) > 0) {
					printTableRow($allRows[0]);
				}

 s   } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>