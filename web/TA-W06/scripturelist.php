<?php
function displayAllScriptures($db){
	
    $allRows = selectAllScriptures($db);
							foreach($allRows as $r) 
							{
								echo '<b>'.$r['book']." ".$r['chapter'].":".$r['verse'].'<br>'.$r['content'].'</b>';
								$id = $r['id'];
								$topics = selectTopics($db, $id);

								foreach($topics as $t) {
									echo '<b> '.$t['name'].'</b> ';
								}
								echo '<br>';
							}	

}
?>