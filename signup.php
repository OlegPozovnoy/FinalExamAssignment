<?php
require_once("Control/control.php");
/*session_start();
require_once("Model/user.php");
$login = new User();



//if($login->is_loggedin())
//{
//    $login->redirect('index.php');
    
//}

//$_SESSION['user_id'] = filter_input(INPUT_POST,'user_id');
$_SESSION['Errors'] = '';

echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';

echo 'Action:'.filter_input(INPUT_POST,'action');

if (filter_input(INPUT_POST,'action')=='signup')
    {
        $_POST['action'] = '';
        //echo "StartSigningup";
        $login->signUp();

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


    <form method = "post" action = "signup.php">
        <fieldset>

            <label for="user_id">Name: </label>
            <input type = "text" name="user_id" id="user_id" maxlength="30"> </input>
            <br/>
            <label for="email">Email: </label>
            <input type = "email" name="email" id="email" maxlength="30"> </input>
            <br/>
            <label for="password"> Password (min 6 characters): </label>
            <input type = "password" name = "password" maxlength="20"></innput>
            <br/>
            <label for="password2"> Confirm password: </label>
            <input type = "password" name = "password2" maxlength="20"></innput>
            <br/>
            <input type="hidden" name="action" id="action" value="signup"/>
            <input type="submit" value="signup" name="submit"></input>

        </fieldset>

    </form>

        <?php
        require_once('./view/navigation.php');
        ?>

    </body>
</html>
