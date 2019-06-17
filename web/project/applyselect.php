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

showTitle();

function showTitle() {
	$my = (getSessionUser()!=null);
		if ($my) {
			echo'<h2>Select a service to apply with:</h2><br>';			
		} else {
			echo'<h2>Error:Log in to apply!</h2><br>';
			die();
		}
}

function printTable($allRows, $editable, $jobId) {
	echo '<table class="fancy">';
	echo '<tr>';
	echo '<th>Title</th>';
    echo '<th>Short Description</th>';
    echo '<th>Rate</th>';
    if ($editable) { 
    	echo '<th>Action</th>'; 
    } else {
    	echo '<th>Action</th>';
    }
    echo ' </tr>';
	foreach($allRows as $r) 
				{
					echo '<tr>';
					echo '<td>'.$r['title'].'</td>';
					echo '<td>'.$r['subtitle'].'</td>';
					$money  = $r['rate_in_cents']/100;
					setlocale(LC_MONETARY, 'en_US');
                    echo '<td>'.money_format('%(#10n', $money).'</td>';
					if ($editable) { 
						echo '<td><a href="applyedit.php?freelance_id='.$r['id'].'&job_id='.$jobId.'">Select to apply</a></td>';
					} else {
						echo '<td><a href="applyedit.php?freelance_id='.$r['id'].'&job_id='.$jobId.'">Select to apply</a></td>';
					}
					echo '</tr>';
				}
	echo '</table>';			
}

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	        if ( isset($_GET['job_id']) && $_GET['job_id'] !== '') {
	        	$jobId = htmlspecialchars($_GET['job_id']);
				$allRows = selectFreelanceAllUser($db, getSessionUser());
				}
			if(sizeof($allRows) > 0) {
				printTable($allRows, true, $jobId);
			}
} 
?>	


</body>
</html>