<?php
session_start();
require_once("Model/user.php");
$login = new User();



$action = filter_input(INPUT_POST,'action').filter_input(INPUT_GET,'action');

//if ($_SERVER['PHP_SELF'] == '/main.php')
//    {
//        echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
//        echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';
//        echo '<pre> GETVars' . print_r($_GET, TRUE) . '</pre>';
//        echo '<pre> Server' . print_r($_SERVER, TRUE) . '</pre>';
//        exit();
//    }
//echo '<br/>Action: '.$action." is logged in:".$login->is_loggedin();

$_SESSION['Errors'] = '';

if ($action=='signup' && $_SERVER['PHP_SELF'] == '/signup.php' )
    {
        $_POST['action'] = '';
        $login->signUp();
    }


else if ($action=='signin' && $_SERVER['PHP_SELF'] == '/index.php')
        {
            $_POST['action'] = '';
            echo "StartSigningin";
            if ($login->signIn()==true)
            {
            $login->redirect('main.php');
            }
            else
            {
                echo '<pre> SessionVars' . print_r($_SESSION, TRUE) . '</pre>';
                echo '<pre> PostVars' . print_r($_POST, TRUE) . '</pre>';
                echo '<pre> GETVars' . print_r($_GET, TRUE) . '</pre>';
                echo '<pre> Server' . print_r($_SERVER, TRUE) . '</pre>';
                exit();

            }
        }

else if ($action=='logout'){ //to avoid unnecessary redirection to myself
            session_unset();
            session_destroy();  
     }

else if($login->is_loggedin() <> true && $_SERVER['PHP_SELF'] == '/main.php')//force basic auth
{
    //echo 'Here comes the basic auth';
    
    
    //$_SERVER['PHP_AUTH_USER'] = null;
    //$login = filter_input(INPUT_SERVER, $_SERVER['PHP_AUTH_USER']);
    //$pwd =   filter_input(INPUT_SERVER, $_SERVER['PHP_AUTH_PW']);
  
    if (/*!isset($_SERVER['PHP_AUTH_USER']) && !isset($_POST['user_id']) &&*/ $login->signIn() == false)
    {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Unoutharized access";        
        exit();
    }



}
        

if($login->is_loggedin() <> true && $_SERVER['PHP_SELF'] == '/main.php')//GTFO
{
        $login->redirect('index.php');
    }
?>