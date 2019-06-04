<?php
function getSessionUser() { 
    if (isset($_SESSION['UserId'])) {
        return $_SESSION['UserId'];
    } else {
        return null;    
    }
}

function getSessionUserName() { 
    if (isset($_SESSION['UserName'])) {
        return $_SESSION['UserName'];
    } else {
        return null;    
    }
}

function setSessionUser($userId, $userName) {
	$_SESSION['UserId'] = $userId;
    $_SESSION['UserName'] = $userName;
}
?>