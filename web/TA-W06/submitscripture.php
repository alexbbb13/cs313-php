<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // retrieve the form data by using the element's name attributes value as key

           if (isset($_GET['book']) && isset($_GET['chapter']) && isset($_GET['verse']) && isset($_GET['content']))
					{
						$book = $_GET['book'];
						$chapter = $_GET['chapter'];
						$verse = $_GET['verse'];
						$content = $_GET['content'];
						foreach($_GET['check_list'] as $selected){
							//@TODO insert into database
							echo $selected."</br>";
						}

						$allRows = selectFreelanceById($db, $filter);					    
					} else {
					    echo '<b>Error!</b>';
					}
				if(sizeof($allRows) > 0) {
					printTable($allRows);
				}

    }
?>     