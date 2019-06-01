<?php
require('session.php');
echo '<ul>
  <li><a href="./index.php">Jobs</a></li>
  <li><a href="./freelance.php">Freelancers</a></li>';
 if (getSessionUser() != null) {
 	echo '<li><a href="./freelance.php?my=true">My services</a></li>';
 	echo '<li><a href="./myjobs.php">My jobs</a></li>';
 	echo '<li><a href="./logout.php">Logout</a></li>';
 	echo '<li class="username">User Anme</li>';
 } else {
   echo '<li><a href="./login.php">Login</a></li></ul><br>';
 }

?>