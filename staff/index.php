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



    require "includes/loader.php"; //Load all php scripts
    global $GameServer, $GameAccount;
    $conn = $GameServer->connect();
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $GLOBALS['website_title']; ?> Staff Panel</title>
        <link rel="stylesheet" href="../core/aasp_includes/styles/default/style.css" />
        <link rel="stylesheet" href="../core/aasp_includes/styles/wysiwyg.css" />
        <script type="text/javascript" src="../core/javascript/jquery.js"></script>
    </head>

    <body>
        <div id="overlay"></div>
        <div id="loading"><img src="../core/aasp_includes/styles/default/images/ajax-loader.gif" /></div>
        <div id="leftcontent">
        <div id="menu_left">
        <ul>
            <li id="menu_head">Menu</li>
            <li>Dashboard</li>

            <ul class="hidden" <?php activeMenu('dashboard'); ?>>
                <a href="?page=dashboard">Dashboard</a>
            </ul>
            <?php if ($GLOBALS['staffPanel_permissions']['Pages'] == TRUE)
                { ?>     
                    <li>Pages</li>
                    <ul class="hidden" <?php activeMenu('pages'); ?>>
                        <a href="?page=pages">All Pages</a>
                        <a href="?page=pages&selected=new">Add New</a>
                    </ul>
            <?php }
                if ($GLOBALS['staffPanel_permissions']['News'] == TRUE)
                { ?>
                    <li>News</li>
                    <ul class="hidden" <?php activeMenu('news'); ?>>
                        <a href="?page=news">Post news</a>
                        <a href="?page=news&selected=manage">Manage news</a>
                    </ul>
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Shop'] == TRUE)
                { ?>          
                    <li>Shop</li>
                    <ul class="hidden" <?php activeMenu('shop'); ?>>
                        <a href="?page=shop">Overview</a>
                        <a href="?page=shop&selected=add">Add items</a>
                        <a href="?page=shop&selected=manage">Manage items</a>
                        <a href="?page=shop&selected=tools">Tools</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Donations'] == TRUE)
                {
                    ?>     
                    <li>Donations</li>
                    <ul class="hidden" <?php activeMenu('donations'); ?>>
                        <a href="?page=donations">Overview</a>
                        <a href="?page=donations&selected=browse">Browse</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Logs'] == TRUE)
                {
                    ?>     
                    <li>Logs</li>
                    <ul class="hidden" <?php activeMenu('logs'); ?>>
                        <a href="?page=logs&selected=voteshop">Vote shop</a>
                        <a href="?page=logs&selected=donateshop">Donation shop</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Interface'] == TRUE)
                {
                    ?>     
                    <li>Interface</li>
                    <ul class="hidden" <?php activeMenu('interface'); ?>>
                        <a href="?page=interface">Template</a>
                        <a href="?page=interface&selected=menu">Menu</a>
                        <a href="?page=interface&selected=slideshow">Slideshow</a>
                        <a href="?page=interface&selected=plugins">Plugins</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Users'] == TRUE)
                {
                    ?>     
                    <li>Users</li>
                    <ul class="hidden" <?php activeMenu('users'); ?>>
                        <a href="?page=users">Overview</a>
                        <a href="?page=users&selected=manage">Manage Users</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Realms'] == TRUE)
                {
                    ?>     
                    <li>Realms</li>
                    <ul class="hidden" <?php activeMenu('realms'); ?>>
                        <a href="?page=realms">New realm</a>
                        <a href="?page=realms&selected=manage">Manage realm(s)</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Services'] == TRUE)
                {
                    ?>     
                    <li>Services</li>
                    <ul class="hidden" <?php activeMenu('services'); ?>>
                        <a href="?page=services&selected=voting">Voting Links</a>
                        <a href="?page=services&selected=charservice">Character Services</a>
                    </ul> 
                <?php }
                if ($GLOBALS['staffPanel_permissions']['Tools->Tickets'] == TRUE ||
                        $GLOBALS['staffPanel_permissions']['Tools->Account Access'] == TRUE)
                {
                    ?>    
                    <li>Tools</li>
                    <ul class="hidden" <?php activeMenu('tools'); ?>>
                        <?php if ($GLOBALS['staffPanel_permissions']['Tools->Tickets'] == TRUE)
                        { ?>
                            <a href="?page=tools&selected=tickets">Tickets</a>
                        <?php } ?>
                        <?php if ($GLOBALS['staffPanel_permissions']['Tools->Account Access'] == TRUE)
                        { ?>
                            <a href="?page=tools&selected=accountaccess">Account Access</a>
                    <?php } ?>
                    </ul>  
                <?php } ?>
        </ul>
        </div>
        </div>

        <div id="header">
            <div id="header_text">
        <?php if (isset($_SESSION['cw_staff']))
            { ?>    
                Welcome  
                <b><?php echo $_SESSION['cw_staff']; ?> </b> 
                <a href="?page=logout"><i>(Log out)</i></a> &nbsp; | &nbsp;
                <a href="../" >Back to the website</a>
            <?php }
            else
            {
                echo "<a href='../' >Back to the website</a> | Please log in.";
            } ?>
            </div>
        </div>


        <div id="wrapper">
            <div id="middlecontent">
        <?php if (!isset($_SESSION['cw_staff']))
            { ?>  
                <br/>
                <center>
                    <h2>Please log in</h2>
                    <input type="text" placeholder="Username" id="login_username" style="border: 1px solid #ccc;"/><br/> 
                    <input type="password" placeholder="Password" id="login_password" style="border: 1px solid #ccc;"/><br/>
                    <input type="submit" value="Log in" onclick="login('staff')"/> <br/>
                    <div id="login_status"></div>
                </center><?php
                }
                else
                { ?>
                <div class="box_right">
                    <?php
                    if (!isset($_GET['page']))
                        $page = "dashboard";
                    else
                    {
                        $page = $_GET['page'];
                    }
                    $pages = scandir('../core/aasp_includes/pages');
                    unset($pages[0], $pages[1]);

                    if (!file_exists('../core/aasp_includes/pages/' . $page . '.php'))
                    {
                        include "../core/aasp_includes/pages/404.php";
                    }
                    elseif (in_array($page . '.php', $pages))
                    {
                        include "../core/aasp_includes/pages/". $page .".php";
                    }
                    else
                    {
                        include "../core/aasp_includes/pages/404.php";
                    }
                } ?>
                </div>
            </div>
        <?php if (isset($_SESSION['cw_staff']))
            { ?>
            <div id="rightcontent">
                <?php if ($GLOBALS['forum']['type'] == 'phpbb' && $GLOBALS['forum']['autoAccountCreate'] == TRUE && $page == 'dashboard')
                { ?>
                <div class="box_right">
                <div class="box_right_title">Recent forum activity</div>
                <table>
                    <tr>
                        <th>Account</th>
                        <th>Message</th>
                        <th>Topic</th>
                    </tr>
                    <?php
                    $GameServer->selectDB($GLOBALS['forum']['forum_db'], $conn);
                    $result = $conn->query("SELECT poster_id, post_text, post_time, topic_id FROM phpbb_posts ORDER BY post_id DESC LIMIT 10;");
                    while ($row    = $result->fetch_assoc())
                    {
                        $string   = $row['post_text'];
                        //Lets get the username			
                        $getUser  = $conn->query("SELECT username FROM phpbb_users WHERE user_id=". $row['poster_id'] .";");
                        $user     = $getUser->fetch_assoc();
                        //Get topic
                        $getTopic = $conn->query("SELECT topic_title FROM phpbb_topics WHERE topic_id=". $row['topic_id'] .";");
                        $topic    = $getTopic->fetch_assoc();
                        ?>
                        <tr>
                            <td><a href="http://heroic-wow.net/forum/memberlist.php?mode=viewprofile&u=<?php echo $row['poster_id']; ?>" title="View profile" 
                                   target="_blank"><?php echo $user['username']; ?></a></td>
                            <td><?php echo limit_characters(stripBBcode($string)); ?></td>
                            <td><a href="http://heroic-wow.net/forum/viewtopic.php?t=<?php echo $row['topic_id'] ?>" title="View this topic" target="_blank">
                                    View topic</a></td>
                        </tr>
                <?php } ?>
                </table>
                </div> 
                                    <?php } ?>
                <div class="box_right">
                <div class="box_right_title">Server Status - <b><?php echo $GameServer->getServerStatus(1, TRUE); ?></b></div>
                <table>
                <tr valign="top">
                    <td>
                        Players online: <br/>
                        Active connections: <br/>
                        New accounts today: <br/>
                    </td>
                    <td>
                        <b>
                        <?php echo $GameServer->getPlayersOnline(); ?><br/>
                        <?php echo $GameServer->getActiveConnections(); ?><br/>
                        <?php echo $GameServer->getAccountsCreatedToday(); ?><br/>
                        </b>
                    </td>
                </tr>
                </table>
                </div>    

                <div class="box_right">
                <div class="box_right_title">Website Configuration</div>
                <table>
                <tr valign="top">
                    <td>
                        <tr>
                            
                            <td>MySQL Host:</td>
                            <td>MySQL User:</td>
                            <td>MySQL Password:</td>

                        </tr>
                    </td>
                    <td>
                        <tr style='font-weight: bold;'>
                            
                            <td><?php echo $GLOBALS['connection']['host']; ?></td>
                            <td><?php echo $GLOBALS['connection']['user']; ?></td>
                            <td>****<br/></td>

                        </tr>
                    </td>
                    <td>
                        <tr>
                            
                            <td>Logon Database:</td>
                            <td>Website Database:</td>
                            <td>World Database:</td>
                            <td>Db Rev:</td>

                        </tr>                                         
                    </td>
                    <td>
                        <tr style="font-weight: bold;">
                            
                            <td><?php echo $GLOBALS['connection']['logondb']; ?></td>
                            <td><?php echo $GLOBALS['connection']['webdb']; ?></td>
                            <td><?php echo $GLOBALS['connection']['worlddb']; ?></td>
                            <td><?php
                                $GameServer->selectDB("webdb", $conn);
                                $get = $conn->query("SELECT version FROM db_version;");
                                $row = $get->fetch_assoc();
                                if ($row['version'] == null || empty($row['version'])) $row['version'] = '1.0';
                                echo $row['version']; ?></td>

                        </tr>
                    </td>
                </tr>
                </table>
                </div>          
            </div>         
    <?php } ?>
        </div>               
    </div> 
<?php include "../core/aasp_includes/javascript_loader.php";
    if ( !isset( $_SESSION['cw_admin'] ) )
    {?>
        <script type="text/javascript">
            document.onkeydown = function (event)
            {
                var key_press = String.fromCharCode(event.keyCode);
                var key_code = event.keyCode;
                if (key_code == 13)
                {
                    login("staff");
                }
            }
        </script>
    <?php } ?>
</body>
</html>