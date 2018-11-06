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

    $GameServer->selectDB("logondb", $conn);

    # Organized Alphabeticaly

    switch ($_POST['action']) 
    {
        case "addAccA":
        {
            $user  = $conn->escape_string($_POST['user']);
            $realm = $conn->escape_string($_POST['realm']);
            $rank  = $conn->escape_string($_POST['rank']);

            $guid = $GameAccount->getAccID($user);

            $conn->query("INSERT INTO account_access VALUES(". $guid .", ". $rank .", ". $realm .");");
            $GameServer->logThis("Added GM Account Access For " . ucfirst(strtolower($GameAccount->getAccName($guid))));
            break;
        }
        
        case "edit":
        {
            $email    = $conn->escape_string(trim($_POST['email']));
            $password = $conn->escape_string(trim(strtoupper($_POST['password'])));
            $vp       = $conn->escape_string($_POST['vp']);
            $dp       = $conn->escape_string($_POST['dp']);
            $id       = $conn->escape_string($_POST['id']);
            $extended = NULL;

            $chk1 = $conn->query("SELECT COUNT(*) FROM account WHERE email='". $email ."' AND id=". $id .";");
            if ($chk1->data_seek(0) > 1)
            {
                $extended .= "Changed email to". $email ."<br/>";
            }
            $conn->query("UPDATE account SET email='". $email ."' WHERE id=". $id .";");

            $GameServer->selectDB("webdb", $conn);

            $conn->query("INSERT INTO account_data (id) VALUES(". $id .");");

            $chk2 = $conn->query("SELECT COUNT(*) FROM account_data WHERE vp=". $vp ." AND id=". $id .";");
            if ($chk2->data_seek(0) > 1)
            {
                $extended .= "Updated Vote Points to ". $vp ."<br/>";
            }

            $chk3 = $conn->query("SELECT COUNT(*) FROM account_data WHERE dp=". $dp ." AND id=". $id .";");
            if ($chk3->data_seek(0) > 1)
            {
                $extended .= "Updated Donation Coins to ". $dp ."<br/>";
            }

            $conn->query("UPDATE account_data SET vp=". $vp .", dp =". $dp ." WHERE id=". $id .";");

            if (!empty($password))
            {
                $username = strtoupper(trim($GameAccount->getAccName($id)));

                $password = sha1("". $username .":". $password ."");
                $GameServer->selectDB("logondb", $conn);
                $conn->query("UPDATE account SET sha_pass_hash='". $password ."' WHERE id=". $id .";");
                $conn->query("UPDATE account SET v='0', s='0' WHERE id=". $id .";");
                $extended .= "Changed password<br/>";
            }


            $GameServer->logThis("Modified account information for " . ucfirst(strtolower($GameAccount->getAccName($id))), $extended);
            echo "Settings were saved.";
            break;
        }

        case "editChar":
        {
            $guid            = $conn->escape_string($_POST['guid']);
            $rid             = $conn->escape_string($_POST['rid']);
            $name            = $conn->escape_string(trim(ucfirst(strtolower($_POST['name']))));
            $class           = $conn->escape_string($_POST['class']);
            $race            = $conn->escape_string($_POST['race']);
            $gender          = $conn->escape_string($_POST['gender']);
            $money           = $conn->escape_string($_POST['money']);
            $GameAccountname = $conn->escape_string($_POST['account']);
            $GameAccountid   = $GameAccount->getAccID($GameAccountname);

            if (empty($guid) || empty($rid) || empty($name) || empty($class) || empty($race))
            {
                exit('Error');
            }

            $GameServer->connectToRealmDB($rid);

            $online = $conn->query("SELECT COUNT(*) FROM characters WHERE guid=". $guid ." AND online=1;");
            if ($online->data_seek(0) > 0)
            {
                exit('The character must be online for any change to take effect!');
            }

            $conn->query("UPDATE characters SET name='". $name ."', class=". $class .", race=". $race .", gender=". $gender .", money=". $money .", account=". $GameAccountid ." WHERE guid=". $guid .";");

            echo 'The character was saved!';

            $chk = $conn->query("SELECT COUNT(*) FROM characters WHERE name='". $name ."';");

            if ($chk->data_seek(0) > 1)
            {
                echo '<br/><b>NOTE:</b> It seems like there more than 1 character with this name, this might force them to rename when they log in.';
            }

            $GameServer->logThis("Modified character data for " . $name);

            break;
        }

        case "removeAccA":
        {
            $id = $conn->escape_string($_POST['id']);

            $conn->query("DELETE FROM account_access WHERE id=". $id .";");
            $GameServer->logThis("Modified GM account access for " . ucfirst(strtolower($GameAccount->getAccName($id))));

            break;
        }

        case "saveAccA":
        {
            $id    = $conn->escape_string($_POST['id']);
            $rank  = $conn->escape_string($_POST['rank']);
            $realm = $conn->escape_string($_POST['realm']);

            $conn->query("UPDATE account_access SET gmlevel=". $rank .", RealmID=". $realm ." WHERE id=". $id .";");
            $GameServer->logThis("Modified account access for " . ucfirst(strtolower($GameAccount->getAccName($id))));

            break;
        }

        default:
            # code...
            break;
    }