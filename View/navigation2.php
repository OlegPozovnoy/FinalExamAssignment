<div>
        <nav>
            <ul>
            <!--<li><a href = "signup.php">Signup</li>-->
            
            <?php

            
            if ($login->is_loggedin()== true)
                {
                    echo '<li><a href = "../index.php?action=logout">Logout</a></li>';
                
                if ($_SERVER['PHP_SELF'] <> '/main.php') 
                    {
                        echo '<li><a href = "../main.php?action=main">ToTheSecretPage</a></li>';                                
                    }
                }

                if ($login->is_loggedin()== false && $_SERVER['PHP_SELF'] <> '/main.php')
                {
                        echo '<li><a href = "../main.php?action=BasicAuth">ToTheSecretPageWithBasicAuth</a></li>';                                
                }            


            if ($_SERVER['PHP_SELF'] <> '/index.php') 
                {
                    echo '<li><a href = "../index.php?action=star">ToTheStartPage</a></li>';
                }
            if ($_SERVER['PHP_SELF'] <> '/signup.php') 
                {
                    echo '<li><a href = "../signup.php?action=signu">ToTheSignupPage</a></li>'     ;           
                }

            
            ?>
            </ul>
        </nav>
    </div>
