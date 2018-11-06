<?php
    session_start();
    ini_set('display_errors', 1);

    if (isset($_POST['step']))
    {
        switch ($_POST['step'])
        {
            case(1):
                step1();
                break;

            case(2):
                step2();
                break;

            case(3):
                step3();
                break;

            case(4):
                step4();
                break;

            case(5):
                step5();
                break;
        }
    }

    function step1()
    {
        if (!isset($_POST['submit']) && $_POST['submit'] != "step1")
        {
            return NULL;
            exit;
        }

        if (empty($_POST['realmlist']) ||
            empty($_POST['title']) ||
            empty($_POST['domain']) ||
            empty($_POST['expansion']) ||
            empty($_POST['paypal']) ||
            empty($_POST['email']))
        {
            die("Please Enter All Fields!");
        }

        if (file_exists("../core/includes/classes/validator.php"))
        {
        	include "../core/includes/classes/validator.php";

            $step1_required = array
            (
                "web_host",
                "web_port",
                "web_user",
                "web_password",
                "web_database",

                "logon_host",
                "logon_port",
                "logon_user",
                "logon_password",
                "logon_database",

                "world_host",
                "world_port",
                "world_user",
                "world_password",
                "world_database",

                "realmlist",
                "title",
                "domain",
                "expansion",
                "paypal",
                "email"
            );

            $step = array
            (
                "web_host"          => $_POST['web_host'],
                "web_port"          => $_POST['web_port'],
                "web_user"          => $_POST['web_user'],
                "web_password"      => $_POST['web_password'],
                "web_database"      => $_POST['web_database'],

                "logon_host"        => $_POST['logon_host'],
                "logon_port"        => $_POST['logon_port'],
                "logon_user"        => $_POST['logon_user'],
                "logon_password"    => $_POST['logon_password'],
                "logon_database"    => $_POST['logon_database'],
                "logon_checked"     => $_POST['logon_checked'],

                "characters_host" => $_POST['characters_host'],
                "characters_port" => $_POST['characters_port'],
                "characters_user" => $_POST['characters_user'],
                "characters_password" => $_POST['characters_password'],
                "characters_database" => $_POST['characters_database'],
                "characters_checked" => $_POST['characters_checked'],

                "world_host"        => $_POST['world_host'],
                "world_port"        => $_POST['world_port'],
                "world_user"        => $_POST['world_user'],
                "world_password"    => $_POST['world_password'],
                "world_database"    => $_POST['world_database'],
                "world_checked"     => $_POST['world_checked'],

                "realmlist"         => $_POST['realmlist'],
                "title"             => $_POST['title'],
                "domain"            => $_POST['domain'],
                "expansion"         => $_POST['expansion'],
                "paypal"            => $_POST['paypal'],
                "email"             => $_POST['email']
            );

        	$Validator = new Validator(null, $step1_required, $step1_required);

            # $_POST has been sanatized.
    		$_POST = $Validator->sanatize($_POST);

            # Auth/Logon Server
            if ($step['logon_checked'] == TRUE)
            {
                $_SESSION['install']['logon']['database']['host']       = "127.0.0.1";
                $_SESSION['install']['logon']['database']['port']       = "3306";
                $_SESSION['install']['logon']['database']['username']   = "root";
                $_SESSION['install']['logon']['database']['password']   = "";

                # Host
                if (!empty($step['logon_host']))
                {
                    $_SESSION['install']['logon']['database']['host'] = $step['logon_host'];
                }

                # Port
                if (!empty($step['logon_port']))
                {
                    $_SESSION['install']['logon']['database']['port'] = $step['logon_port'];
                }

                # Username
                if (!empty($step['logon_user']))
                {
                    $_SESSION['install']['logon']['database']['username'] = $step['logon_user'];
                }

                # Password
                if (!empty($step['logon_password']))
                {
                    $_SESSION['install']['logon']['database']['password'] = $step['logon_password'];
                }
            }

            if ($step['characters_checked'] == TRUE)
            {
                $_SESSION['install']['characters']['database']['host']       = "127.0.0.1";
                $_SESSION['install']['characters']['database']['port']       = "3306";
                $_SESSION['install']['characters']['database']['username']   = "root";
                $_SESSION['install']['characters']['database']['password']   = "";

                # Host
                if (!empty($step['characters_host']))
                {
                    $_SESSION['install']['characters']['database']['host'] = $step['characters_host'];
                }

                # Port
                if (!empty($step['characters_port']))
                {
                    $_SESSION['install']['characters']['database']['port'] = $step['characters_port'];
                }

                # Username
                if (!empty($step['characters_user']))
                {
                    $_SESSION['install']['characters']['database']['username'] = $step['characters_user'];
                }

                # Password
                if (!empty($step['characters_password']))
                {
                    $_SESSION['install']['characters']['database']['password'] = $step['characters_password'];
                }
            }

            # World Server
            if ($step['world_checked'] == TRUE)
            {
                $_SESSION['install']['world']['database']['host']       = "127.0.0.1";
                $_SESSION['install']['world']['database']['port']       = "3306";
                $_SESSION['install']['world']['database']['username']   = "root";
                $_SESSION['install']['world']['database']['password']   = "";

                # Host
                if (!empty($step['logon_host']))
                {
                    $_SESSION['install']['world']['database']['host'] = $step['logon_host'];
                }

                # Port
                if (!empty($step['logon_port']))
                {
                    $_SESSION['install']['world']['database']['port'] = $step['logon_port'];
                }

                # Username
                if (!empty($step['logon_user']))
                {
                    $_SESSION['install']['world']['database']['username'] = $step['logon_user'];
                }

                # Password
                if (!empty($step['logon_password']))
                {
                    $_SESSION['install']['world']['database']['password'] = $step['logon_password'];
                }
            }

            # Web
            $_SESSION['install']['web']['database']['host']     = "127.0.0.1";
            $_SESSION['install']['web']['database']['port']     = "3306";
            $_SESSION['install']['web']['database']['username'] = "root";
            $_SESSION['install']['web']['database']['password'] = "";
            $_SESSION['install']['web']['database']['name']     = "craftedcms";

            if (!empty($step['web_database']))
            {
                $_SESSION['install']['web']['database']['name'] = $step['web_database'];
            }

            if (!empty($step['web_host']))
            {
                $_SESSION['install']['web']['database']['port'] = $step['web_host'];
            }

            if (!empty($step['web_port']))
            {
                $_SESSION['install']['web']['database']['port'] = $step['web_port'];
            }

            if (!empty($step['web_user']))
            {
                $_SESSION['install']['web']['database']['username'] = $step['web_user'];
            }

            if (!empty($step['web_password']))
            {
                $_SESSION['install']['web']['database']['password'] = $step['web_password'];
            }


            if ($step['logon_checked'] == false && $step['world_checked'] == false && $step['characters_checked'])
            {
                $_SESSION['install']['logon']['database']['host']       = $_SESSION['install']['web']['database']['host'];
                $_SESSION['install']['logon']['database']['port']       = $_SESSION['install']['web']['database']['port'];
                $_SESSION['install']['logon']['database']['username']   = $_SESSION['install']['web']['database']['username'];
                $_SESSION['install']['logon']['database']['password']   = $_SESSION['install']['web']['database']['password'];

                $_SESSION['install']['characters']['database']['host']  = $_SESSION['install']['web']['database']['host'];
                $_SESSION['install']['characters']['database']['port']  = $_SESSION['install']['web']['database']['port'];
                $_SESSION['install']['characters']['database']['username'] = $_SESSION['install']['web']['database']['username'];
                $_SESSION['install']['characters']['database']['password'] = $_SESSION['install']['web']['database']['password'];

                $_SESSION['install']['world']['database']['host']       = $_SESSION['install']['web']['database']['host'];
                $_SESSION['install']['world']['database']['port']       = $_SESSION['install']['web']['database']['port'];
                $_SESSION['install']['world']['database']['username']   = $_SESSION['install']['web']['database']['username'];
                $_SESSION['install']['world']['database']['password']   = $_SESSION['install']['web']['database']['password'];
            }

            if (empty($step['logon_database']))
            {
                $_SESSION['install']['logon']['database']['name'] = "auth";
            }
            else
            {
                $_SESSION['install']['logon']['database']['name'] = $step['logon_database'];
            }

            if (empty($step['world_database']))
            {
                $_SESSION['install']['world']['database']['name'] = "world";
            }
            else
            {
                $_SESSION['install']['world']['database']['name'] = $step['world_database'];
            }

            if (empty($step['characters_database']))
            {
                $_SESSION['install']['characters']['database']['name'] = "characters";
            }
            else
            {
                $_SESSION['install']['characters']['database']['name'] = $step['characters_database'];
            }

            $_SESSION['install']['web']['realmlist']    = $step['realmlist'];
            $_SESSION['install']['web']['title']        = $step['title'];
            $_SESSION['install']['web']['domain']       = $step['domain'];
            $_SESSION['install']['web']['expansion']    = $step['expansion'];
            $_SESSION['install']['web']['paypal']       = $step['paypal'];
            $_SESSION['install']['web']['email']        = $step['email'];
    	}
        print TRUE;
        exit;
    }
    

    function step2()
    {
    	$config = false;
    	$sql 	= false;

        if ( is_writable("../core/includes/configuration.php") )
        {
            $config = TRUE;
        }

        if ( is_readable("sql/CraftedWeb_Base.sql") )
        {
            $sql = TRUE;
        }

        if ( $sql == TRUE && $config == TRUE )
        {
            exit("Both Configuration file & SQL file are write & readable. <a href=\"?step=3\">Click here to continue</a>");
        }

        if ( $sql == TRUE && $config == false )
        {
            exit("SQL file <i>is</i> readable. Configuration file is <b>NOT</b> writeable. Please check the instructions above.");
        }

        if ( $sql == false && $config == TRUE )
        {
            exit("SQL file is <b>NOT</b> readable. Configuration file <i>is</i> writeable. Please check the instructions above.");
        }
        else
        {
            exit("Neither the SQL file or the Configuration file is writeable. Please check the instructions above.");
        }
        exit;
    }

    function step3()
    {
        if ( !isset( $_POST['submit'] ) || $_POST['submit'] != "step3" )
        {
            return NULL;
            exit;
        }


        echo "[Info] Connecting to database...";
        $conn = new mysqli(
            $_SESSION['install']['web']['database']['host'], 
            $_SESSION['install']['web']['database']['username'],
            $_SESSION['install']['web']['database']['password'],
            null,
            (int)$_SESSION['install']['web']['database']['port']);

        if ( $conn->connect_errno != 0 )
        {
            die("<br/>[FAILURE] Could not connect to the database. Please <a href=\"./index.php\">restart</a> the installation. ");
        }

        echo "<br>[Success] Connected to database.<br>[Info] Creating Website database...";

        if ( !$conn->query("CREATE DATABASE IF NOT EXISTS ". $conn->escape_string($_SESSION['install']['web']['database']['name']) .";") )
        {
            die("<br>[FAILURE] Could not create the website database. ". $conn->error." .Please <a href=\"./index.php\">restart</a> the installation.");
        }

        echo "<br>[Success] Created Website database.
        <br>[Info] Connecting to Website database";

        if ( !$conn->select_db($_SESSION['install']['web']['database']['name']) )
        {
        	die("<br>[FAILURE] Could not connect to the Website database. Please <a href=\"./index.php\">restart</a> the installation.");
        }

        echo "<br>[Success] Connected to Website database.
        <br>[Info] Creating tables & inserting data into Website database...";

        $f        = fopen("sql/CraftedWeb_Base.sql", "r+");
        $sqlFile  = fread($f, filesize("sql/CraftedWeb_Base.sql"));
        $sqlArray = explode(";", $sqlFile);

        if ( is_array($sqlArray) || is_object($sqlArray) )
        {
            foreach ($sqlArray as $stmt)
            {
                if ( strlen($stmt) > 3 )
                {
                    if ( !$conn->query($stmt) )
                    {
                        die("<br>[FAILURE] Could not run SQL file for the Website database. Please <a href=\"./index.php\"restart</a> the installation. (". $conn->error .")");
                    }
                }
            }
        }

        echo "<br>[Success] SQL file imported successfully!
        <br>[Info] (Optional) Trying to import <i>item_icons</i> into Website database.";

        $f        = fopen("sql/item_icons.sql", "r+");
        $sqlFile2 = fread($f, filesize("sql/item_icons.sql"));
        $sqlArray = explode(";", $sqlFile2);

        if ( is_array($sqlArray) || is_object($sqlArray) )
        {
            foreach ($sqlArray as $stmt)
            {
                if ( strlen($stmt) > 3 )
                {
                    if ( !$conn->query($stmt) )
                    {
                        $err = 1;
                    }
                }
            }
        }
        if ( !isset($err) )
        {
            echo "<br/>[Success] SQL file imported successfully!";
        }
        else
        {
            echo "<br/>[Info] <i>item_icons</i> was not imported. (". $conn->error .")";
        }

        echo "<br/>[Info] Writing configuration file...";


        $config = '
<?php
	if( !defined("INIT_SITE") )
		exit();
		
	#############################
	## CRAFTEDWEB CONFIG FILE  ##
	## GENERATION 1            ##
	## Author:				   ##
	## Anthony @ CraftedDev    ##
	## Edited/Modified:        ##
	## Alexandre @ SkyLiner    ##
	## github.com/alexandre433 ##
	## ------------------------##
	## Please note that:       ##
	## TRUE = Enabled          ##
	## false = Disabled        ##
	#############################
	
	#*************************#
	# General settings      
	#*************************#
	$useDebug = false; 
	//If you are having problems with your website, set this to "TRUE", if not, set to \"false\". 
	//All errors will be logged and visible in "includes/error-log.php". If set to false, error log will be blank. 
	//This will also enable/disable errors on the Admin- & Staff panel.
	 
	$maintainance = false; //Maintainance mode, will close the website for everyone. True = enable, false = disable
	$maintainance_allowIPs = array(\'herp.derp.13.37\'); //Allow specific IP addresses to view the website even though you have maintainance mode enabled.
	//Example: \'123.456.678\', \'987.654.321\'
	 
	$website_title = "'. $_SESSION['install']['web']['title'] .'"; //The title of your website, shown in the users browser.
	 
	$default_email = "'. $_SESSION['install']['web']['email'] .'"; //The default email address from wich Emails will be sent.

	$website_domain = "'. $_SESSION['install']['web']['domain'] .'"; //Provide the domain name AND PATH to your website.
	//Example: http://yourserver.com/
	//If you have your website in a sub-directory, include that aswell. Ex: http://yourserver.com/cataclysm/
	 
	$showLoadTime = TRUE; 
	//Shows the page load time in the footer.
	 
	$footer_text = "Copyright &copy; '. $_SESSION['install']['web']['title'] .' ".date("Y")."<br/>
	All rights reserved"; //Set the footer text, displayed at the bottom.
	//Tips: &copy; = Copyright symbol. <br/> = line break.
	 
	$timezone = "'. date_default_timezone_get() .'"; //Gets the time zone for your website, from the server\'s location/timezone.
	//Full list of supported timezones can be found here: http://php.net/manual/en/timezones.php
	 
	$core_expansion = '. $_SESSION['install']['web']['expansion'] .'; //The expansion of your server.
	// 0 = Vanilla
	// 1 = The Burning Crusade
	// 2 = Wrath of The Lich King
	// 3 = Cataclysm
	// 4 = Mists Of Pandaria
	// 5 = Legion

	$adminPanel_enable = TRUE; //Enable or disable the Administrator Panel. Default: TRUE
	$staffPanel_enable = TRUE; //Enable or disable the Staff Panel. Default: TRUE
	 
	$adminPanel_minlvl = 4; //Minimum gm level of which accounts are able to log in to the Admin Panel. Default: 4
	$staffPanel_minlvl = 3; //Minimum gm level of which accounts are able to log in to the Staff Panel. Default: 3
	 
	$staffPanel_permissions[\'Pages\'] 					= false;
	$staffPanel_permissions[\'News\'] 					= false;
	$staffPanel_permissions[\'Shop\'] 					= false;
	$staffPanel_permissions[\'Donations\'] 				= false;
	$staffPanel_permissions[\'Logs\'] 					= TRUE;
	$staffPanel_permissions[\'Interface\'] 				= false;
	$staffPanel_permissions[\'Users\'] 					= TRUE;
	$staffPanel_permissions[\'Realms\'] 				= false;
	$staffPanel_permissions[\'Services\'] 				= false;
	$staffPanel_permissions[\'Tools->Tickets\'] 		= TRUE;
	$staffPanel_permissions[\'Tools->Account Access\'] 	= false;
	$staffPanel_permissions[\'editNewsComments\'] 		= TRUE;
	$staffPanel_permissions[\'editShopItems\'] 			= false;
	 
	//Pages 				= Disable/Enable pages & Create custom pages.
	//News 					= Edit/Delete/Post news.
	//Shop 					= Add/Edit/Remove shop items.
	//Donations 			= View donations overview & log.
	//Logs 					= View vote & donation shop logs.
	//Interface 			= Edit the menu, template & slideshow.
	//Users 				= View & edit user data.
	//Realms 				= Edit/Delete/Add realms.
	//Services 				= Edit voting links & character services.
	//Tools->Tickets 		= View/Lock/Delete tickets.
	//Tools->Account Access = Edit/Remove/Add account access.
	//editNewsComments 		= Edit/Remove news comments.
	//editShopItems 		= Edit/Remove shop items.
	 
	$enablePlugins = TRUE; //Enable or disable the use of plugins. Plugins May slow down your site a bit.
	 
	#*************************#
	# 	Slideshow settings 
	#*************************#
	$enableSlideShow = TRUE; //Enable or Disable the slideshow. This will only be shown at the home page. 
	
	#*************************#
	# 	Website compression settings    
	#*************************#
	
	$compression[\'gzip\'] 				= TRUE; //This is very hard to explain, but it may boost your website speed drastically.
	$compression[\'sanitize_output\'] 	= TRUE; //This will strip all the whitespaces on the HTML code written. This should increase the website speed slightly. 
	//And "copycats" will have a hard time stealing your HTML code :>
	
	$useCache = false; //Enable / Disable the use of caching. It\'s in early developement and is currently only applied to very few things in the core at the moment.
	//You will probably not notice any difference when enabling this, unless you have alot of visitors. Who knows, I havent tried.
	
	
	#*************************#
	# News settings   
	#*************************#
	$news[\'enable\'] 				= TRUE;  // Enable/Disable the use of the news system at the homepage. 
	$news[\'maxShown\'] 			= 5; 	 // Maximum amount of news posts that will be shown on the home page.
							 				 // People can still view all posts by clicking the \"All news\" button.
	$news[\'enableComments\'] 		= TRUE;  // Make people able to comment on your news posts.
	$news[\'limitHomeCharacters\'] 	= false; // This will limit the characters shown in the news post. People will have to click the \"Read more...\" button
											 //to read the whole news post. 
	
	
	#***** Server status ******#
	$serverStatus[\'enable\']            = TRUE;  //This will enable/disable the server status box.
	$serverStatus[\'nextArenaFlush\']    = false; //This will display the next arena flush for your realm(s).
	$serverStatus[\'uptime\']	         = TRUE;  //This will display the uptime of your realm(s).
	$serverStatus[\'playersOnline\']     = TRUE;  //This will show current players online
	$serverStatus[\'factionBar\']        = TRUE;  //This will show the players online faction bar.
	
	
	#*************************#
	# Website MySQL connection settings
	#*************************#
	
	$connection[\'web\'][\'host\']        = "'. $_SESSION['install']['web']['database']['host'] .'";
    $connection[\'web\'][\'port\']        = "'. $_SESSION['install']['web']['database']['port'] .'";
	$connection[\'web\'][\'user\']        = "'. $_SESSION['install']['web']['database']['username'] .'";
	$connection[\'web\'][\'password\']    = "'. $_SESSION['install']['web']['database']['password'] .'";
	$connection[\'web\'][\'database\']    = "'. $_SESSION['install']['web']['database']['name'] .'";


    #*************************#
    # Logon MySQL connection settings
    #*************************#
    $connection[\'logon\'][\'host\']        = "'. $_SESSION['install']['logon']['database']['host'] .'";
    $connection[\'logon\'][\'port\']        = "'. $_SESSION['install']['logon']['database']['port'] .'";
    $connection[\'logon\'][\'user\']        = "'. $_SESSION['install']['logon']['database']['username'] .'";
    $connection[\'logon\'][\'password\']    = "'. $_SESSION['install']['logon']['database']['password'] .'";
    $connection[\'logon\'][\'database\']    = "'. $_SESSION['install']['logon']['database']['name'] .'";

    #*************************#
    # Characters MySQL connection settings
    #*************************#
    $connection[\'characters\'][\'host\']        = "'. $_SESSION['install']['characters']['database']['host'] .'";
    $connection[\'characters\'][\'port\']        = "'. $_SESSION['install']['characters']['database']['port'] .'";
    $connection[\'characters\'][\'user\']        = "'. $_SESSION['install']['characters']['database']['username'] .'";
    $connection[\'characters\'][\'password\']    = "'. $_SESSION['install']['characters']['database']['password'] .'";
    $connection[\'characters\'][\'database\']    = "'. $_SESSION['install']['characters']['database']['name'] .'";


    #*************************#
    # World MySQL connection settings
    #*************************#
    $connection[\'world\'][\'host\']        = "'. $_SESSION['install']['world']['database']['host'] .'";
    $connection[\'world\'][\'port\']        = "'. $_SESSION['install']['world']['database']['port'] .'";
    $connection[\'world\'][\'user\']        = "'. $_SESSION['install']['world']['database']['username'] .'";
    $connection[\'world\'][\'password\']    = "'. $_SESSION['install']['world']['database']['password'] .'";
    $connection[\'world\'][\'database\']    = "'. $_SESSION['install']['world']['database']['name'] .'";



    #*************************#
    # Realmlist
    #*************************#
	$connection[\'realmlist\']   = "'. $_SESSION['install']['web']['realmlist'] .'";
	
	// host 		= Either an IP address or a DNS address
	// user 		= A mysqli user with access to view/write the entire database.
	// password 	= The password for the user you specified
	// logondb 		= The name of your \"auth\" or \"realmdb\" database name. Default: auth
	// webdb 		= The name of the database with CraftedWeb data. Default: craftedweb
	// worlddb 		= The name of your world database. Default: world
	// realmlist 	= This could be your server IP or DNS. Ex: logon.yourserver.com
	
	#*************************#
	# Registration settings
	#*************************#
	$registration[\'userMaxLength\'] = 16;
	$registration[\'userMinLength\'] = 3;
	$registration[\'passMaxLength\'] = 255;
	$registration[\'passMinLength\'] = 5;
	$registration[\'validateEmail\'] = false;
	$registration[\'captcha\']       = TRUE;
	
	//userMaxLength = Maximum length of usernames
	//userMinLength = Minimum length of usernames
	//passMaxLength = Maximum length of passwords
	//passMinLength = Minimum length of passwords
	//validateEmail = Validates if the email address is a correct email address. May not work on some PHP versions.
	//captcha = Enables/Disables the use of the captcha (Anti-bot) 
	
	#*************************#
	# Voting settings
	#*************************#
	$vote[\'timer\']         = 43200;
	$vote[\'type\']          = "confirm";
	$vote[\'multiplier\']    = 2;
	
	// timer = Timer between every vote on each link in seconds. Default: 43200 (12 hours)
	// type = Voting system type. 
	//         \"instant\" = Give vote points instantly when the user clicks the Vote button.
	//         \"confirm\" = Give Vote Points when the user has returned to your website. (Hopefully through clicking on your banner on the topsite)
	// multiplier = Multiply amount of Vote Points given for every vote. Useful for special holidays etc.
	
	#*************************#
	# Donation settings
	#*************************#
	$donation[\'paypal_email\']      = "'. $_SESSION['install']['web']['paypal'] .'";
	$donation[\'coins_name\']        = "Donations Coins";
	$donation[\'currency\']          = "EUR";
	$donation[\'emailResponse\']     = TRUE;
	$donation[\'sendResponseCopy\']  = TRUE;
	$donation[\'copyTo\']            = "'. $_SESSION['install']['web']['email'] .'";
	$donation[\'responseSubject\']   = "Thanks for your support!";
	$donation[\'donationType\']      = 2;
	
	// paypal_email 	= The PayPal email address of wich payment will be sent to.
	// coins_name 		= The name of the donation coins that the user will buy.
	// currency 		= The name of the currency that you want the user to pay with. Default: EUR
	// emailResponse 	= Enabling this will make the donator to recieve a validation email after their donation, containing the donation information. 
	// sendResponseCopy = Set this to "TRUE" if you wish to recieve a copy of the email response mentioned above. 
	// copyTo 			= Enable the sendResponseCopy to activate this function. Enter the email address of wich the payment copy will be sent to. 
	// responseSubject 	= Enable the sendResponseCopy to activate this function. The subject of the email response sent to the donator.
	// donationType 	= How the user will donate. 1 = They can enter how many coins they wish to buy, and the value can be increased with the multiplier.
	// 2 				= A list of options will be shown, you may set the list below.
	
	#  EDITING THIS IS ONLY NECESSARY IF YOU HAVE "donationType" SET TO 2 
	# Just follow the template and enter your custom values
	# array(\'NAME/TITLE\', COINS TO ADD, PRICE) 
	$donationList = array
	(
		array(\'10 Donation Coins - 5€\', 10, 5),
		array(\'20 Donation Coins - 8€\', 20, 8),
		array(\'50 Donation Coins - 20€\', 50, 20),
		array(\'100 Donation Coins - 35€\', 100, 35 ),
		array(\'200 Donation Coins - 70€\', 200, 70 )
	);
	
	#*************************#
	# Vote & Donation shop settings
	#*************************#
	$voteShop[\'enableShop\']            = TRUE;
	$voteShop[\'enableAdvancedSearch\']  = TRUE;
	$voteShop[\'shopType\']              = 1;
	
	// enableShop 				= Enables/disables the use of the Vote Shop. "TRUE" = enable, "false" = disable.
	// enableAdvancedSearch 	= Enabled/disables the use of the advanced search feature. "TRUE" = enable, "false" = disable.
	// shopType 				= The type of shop you wish to use. 1 = "Search". 2 = List all items available.
	
	
	#*************************#
	$donateShop[\'enableShop\']              = TRUE;
	$donateShop[\'enableAdvancedSearch\']    = TRUE;
	$donateShop[\'shopType\']	             = 1;
	
	// Explanations can be found above.
	
	#************************#
	# Social plugins settings
	#*************************#
	$social[\'enableFacebookModule\']    = false;
	$social[\'facebookGroupURL\']        = "http://www.facebook.com/YourServer";
	
	// enableFacebookModule = This will create a Facebook box to the left, below the server status. "TRUE" = enable, "false" = disable.
	// facebookGroupURL 	= The full URL to your facebook group.
	// NOTE! This feature might be a little buggy due to the width of some themes. I wish you good luck though.
	
	#*************************#
	# Forum settings
	#*************************#
	$forum[\'type\']                 = "phpbb";
	$forum[\'autoAccountCreate\']    = false;
	$forum[\'forum_path\']           = "/forum/";
	$forum[\'forum_db\']             = "phpbb";
	
	// type = the type of forum you are using. (phpbb,vbulletin)
	// autoAccountCreate = this function creates a forum account when the user register at the website. 
	// forum_path = The path to the forum. Example: If you have it in YOURSITE.COM/forum/, then put /forum/. (Without "")
	// forum_db = The database name of the forum. If you have the forum database on the same location as your logon database, 
	// 			  this will enable "Latest Forum Activity" on your Admin Panel. 
	######NOTE#######
	// autoAccountCreate is only supported for phpBB, vBulletin will be supported in near future.
	
	#************************#
	# Advanced settings, mostly used for further developement.
	# DO NOT TOUCH THESE CONFIGS unless you know what you are doing!
	#************************#
	
	$core_pages = array
	(
		\'Account Panel\'       => \'account.php\',
        \'Shopping Cart\'       => \'cart.php\', 
        \'Change Password\'     => \'changepass.php\',
        \'Donate\'              => \'donate.php\',
        \'Donation Shop\'       => \'donateshop.php\',
        \'Forgot Password\'     => \'forgotpw.php\',
        \'Home\'                => \'home.php\',
        \'Logout\'              => \'logout.php\',
        \'News\'                => \'news.php\',
        \'Refer-A-Friend\'      => \'raf.php\',
        \'Register\'            => \'register.php\', 
        \'Character Revive\'    => \'revive.php\',
        \'Change Email\'        => \'settings.php\',
        \'Support\'             => \'support.php\', 
        \'Character Teleport\'  => \'teleport.php\',    
        \'Character Unstucker\' => \'unstuck.php\',
        \'Vote\'                => \'vote.php\',
        \'Vote Shop\'           => \'voteshop.php\',
        \'Confirm Service\'     => \'confirmservice.php\'
	);
	
	###LOAD MAXIMUM ITEM LEVEL DEPENDING ON EXPANSION###
	switch( $GLOBALS[\'core_expansion\'] ) 
	{
		case(0):
			$maxItemLevel = 100;
			break;

		case(1):
			$maxItemLevel = 175;
			break;

		default:
		case(2):
			$maxItemLevel = 284;
			break;

		case(3):
			$maxItemLevel = 416;
			break;
	}
	
	if( $GLOBALS[\'core_expansion\'] > 2 )
	{
		$tooltip_href = "www.wowhead.com/";
	}
	else
	{
		$tooltip_href = "www.openwow.com/?";
	}
	
	//Set the error handling.
	if( file_exists("core/includes/classes/error.php") )
	{
		require "core/includes/classes/error.php";
	}		
	elseif( file_exists("../core/classes/error.php") )
	{
		require "../core/includes/classes/error.php";
	}		
	elseif( file_exists("../core/includes/classes/error.php") )
	{
		require "../core/includes/classes/error.php";
	}	
	elseif( file_exists("../../core/includes/classes/error.php") )
	{
		require "../../core/includes/classes/error.php";
	}	
	elseif( file_exists("../../../core/includes/classes/error.php") )
	{
		require "../../../core/includes/classes/error.php";
	}
	
	loadCustomErrors(); //Load custom errors

?>';
        

        if ( !$fp = fopen("../core/includes/configuration.php", "w") )
        {
            die("<br/>[FAILURE] Could not write Configuration file. Please <a href=\"./index.php\">restart</a> the installation.");;
        }
        else
        {
            fwrite($fp, $config);
            fclose($fp);

            echo "<br>[Success] Configuration file was written!";

            echo "<hr>Installation proccess finished. <a href=\"?step=4\">Click here to continue</a>";
            exit;
        }
    }


    function step4()
    {
        if ( !isset($_POST['submit']) || $_POST['submit'] != "step4" )
        {
            return NULL;
            exit;
        }

        $files = scandir("sql/updates/");

        echo "[Info] Connecting to database...";
        $conn = new mysqli(
            $_SESSION['install']['web']['database']['host'], 
            $_SESSION['install']['web']['database']['username'], 
            $_SESSION['install']['web']['database']['password'],
            null,
            $_SESSION['install']['web']['database']['port']);

        if ( $conn->connect_errno != 0 )
        {
            die("<br/>[FAILURE] Could not connect to the database. Please <a href=\"./index.php\">restart</a> the installation. ");
        }

        echo "<br>[Success] Connected to database.
        <br>[Info] Connecting to Website database";

        if ( !$conn->select_db($_SESSION['install']['web']['database']['name']) )
        {
        	die("<br>[FAILURE] Could not connect to the Website database. Please <a href=\"./index.php\">restart</a> the installation.");
        }

        echo "<br>[Success] Connected to Website database
        <br>[Info] Now applying updates...";

        if ( is_array($files) || is_object($files) )
        {
            foreach ($files as $value)
            {
                if ( substr($value, -3, 3) == "sql" )
                {
                    echo "<br>[Info] Applying ". $value ."...";
                    if ( !$f = fopen("sql/updates/". $value, "r+") )
                    {
                        die ("<br/>[FAILURE] Could not open SQL file. Please set the CHMOD to 777 and try again.");
                    }
                    else
                    {
                        $sqlFile  = fread($f, filesize("sql/updates/". $value));
                        $sqlArray = explode(";", $sqlFile);

                        if ( is_array($sqlArray) || is_object($sqlArray) )
                        {
                            foreach ($sqlArray as $stmt)
                            {
                                if ( strlen($stmt) > 3 )
                                {
                                    if ( !$conn->query($stmt) )
                                    {
                                        die("<br/>[FAILURE] Could not run SQL file for the Website database. (". $conn->error .")");
                                    }
                                }
                            }
                            echo "<br>[Success] Update completed.";
                        }
                    }
                }
            }
            echo "<br>[Success] Updates completed. <a href=\"?step=5\">Click here to continue</a>";
        }
        exit;
    }

    function step5()
    {
        if ( !isset($_POST['submit']) || $_POST['submit'] != "step5" )
        {
            return NULL;
            exit;
        }

    	if ( empty( $_POST['realm_name'] ) || 
        	empty( $_POST['realm_access_username'] ) || 
        	empty( $_POST['realm_access_password'] ) || 
        	empty( $_POST['realm_sendtype'] ) || 
        	empty( $_POST['realm_port'] ) )
        {
            die('Please enter all fields.');
        }

        $step5 = array
        (
            "realm_name"                => $_POST['realm_name'],
            "realm_access_username"     => $_POST['realm_access_username'],
            "realm_access_password"     => $_POST['realm_access_password'],
            "realm_description"         => $_POST['realm_description'],
            "realm_sendtype"            => $_POST['realm_sendtype'],
            "realm_port"                => $_POST['realm_port']
        );

        
        if ( file_exists("../core/includes/classes/validator.php") )
        {
        	include "../core/includes/classes/validator.php";

        	$Validator = new Validator(null, $step5, $step5);

            # $_POST has been sanatized.
    		$_POST = $Validator->sanatize($_POST);

            $conn = new mysqli(
                $_SESSION['install']['web']['database']['host'], 
                $_SESSION['install']['web']['database']['username'], 
                $_SESSION['install']['web']['database']['password'],
                null,
                $_SESSION['install']['web']['database']['port']);

            if ( $conn->connect_errno != 0 )
            {
                die("<br/>[FAILURE] Could not connect to the database. Please <a href=\"./index.php\">restart</a> the installation. ");
            }

            $conn->select_db($_SESSION['install']['web']['database']['name']);

            $realm_name     = $conn->escape_string($step5['realm_name']);
            $admin_username = $conn->escape_string($step5['realm_access_username']);
            $admin_password = $conn->escape_string($step5['realm_access_password']);
            $description    = $conn->escape_string($step5['realm_description']);
            $sendtype       = $conn->escape_string($step5['realm_sendtype']);
            $port           = $conn->escape_string($step5['realm_port']);
            
            $conn->query("INSERT INTO realms 
            	(name, description, char_db, port, rank_user, rank_pass, ra_port, soap_port, host, sendType, mysqli_host, mysqli_user, mysqli_pass) 
            	VALUES
            	('". $realm_name ."', 
            	'". $description ."', 
            	'". $_SESSION['install']['characters']['database']['name'] ."', 
            	'". $port ."', 
            	'". $admin_username ."', 
            	'". $admin_password ."', 
            	'". $port ."', 
            	'". $port ."', 
            	'". $_SESSION['install']['characters']['database']['host'] ."', 
            	'". $sendtype ."', 
            	'". $_SESSION['install']['characters']['database']['host'] ."', 
            	'". $_SESSION['install']['characters']['database']['username'] ."', 
            	'". $_SESSION['install']['characters']['database']['password'] ."');")
            or die("Could not insert realm into database. (". $conn->error .")");

            echo "Realm successfully created. <a href=\"?step=6\">Finish Installation</a>";
            exit;
        }
    }
    