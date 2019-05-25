<?php
function getSessionUser() { 
    if (isset($_SESSION['UserId'])) {
        return $_SESSION['UserId'];
    } else {
        return null;    
    }
}

function setSessionUser($userId) {
    $_SESSION['UserId'] = $userId;
}
?>