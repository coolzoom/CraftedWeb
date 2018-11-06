<?php
    /* ___           __ _           _ __    __     _     
      / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__
      / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \
      / /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
      \____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/

      -[ Created by �Nomsoft
      `-[ Original core by Anthony (Aka. CraftedDev)

      -CraftedWeb Generation II-
      __                           __ _
      /\ \ \___  _ __ ___  ___  ___  / _| |_
      /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|
      / /\  / (_) | | | | | \__ \ (_) |  _| |_
      \_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -
      The policy of Nomsoftware states: Releasing our software
      or any other files are protected. You cannot re-release
      anywhere unless you were given permission.
      � Nomsoftware 'Nomsoft' 2011-2012. All rights reserved. */

    define('INIT_SITE', TRUE);
    include "../../includes/misc/headers.php";
    include "../../includes/configuration.php";
    include "../functions.php";

    global $GameServer, $GameAccount;
    $conn = $GameServer->connect();

    $GameServer->selectDB("webdb", $conn);

    # Organized Alphabeticaly

    switch ($_POST['action'])
    {
        case "addLink": 
        {
            $title     = $conn->escape_string($_POST['title']);
            $url       = $conn->escape_string($_POST['url']);
            $shownWhen = $conn->escape_string($_POST['shownWhen']);

            if (empty($title) || empty($url) || empty($shownWhen))
            {
                die("Please enter all fields.");
            }

            if ($conn->query("INSERT INTO site_links (title, url, shownWhen) VALUES('". $title ."', '". $url ."', '". $shownWhen ."');"))
            {
                $GameServer->logThis("Added ". $title ." to the menu");
            }
            else
            {
                $GameServer->logThis("Could Not Add The Menu - ". $conn->error);
            }
            
            break;
        }
        
        case "deleteImage":
        {
            $id = $conn->escape_string($_POST['id']);

            if ($conn->query("DELETE FROM slider_images WHERE position=". $id .";"))
            {
                $GameServer->logThis("Removed a slideshow image");
            }
            else
            {
                $GameServer->logThis("Could Not Remove The Selected Slideshow Image - ". $conn->error);
            }
            break;
        }

        case "deleteLink":
        {
            $id = $conn->escape_string($_POST['id']);

            if($conn->query("DELETE FROM site_links WHERE position=". $id .";"))
            {
                $GameServer->logThis("Removed a menu link");
            }
            else
            {
                $GameServer->logThis("Could Not Remove A Menu Link - ". $conn->error);
            }
            break;
        }

        case "disablePlugin":
        {
            $foldername = $conn->escape_string($_POST['foldername']);

            if ($conn->query("INSERT INTO disabled_plugins VALUES('". $foldername ."');"))
            {
                include "../../core/plugins/" . $foldername . "/info.php";
                $GameServer->logThis("Disabled the plugin " . $title);
            }
            else
            {
                $GameServer->logThis("Could Not Disable The Plugin - ". $conn->error);   
            }
            break;
        }

        case "enablePlugin":
        {
            $foldername = $conn->escape_string($_POST['foldername']);

            if ($conn->query("DELETE FROM disabled_plugins WHERE foldername='". $foldername ."';"))
            {
                include "../../core/plugins/" . $foldername . "/info.php";
                $GameServer->logThis("Enabled the plugin -" . $title);
            }
            else
            {
                $GameServer->logThis("Coud Not Enable The Plugin - ". $conn->error);
            }
            break;
        }

        case "getMenuEditForm":
        {
            $id = $conn->escape_string($_POST['id']);
            $result = $conn->query("SELECT * FROM site_links WHERE position=". $id .";");
            $rows   = $result->fetch_assoc();
            ?>
            Title<br/>
            <input type="text" id="editlink_title" value="<?php echo $rows['title']; ?>"><br/>
            URL<br/>
            <input type="text" id="editlink_url" value="<?php echo $rows['url']; ?>"><br/>
            Show when<br/>
            <select id="editlink_shownWhen">
                <option value="always" <?php 
                    if ($rows['shownWhen'] == "always")
                    {
                        echo "selected='selected'";
                    } ?>
                >Always</option>
                <option value="logged" <?php 
                    if ($rows['shownWhen'] == "logged")
                    {
                        echo "selected='selected'";
                    } ?>
                >The user is logged in</option>
                <option value="notlogged" <?php 
                    if ($rows['shownWhen'] == "notlogged")
                    {
                        echo "selected='selected'";
                    } ?>
                >The user is not logged in</option>
            </select><br/>
            <input type="submit" value="Save" onclick="saveMenuLink('<?php echo $rows['position']; ?>')">
            <?php
            break;
        }

        case "installTemplate":
        {
            $name = $conn->escape_string(trim($_POST['name']));
            $path = $conn->escape_string(trim($_POST['path']));
            if ($conn->query("INSERT INTO template (`name`, `path`) VALUES('". $name ."', '". $path ."');"))
            {
                $GameServer->logThis("Installed the template ". $_POST['name']);
            }
            else
            {
                $GameServer->logThis("Error installing the template ". $conn->error);
            }
            break;
        }

        case "saveMenu":
        {
            $title     = $conn->escape_string($_POST['title']);
            $url       = $conn->escape_string($_POST['url']);
            $shownWhen = $conn->escape_string($_POST['shownWhen']);
            $id        = $conn->escape_string($_POST['id']);

            if (empty($title) || empty($url) || empty($shownWhen))
            {
                die("Please enter all fields.");
            }

            if ($conn->query("UPDATE site_links SET title='". $title ."', url='". $url ."', shownWhen='". $shownWhen ."' WHERE position=". $id .";"))
            {
                $GameServer->logThis("Modified the menu");
            }
            else
            {
                $GameServer->logThis("Could Not Modifie The Menu - ". $conn->error);
            }

            echo TRUE;
            break;
        }

        case "setTemplate":
        {
            $templateId = $conn->escape_string($_POST['id']);
            if ($conn->query("UPDATE template SET applied='0' WHERE applied='1';") && 
                $conn->query("UPDATE template SET applied='1' WHERE id=". $templateId .";"))
            {
                $result = $conn->query("SELECT name FROM template WHERE id=". $templateId .";");
                $GameServer->logThis("Template Changed To `". $result->fetch_assoc()['name'] ."`");
            }
            else
            {
                $GameServer->logThis("Could Not Change The Template - ". $conn->error);
            }
            break;
        }

        case "uninstallTemplate":
        {
            $templateId = $conn->escape_string($_POST['id']);
            $result = $conn->query("SELECT name FROM template WHERE id=". $templateId .";");

            if ($conn->query("DELETE FROM template WHERE id=". $templateId .";") && 
                $conn->query("UPDATE template SET applied='1' ORDER BY id ASC LIMIT 1;"))
            {
                $GameServer->logThis("Uninstalled Template - `". $result->fetch_assoc()['name'] ."`");
            }
            else
            {
                $GameServer->logThis("Could Not Uninstall The Template - ". $conn->error);
            }
            break;
        }

        default:
        {
            header("Location: ../index.php");
            break;
        }
    }
