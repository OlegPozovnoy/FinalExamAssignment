<?php
require_once("Control/control.php");

/*session_start();
require_once("Model/user.php");
$login = new User();



//if($login->is_loggedin())
//{
//	$login->redirect('index.php');
//}
//$_SESSION['user_id'] = filter_input(INPUT_POST,'user_id');
$_SESSION['Errors'] = '';
//echo $_SESSION['user_id'];
echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';
echo '<pre> GETVars' . print_r($_GET, TRUE) . '</pre>';
echo '<pre> GETVars' . print_r($_SERVER, TRUE) . '</pre>';

$action = filter_input(INPUT_POST,'action').filter_input(INPUT_GET,'action');

echo 'Action:'.filter_input(INPUT_POST,'action');

if ($action=='logout'){ //to avoid unnecessary redirection to myself
    session_unset();
    session_destroy();  
}

if ($action=='signin')
    {
        $_POST['action'] = '';
        echo "StartSigningin";
        if ($login->signIn())
        {
        $login->redirect('main.php');
        }
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
        <link rel="stylesheet" type="text/css" href="/css/hell.css?v={random number/string}">
    </head>
    <body>
        <h1>Lets get it started</h1>
       <!-- <nav><h2><a href = "signup.php">Signup</h2></nav>-->


    <form method = "post" action = "index.php">
        <fieldset>

            <label for="user_id">Name: </label>
            <input type = "text" name="user_id" id="user_id"> </input>

            <label for="password"> Password: </label>
            <input type = "password" name = "password"></innput>

            <input type="hidden" name="action" id="action" value="signin"/>
            <input type="submit" value="Sign in" name="submit"></input>

        </fieldset>

    </form>

        <?php
        require_once('./view/navigation.php');
        
        ?>
    </body>
</html>
