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


    require "core/includes/loader.php"; //Load all php scripts
?>
<!DOCTYPE>
<html>
<head>
    <?php require "core/includes/template_loader.php"; ?>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        <?php
            echo $website_title ." - ";

            while ( $page_title = current($GLOBALS['core_pages']) )
            {
                if ( $page_title == $_GET['page'] .'.php' )
                {
                    echo key( $GLOBALS['core_pages'] );
                    $foundPT = TRUE;
                }
                next( $GLOBALS['core_pages'] );
            }
            if ( !isset( $foundPT ) )
            {
                echo htmlentities( ucfirst( $_GET['page'] ) );
            }
        ?>
    </title>

    <?php
        $content = new Page( "core/styles/". $template['path'] ."/template.html" );

        $content->loadCustoms(); //Load custom modules

        $content->replace_tags( array('content' 		=> 'core/modules/content.php') ); //Main content 
        $content->replace_tags( array('menu' 		=> 'core/modules/menu.php') );
        $content->replace_tags( array('login' 		=> 'core/modules/login.php') );
        $content->replace_tags( array('account' 		=> 'core/modules/account.php') );
        $content->replace_tags( array('serverstatus' => 'core/modules/server_status.php') );
        $content->replace_tags( array('slideshow' 	=> 'core/modules/slideshow.php') );
        $content->replace_tags( array('footer' 		=> 'core/modules/footer.php') );
        $content->replace_tags( array('loadjava' 	=> 'core/includes/javascript_loader.php') );
        $content->replace_tags( array('social' 		=> 'core/modules/social.php') );
        $content->replace_tags( array('alert' 		=> 'core/modules/alert.php') );
    ?>
</head>

<body>
    <?php
        $content->output();
    ?>
</body>
</html>