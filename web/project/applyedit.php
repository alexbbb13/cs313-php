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
require 'navbar.php';

function printForEdit( $applicationId, $jobId, $freelanceId, $title, $coverLetter, $projectedHours, $rate_in_cents) {
        //if id is null -> create new for this user, if id is not null - edit
        echo '<h2>Create/edit application:</h2>
        <br>
        <form action="applysubmit.php" method="POST">
        <br>';

        if($applicationId != null) {
            //This application exists, so we can delete it
            echo '
            <button name="delete" type="submit" value="true">Delete</button><br><br>
            <input type="hidden" type="number" name="application_id" value="'.$applicationId.'">';
        }

        echo 'Title:
        <input name="title" type="text" value="'.$title.'" size="80"><br>
        <br>
        Cover Letter:
        <textarea name="description" value="'.$coverLetter.'" rows="20" cols="80">'.$coverLetter.'</textarea>
        <br>
        Rate per hour: $
        <input name="rate" type="number" value="'.$rate.'" min="0.00" max="1000.00" step="0.01">
        <br>
        Projected Hours: $
        <input name="hours" type="number" value="'.$hours.'" min="0.5" max="2000.00" step="0.5">
        <br>
        <input type="submit" value="Save and exit" >
        <input type="hidden" type="number" name="job_id" value="'.$jobId.'">
        <input type="hidden" type="number" name="freelance_id" value="'.$freelanceId.'">
        </form>';
    }

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	        if ( isset($_GET['job_id']) && $_GET['job_id'] !== '' && isset($_GET['freelance_id']) ) {
	        	$jobId = $_GET['job_id'];
	        	$freelanceId = $_GET['freelance_id'];
	        	$userId = getSessionUser();
	        	$allRows = selectApplications($db, $jobId, $freelanceId, $userId);
				}
			if(sizeof($allRows) > 0) {
				$r = $allRows[0];
				$applicationId = $r['id'];
				$money  = $r['rate_in_cents']/100;
			    setlocale(LC_MONETARY, 'en_US');
				$rate_in_cents = $r['rate_in_cents'];
				$projected_hours = $r['projected_hours'];
				$cover_letter = $r['cover_letter'];
				printForEdit($applicationId,$jobId, $freelanceId, '',  $cover_letter, $projected_hours,  $money);
			} else {
				printForEdit(null,$jobId, $freelanceId, '',  '', 0.5,  10);
			}
} 

/*
create table applications
(
	id serial not null primary key,
	job_id integer references jobs(id),
	user_id integer references users(id),
	freelance_service_id integer references freelance_services(id),
	rate_in_cents integer not null,
	projected_hours integer,
	cover_letter varchar(2000),
	accepted boolean not null,
	created_at timestamp not null	
);
*/

?>	
<h2>Under construction</h2>
<br> 

</body>
</html>