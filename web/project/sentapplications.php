<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available jobs</title>
     <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
</head>
<body>
<?php
require 'navbar.php';
?>	
	
<h2>Applications for the job:</h2>
<br>


<?php
require 'db.php';
//Local or Heroku

function printTable($allRows) {
		echo '<table class ="fancy">';
	echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Rate</th>';
    echo '<th>Hours</th>';
    echo '<th>Action</th>';
    echo '<th>Info</th>';
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['title'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					echo '<td>'.$r['projected_hours'].'</td>';
					echo '<td><a href="applyedit.php?freelance_id='.$r['freelancerserviceid'].'&job_id='.$r['jobsid'].'">Edit</a></td>';
					echo '<td><a href="applicationdetails.php?application_id='.$r['applicationid'].'&job_id='.$r['jobsid'].'">More</a></td>';
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
$userId = getSessionUser();
if ($user !== null) {
	$allRows = selectAllApplicationsForUser($db, $userId);					    
	if(sizeof($allRows) > 0) {
		printTable($allRows);
	}
}	

?>
</body>
</html>