<?php
require('session.php');
echo '<ul>
  <li><a href="./index.php">Jobs</a></li>
  <li><a href="./freelance.php">Freelancers</a></li>';
 if (getSessionUser() != null && getSessionUserName() != null) {
 	echo '<li><a href="./freelance.php?my=true">My services</a></li>';
 	echo '<li><a href="./jobs_my.php">My open jobs</a></li>';
 	echo '<li><a href="./sentapplications.php">Sent applications</a></li>';
 	echo '<li><a href="./logout.php">Logout</a></li>';
 	echo '<li style="float:right"><a href="./freelance.php?my=true">'.getSessionUserName().'</a></li>';
 } else {
   echo '<li><a href="./login.php">Login</a></li>';
   echo '<li><a href="./signup.php">Signup</a></li>';
 }
 echo '</ul><br>';

?>