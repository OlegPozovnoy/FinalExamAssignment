<?php
session_start();
require_once("header.php");  
require_once("../Model/user.php");
$login = new User();
//echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
//echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';
echo '<p>'.$_SESSION['Errors'].'</p>' ;
//require_once('navigation.php');
require_once("navigation2.php");
require_once("footer.php");
?> 	 