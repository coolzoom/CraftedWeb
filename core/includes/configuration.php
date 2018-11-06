
<?php
	if(!defined('INIT_SITE'))
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
	## FALSE = Disabled        ##
	#############################
	
	#*************************#
	# General settings      
	#*************************#
	$useDebug = TRUE; 
	//If you are having problems with your website, set this to "TRUE", if not, set to \"FALSE\". 
	//All errors will be logged and visible in "includes/error-log.php". If set to FALSE, error log will be blank. 
	//This will also enable/disable errors on the Admin- & Staff panel.
	 
	$maintainance = FALSE; //Maintainance mode, will close the website for everyone. True = enable, FALSE = disable
	$maintainance_allowIPs = array('herp.derp.13.37'); //Allow specific IP addresses to view the website even though you have maintainance mode enabled.
	//Example: '123.456.678', '987.654.321'
	 
	$website_title = "Localhost"; //The title of your website, shown in the users browser.
	 
	$default_email = "alex@alex.com"; //The default email address from wich Emails will be sent.

	$website_domain = "http://localhost"; //Provide the domain name AND PATH to your website.
	//Example: http://yourserver.com/
	//If you have your website in a sub-directory, include that aswell. Ex: http://yourserver.com/cataclysm/
	 
	$showLoadTime = TRUE; 
	//Shows the page load time in the footer.
	 
	$footer_text = "Copyright &copy; Localhost ".date("Y")."<br/>
	All rights reserved"; //Set the footer text, displayed at the bottom.
	//Tips: &copy; = Copyright symbol. <br/> = line break.
	 
	$timezone = "UTC"; //Gets the time zone for your website, from the server's location/timezone.
	//Full list of supported timezones can be found here: http://php.net/manual/en/timezones.php
	 
	$core_expansion = 2; //The expansion of your server.
	// 0 = Vanilla
	// 1 = The Burning Crusade
	// 2 = Wrath of The Lich King
	// 3 = Cataclysm
	// 4 = Mists Of Pandaria
	// 5 = Legion

	$adminPanel_enable = TRUE; //Enable or disable the Administrator Panel. Default: TRUE
	$staffPanel_enable = TRUE; //Enable or disable the Staff Panel. Default: TRUE
	 
	$adminPanel_minlvl = 3; //Minimum gm level of which accounts are able to log in to the Admin Panel. Default: 4
	$staffPanel_minlvl = 2; //Minimum gm level of which accounts are able to log in to the Staff Panel. Default: 3
	 
	$staffPanel_permissions['Pages'] 					= FALSE;
	$staffPanel_permissions['News'] 					= FALSE;
	$staffPanel_permissions['Shop'] 					= FALSE;
	$staffPanel_permissions['Donations'] 				= FALSE;
	$staffPanel_permissions['Logs'] 					= TRUE;
	$staffPanel_permissions['Interface'] 				= FALSE;
	$staffPanel_permissions['Users'] 					= TRUE;
	$staffPanel_permissions['Realms'] 				    = FALSE;
	$staffPanel_permissions['Services'] 				= FALSE;
	$staffPanel_permissions['Tools->Tickets'] 		    = TRUE;
	$staffPanel_permissions['Tools->Account Access'] 	= FALSE;
	$staffPanel_permissions['editNewsComments'] 		= TRUE;
	$staffPanel_permissions['editShopItems'] 			= FALSE;
	 
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
	
	$compression['gzip'] 				= TRUE; //This is very hard to explain, but it may boost your website speed drastically.
	$compression['sanitize_output'] 	= TRUE; //This will strip all the whitespaces on the HTML code written. This should increase the website speed slightly. 
	//And "copycats" will have a hard time stealing your HTML code :>
	
	$useCache = FALSE; //Enable / Disable the use of caching. It's in early developement and is currently only applied to very few things in the core at the moment.
	//You will probably not notice any difference when enabling this, unless you have alot of visitors. Who knows, I havent tried.
	
	
	#*************************#
	# News settings   
	#*************************#
	$news['enable'] 				= TRUE;  // Enable/Disable the use of the news system at the homepage. 
	$news['maxShown'] 				= 5; 	 // Maximum amount of news posts that will be shown on the home page.
							 				 // People can still view all posts by clicking the \"All news\" button.
	$news['enableComments'] 		= TRUE;  // Make people able to comment on your news posts.
	$news['limitHomeCharacters'] 	= FALSE; // This will limit the characters shown in the news post. People will have to click the \"Read more...\" button
											 //to read the whole news post. 
	
	
	#***** Server status ******#
	$serverStatus['enable']            = TRUE;  //This will enable/disable the server status box.
	$serverStatus['nextArenaFlush']    = FALSE; //This will display the next arena flush for your realm(s).
	$serverStatus['uptime']	           = TRUE;  //This will display the uptime of your realm(s).
	$serverStatus['playersOnline']     = TRUE;  //This will show current players online
	$serverStatus['factionBar']        = TRUE;  //This will show the players online faction bar.
	
	
	#*************************#
	# Website DB connection settings
	#*************************#
	
	$connection['web']['host']        = "127.0.0.1";
    $connection['web']['port']        = "3306";
	$connection['web']['user']        = "root";
	$connection['web']['password']    = "";
	$connection['web']['database']    = "craftedcms";


    #*************************#
    # Logon DB connection settings
    #*************************#

    $connection['logon']['host']        = "127.0.0.1";
    $connection['logon']['port']        = "3306";
    $connection['logon']['user']        = "root";
    $connection['logon']['password']    = "";
    $connection['logon']['database']    = "3_auth";

    #*************************#
    # Characters DB connection settings
    #*************************#

    $connection['characters']['host']        = "127.0.0.1";
    $connection['characters']['port']        = "3306";
    $connection['characters']['user']        = "root";
    $connection['characters']['password']    = "";
    $connection['characters']['database']    = "3_characters";

    #*************************#
    # World DB connection settings
    #*************************#

    $connection['world']['host']        = "127.0.0.1";
    $connection['world']['port']        = "3306";
    $connection['world']['user']        = "root";
    $connection['world']['password']    = "";
    $connection['world']['database']    = "3_world";

	// host 		= Either an IP address or a DNS address
	// user 		= A mysqli user with access to view/write the entire database.
	// password 	= The password for the user you specified
	// database		= The name of your database name. Depending on the section


    #*************************#
    # Realmlist
    #*************************#

	$connection['realmlist']   = "localhost";
	
	#*************************#
	# Registration settings
	#*************************#
	$registration['userMaxLength'] = 16;
	$registration['userMinLength'] = 3;
	$registration['passMaxLength'] = 255;
	$registration['passMinLength'] = 5;
	$registration['validateEmail'] = FALSE;
	$registration['captcha']       = FALSE;
	
	//userMaxLength = Maximum length of usernames
	//userMinLength = Minimum length of usernames
	//passMaxLength = Maximum length of passwords
	//passMinLength = Minimum length of passwords
	//validateEmail = Validates if the email address is a correct email address. May not work on some PHP versions.
	//captcha = Enables/Disables the use of the captcha (Anti-bot) 
	
	#*************************#
	# Voting settings
	#*************************#
	$vote['timer']         = 43200;
	$vote['type']          = "confirm";
	$vote['multiplier']    = 2;
	
	// timer = Timer between every vote on each link in seconds. Default: 43200 (12 hours)
	// type = Voting system type. 
	//         \"instant\" = Give vote points instantly when the user clicks the Vote button.
	//         \"confirm\" = Give Vote Points when the user has returned to your website. (Hopefully through clicking on your banner on the topsite)
	// multiplier = Multiply amount of Vote Points given for every vote. Useful for special holidays etc.
	
	#*************************#
	# Donation settings
	#*************************#
	$donation['paypal_email']      = "alex@alex.com";
	$donation['coins_name']        = "Donations Coins";
	$donation['currency']          = "EUR";
	$donation['emailResponse']     = TRUE;
	$donation['sendResponseCopy']  = TRUE;
	$donation['copyTo']            = "alex@alex.com";
	$donation['responseSubject']   = "Thanks for your support!";
	$donation['donationType']      = 2;
	
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
	# array('NAME/TITLE', COINS TO ADD, PRICE) 
	$donationList = array
	(
		array( '10 Donation Coins - 5€', 10, 5 ),
		array( '20 Donation Coins - 8€', 20, 8 ),
		array( '50 Donation Coins - 20€', 50, 20 ),
		array( '100 Donation Coins - 35€', 100, 35 ),
		array( '200 Donation Coins - 70€', 200, 70 )
	);
	
	#*************************#
	# Vote & Donation shop settings
	#*************************#
	$voteShop['enableShop']            = TRUE;
	$voteShop['enableAdvancedSearch']  = TRUE;
	$voteShop['shopType']              = 2;
	
	// enableShop 				= Enables/disables the use of the Vote Shop. "TRUE" = enable, "FALSE" = disable.
	// enableAdvancedSearch 	= Enabled/disables the use of the advanced search feature. "TRUE" = enable, "FALSE" = disable.
	// shopType 				= The type of shop you wish to use. 1 = "Search". 2 = List all items available.
	
	
	#*************************#
	$donateShop['enableShop']              = TRUE;
	$donateShop['enableAdvancedSearch']    = TRUE;
	$donateShop['shopType']	               = 2;
	
	// Explanations can be found above.
	
	#************************#
	# Social plugins settings
	#*************************#
	$social['enableFacebookModule']    = FALSE;
	$social['facebookGroupURL']        = "http://www.facebook.com/YourServer";
	
	// enableFacebookModule = This will create a Facebook box to the left, below the server status. "TRUE" = enable, "FALSE" = disable.
	// facebookGroupURL 	= The full URL to your facebook group.
	// NOTE! This feature might be a little buggy due to the width of some themes. I wish you good luck though.
	
	#*************************#
	# Forum settings
	#*************************#
	$forum['type']                 = "phpbb";
	$forum['autoAccountCreate']    = FALSE;
	$forum['forum_path']           = "/forum/";
	$forum['forum_db']             = "phpbb";
	
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
		'Account Panel'       => 'account.php',
        'Shopping Cart'       => 'cart.php', 
        'Change Password'     => 'changepass.php',
        'Donate'              => 'donate.php',
        'Donation Shop'       => 'donateshop.php',
        'Forgot Password'     => 'forgotpw.php',
        'Home'                => 'home.php',
        'Logout'              => 'logout.php',
        'News'                => 'news.php',
        'Refer-A-Friend'      => 'raf.php',
        'Register'            => 'register.php', 
        'Character Revive'    => 'revive.php',
        'Change Email'        => 'settings.php',
        'Support'             => 'support.php', 
        'Character Teleport'  => 'teleport.php',    
        'Character Unstucker' => 'unstuck.php',
        'Vote'                => 'vote.php',
        'Vote Shop'           => 'voteshop.php',
        'Confirm Service'     => 'confirmservice.php'
	);
	
	###LOAD MAXIMUM ITEM LEVEL DEPENDING ON EXPANSION###
	switch($GLOBALS['core_expansion']) 
	{
		case 0:
			$maxItemLevel = 100;
			break;

		case 1:
			$maxItemLevel = 175;
			break;

		default:
		case 2:
			$maxItemLevel = 284;
			break;

		case 3:
			$maxItemLevel = 416;
			break;

		case 4:
		case 5:
		case 6:
		case 7:
			break;
	}
	
	if($GLOBALS['core_expansion'] > 2)
	{
		$tooltip_href = "www.wowhead.com/";
	}
	else
	{
		$tooltip_href = "www.openwow.com/?";
	}
	
	//Set the error handling.
	if(file_exists("core/includes/classes/error.php"))
	{
		require "core/includes/classes/error.php";
	}		
	elseif(file_exists("../core/classes/error.php"))
	{
		require "../core/classes/error.php";
	}		
	elseif(file_exists("../core/includes/classes/error.php"))
	{
		require "../core/includes/classes/error.php";
	}	
	elseif(file_exists("../../core/includes/classes/error.php"))
	{
		require "../../core/includes/classes/error.php";
	}	
	elseif(file_exists("../../../core/includes/classes/error.php"))
	{
		require "../../../core/includes/classes/error.php";
	}
	
	loadCustomErrors(); //Load custom errors

?>