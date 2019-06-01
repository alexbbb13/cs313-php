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

/*
title varchar(80) not null,
	subtitle varchar(80),
	description varchar(6000),
	rate_in_cents integer not null,
*/
 function printFreelanceForEdit($title, $subtitle, $description, $rate_in_cents) {
        echo '<h2>Create/edit freelance service:</h2>
        <br>
        <form action="freelancesubmit.php" method="POST">
        Title:
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
					   $filter = $_GET['id'];
                       $user = getSessionUser();
						$allRows = selectFreelanceById($db, $filter, $user);
						if(sizeof($allRows) > 0) {
					      $r = $allRows[0];
					      $money  = $r['rate_in_cents']/100;
					      setlocale(LC_MONETARY, 'en_US');
					      printFreelanceForEdit($r['title'],$r['subtitle'],$r['description'],$money);
				      }							    
					} else {
					    echo '<b>Error!</b>';
					}
				

    } else {
    	//echo "<p>no request method!</p>";
    }
?>
</body>
</html>