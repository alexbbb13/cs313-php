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

function printFreelanceForEdit($freelanceId, $title, $subtitle, $description, $rate_in_cents) {
        //if id is null -> create new for this user, if id is not null - edit
        echo '<h2>Create/edit freelance service:</h2>
        <br>
        <form action="freelancesubmit.php" method="POST">';
        if($freelanceId != null) {
            echo '<input type="hidden" type="number" name="freelance_id" value="'.$freelanceId.'">';
        }
        echo 'Title:
        <input name="title" type="text" value="'.$title.'" size="80"><br>
        Subtitle:
        <input name="subtitle" type="text" value="'.$subtitle.'" size="80">
        <br>
        Description:
        <textarea name="description" value="'.$description.'" rows="20" cols="80"></textarea>
        <br>
        Rate per hour: $
        <input name="rate_in_dollars" type="number" value="'.$rate_in_cents.'" min="0.00" max="1000.00" step="0.01">
        <br>
        <input type="submit">
        </form>';
    }

$db = getDb();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key
           if (isset($_GET['id'])) //freelance service id
					{
					   $id = $_GET['id'];
                       $user = getSessionUser();
						$allRows = selectFreelanceById($db, $id, $user);
						if(sizeof($allRows) > 0) {
					      $r = $allRows[0];
					      $money  = $r['rate_in_cents']/100;
					      setlocale(LC_MONETARY, 'en_US');
					      printFreelanceForEdit($id, $r['title'],$r['subtitle'],$r['description'],$money);
				      }							    
					} else {
                        // id is not supplied, or a service with such and id not found for the user
					    echo '<h2>Creating new freelance service</h2><br>';
                        printFreelanceForEdit(null, '','','',0);
					}
				

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>