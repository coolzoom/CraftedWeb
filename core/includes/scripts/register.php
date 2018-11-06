<?php

#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by �Nomsoft
#		  `-[ Original core by Anthony (Aka. CraftedDev)
#
#				-CraftedWeb Generation II-                  
#			 __                           __ _   							   
#		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
#		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
#		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
#		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
#                  The policy of Nomsoftware states: Releasing our software   
#                  or any other files are protected. You cannot re-release    
#                  anywhere unless you were given permission.                 
#                  � Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    


    require "../ext_scripts_class_loader.php";

    global $Connect, $Account;
    $conn = $Connect->connectToDB();
    $Connect->selectDB("logondb", $conn);

    if (isset($_POST['register']))
    {
        $username        = $conn->escape_string(trim($_POST['username']));
        $email           = $conn->escape_string(trim($_POST['email']));
        $password        = $conn->escape_string(trim($_POST['password']));
        $repeat_password = $conn->escape_string(trim($_POST['password_repeat']));
        $captcha         = $conn->escape_string($_POST['captcha']);
        $raf             = $conn->escape_string($_POST['raf']);

        $Account->register($username, $email, $password, $repeat_password, $captcha, $raf);
        echo TRUE;
    }

    if (isset($_POST['check']))
    {
        if ($_POST['check'] == "username")
        {
            $username = $conn->escape_string($_POST['value']);

            if ($conn->query("SELECT * FROM account WHERE username='". $username ."';")->num_rows > 0)
            {
                echo "<i class='red_text'>This username is not available</i>";
            }
            else
            {
                echo "<i class='green_text'>This username is available</i>";
            }
        }
    }