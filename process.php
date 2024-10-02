<?php 
session_start();
session_destroy();
header("Location: destinations.php");
exit(); 
?>