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
//Local or Heroku

function printForEdit($jobId, $title, $description, $rate_in_cents, $projected_hours) {
        //if id is null -> create new for this user, if id is not null - edit
        echo '<h2>Create/edit job:</h2>
        <br>
        <form action="jobsubmit.php" method="POST">
        <br>';

        if($jobId != null) {
            //This jobexists, so we can delete it
            echo '
            <button name="delete" type="submit" value="true">Delete</button><br><br>
            <input type="hidden" type="number" name="job_id" value="'.$jobId.'">';
        }

        echo 'Title:
        <input name="title" type="text" value="'.$title.'" size="80"><br>
        <br>
        Description:
        <textarea name="description" value="'.$description.'" rows="20" cols="80">'.$description.'</textarea>
        <br>
        Rate per hour: $
        <input name="rate_in_dollars" type="number" value="'.$rate_in_cents.'" min="0.00" max="1000.00" step="0.01">
        <br>
        Projected hours: 
        <input name="projected_hours" type="number" value="'.$projected_hours.'" min="0.5" max="10000.00" step="0.5">
        <br>
        <input type="submit" value="Save and exit" >
        </form>';
    }

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['id'])) //freelance service id
					{
					   $id = htmlspecialchars($_GET['id']);
                       $user = getSessionUser();
						$allRows = selectJobByIdUser($db, $id, $user);
						if(sizeof($allRows) > 0) {
					      $r = $allRows[0];
					      $money  = $r['rate_in_cents']/100;
					      setlocale(LC_MONETARY, 'en_US');
					      printForEdit($id, $r['title'],$r['subtitle'],$r['description'],$money);
				      }							    
					} else {
                        // id is not supplied, or a service with such and id not found for the user
					    echo '<h2>Creating new job service</h2><br>';
                        printForEdit(null, '','','',0, 0.5);
					}
}
?>
</body>
</html>