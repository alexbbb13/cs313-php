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
						// var_dump($book);
						// var_dump($chapter);
						// var_dump($verse);
						// var_dump($content);	
						$lastRow  = insertScripture($db, $book, $chapter, $verse, $content);
					    var_dump($lastRow);	
						foreach($_GET['check_list'] as $selected){
							//@TODO insert into database
							insertScriptureTopic($db, $lastRow, $selected);
							echo $selected."</br>";
						}


						    $allRows = selectAllScriptures($db);
							foreach($allRows as $r) 
							{
								echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].$r['content'].'</b>';
								$id = $r['id'];
								$topics = selectTopics($db, $id);
								foreach($allRows as $r) {
									echo '<b> '.r['name'].'</b> ';
								}
								//echo ' <span class="text_content">'.$r['content'].'</span>';
								//echo '<a href="details.php?id='.$r['id'].'">Click here</a>';
								//echo '<a href="details.html">Click here</a>';
								echo '<br>';
							}					    
					} else {
					    echo '<b>Error!</b>';
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows);
				}

    }
?>     