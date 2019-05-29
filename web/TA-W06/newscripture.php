<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Freelance services</title>
</head>
<body>
<?php
require('db.php');
require('scripturelist.php');
$db = getDb();
$topics = selectAllTopics($db);
?>
<h2>Insert Scripture</h2>
<br>
<form action="submitscripture.php" method="GET">
  Book:
  <input name="book" type="text"><br>
  Chapter:
  <input name="chapter" type="text"><br>
  Verse:
  <input name="verse" type="text"><br>
  <textarea name ="content" rows="6" cols="50"></textarea><br>
    <?php
    foreach($topics as $t) {
    	$name = $t['name'];
    	$id = $t['id'];
    	echo '<input type="checkbox" name="check_list[]" value="'.$id.'"><label>'.$name.'</label><br>';
    }
    ?>
     Create New Topic:
  <input name="new_topic_name" type="text"><br>
  <input type="checkbox" name="new_topic" value="new_topic"><br>'
  <input type="submit">
</form>
<?php
  displayAllScriptures($db);
  ?>	    
</body>
</html>