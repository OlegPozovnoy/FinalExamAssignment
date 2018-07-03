<?php

require_once("Control/control.php");
/*session_start();
require_once("Model/user.php");
$login = new User();



if($login->is_loggedin() <> true)
{
	$login->redirect('index.php');
}
//$_SESSION['user_id'] = filter_input(INPUT_POST,'user_id');
$_SESSION['Errors'] = '';
echo $_SESSION['user_id'];
echo $_SERVER['PHP_SELF'];
echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';
echo '<pre> GETVars' . print_r($_GET, TRUE) . '</pre>';
echo '<pre> ServerVars' . print_r($_SERVER, TRUE) . '</pre>';

$action = filter_input(INPUT_POST,'action').filter_input(INPUT_GET,'action');

echo 'Action:'.filter_input(INPUT_POST,'action');

if ($action=='logout'){ //to avoid unnecessary redirection to myself
    session_unset();
    session_destroy();  
    $login->redirect('index.php');    
}

*/
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main page</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="/css/heaven.css?v={random number/string}">

    </head>
    <body>
        <h1>Welcome back!</h1>
        <?php
        echo '<p>You did a good job and deserved some sleep. I know everything about you. For example, your name is '.$_SESSION['user_id'].' your email is '. $_SESSION['email'].' 
        and your registration date is '.$_SESSION['registrationDate'].'</p>'; 
        ?>
        <!-- <nav><h2><a href = "signup.php">Signup</h2></nav>-->



        <?php
        require_once('./view/navigation.php');
        ?>
    </body>
</html>
