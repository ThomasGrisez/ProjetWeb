<?php
// Destroy the session when log out and redirect to the login page
session_start();
$_SESSION = array();
session_destroy();
header("Location: login.php");
?>