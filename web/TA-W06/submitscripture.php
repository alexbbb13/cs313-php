<?php
require('db.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key

           if (isset($_GET['book']) && isset($_GET['chapter']) && isset($_GET['verse']) && isset($_GET['content']))
					{

						$book = $_GET['book'];
						$chapter = $_GET['chapter'];
						$verse = $_GET['verse'];
						$content = $_GET['content'];
						$db = getDb();
						$lastRow  = insertScripture($db, $book, $chapter, $verse, $content);
					    if (isset($_GET['new_topic_name']) && isset($_GET['new_topic']))
						{
							//New topic;
							$topic = $_GET['new_topic_name'];
							$topicId = insertTopic($db, $topic);
							insertScriptureTopic($db, $lastRow, $topicId);
						} elseif (isset($_GET['check_list'])) {
							foreach($_GET['check_list'] as $selected){
							//@TODO insert into database
							insertScriptureTopic($db, $lastRow, $selected);
						}

					} else {
					    echo '<b>Error!</b>';
					}

    }
$newPage = "newscripture.php";
header("Location: $newPage");
die();   
?>     