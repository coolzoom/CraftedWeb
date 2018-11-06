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
    $conn = $GameServer->connect();;

    $GameServer->selectDB("webdb", $conn);

    # Organized Alphabeticaly

    switch ($_POST['action'])
    {

        case "addmulti":
        {
            $il_from = $conn->escape_string($_POST['il_from']);
            $il_to   = $conn->escape_string($_POST['il_to']);
            $price   = $conn->escape_string($_POST['price']);
            $quality = $conn->escape_string($_POST['quality']);
            $shop    = $conn->escape_string($_POST['shop']);
            $type    = $conn->escape_string($_POST['type']);

            if (empty($il_from) || empty($il_to) || empty($price) || empty($shop))
            {
                die("Please enter all fields.");
            }

            $advanced = "";
            if ($type != "all")
            {
                if ($type == "15-5" || $type == "15-5")
                {
                    //Mount or pet
                    $type = explode('-', $type);

                    $advanced .= "AND class='" . $type[0] . "' AND subclass='" . $type[1] . "'";
                }
                else
                {
                    $advanced .= "AND class='" . $type . "'";
                }
            }

            if ($quality != "all")
            {
                $advanced .= " AND quality='" . $quality . "'";
            }

            $GameServer->selectDB("worlddb", $conn);
            $get = $conn->query("SELECT entry,name,displayid,ItemLevel,quality,class,AllowableRace,AllowableClass,subclass,Flags 
                FROM item_template WHERE itemlevel>=". $il_from ."  AND itemlevel<=". $il_to ." ". $advanced .";") 
            or die('Error whilst getting item data from the database. Error message: ' . $conn->error);

            $GameServer->selectDB("webdb", $conn);

            $c   = 0;
            while ($row = $get->fetch_assoc())
            {
                $faction = 0;

                if ($row['AllowableRace'] == 690)
                {
                    $faction = 1;
                }
                elseif ($row['AllowableRace'] == 1101)
                {
                    $faction = 2;
                }
                else
                {
                    $faction = $row['AllowableRace'];
                }

                $conn->query("INSERT INTO shopitems (entry,name,in_shop,displayid,type,itemlevel,quality,price,class,faction,subtype,flags) VALUES 
                    ('". $row['entry'] ."',
                    '". $conn->escape_string($row['name']) ."',
                    '". $shop ."',
                    '". $row['displayid'] ."',
                    '". $row['class'] ."',
                    '". $row['ItemLevel'] ."',
                    '". $row['quality'] ."',
                    '". $price ."',
                    '". $row['AllowableClass'] ."',
                    '". $faction ."',
                    '". $row['subclass'] ."',
                    '". $row['Flags'] ."')")
                or die("Error whilst adding items to the database. Error message: " . $conn->error);

                $c++;
            }

            $GameServer->logThis("Added multiple items to the " . $shop . " shop");
            echo 'Successfully added ' . $c . ' items';
            break;
        }

        case "addsingle":
        {
            $entry = $conn->escape_string($_POST['entry']);
            $price = $conn->escape_string($_POST['price']);
            $shop  = $conn->escape_string($_POST['shop']);

            if (empty($entry) || empty($price) || empty($shop))
            {
                die("Please enter all fields.");
            }

            $GameServer->selectDB("worlddb", $conn);
            $get = $conn->query("SELECT name,displayid,ItemLevel,quality,AllowableRace,AllowableClass,class,subclass,Flags FROM item_template WHERE entry=". $entry ."")
                or die('Error whilst getting item data from the database. Error message: ' . $conn->error);
            $row = $get->fetch_assoc();

            $GameServer->selectDB("webdb", $conn);

            if ($row['AllowableRace'] == "-1")
            {
                $faction = 0;
            }
            elseif ($row['AllowableRace'] == 690)
            {
                $faction = 1;
            }
            elseif ($row['AllowableRace'] == 1101)
            {
                $faction = 2;
            }
            else
            {
                $faction = $row['AllowableRace'];
            }

            $conn->query("INSERT INTO shopitems (entry,name,in_shop,displayid,type,itemlevel,quality,price,class,faction,subtype,flags) VALUES 
                (". $entry .",
                '". $conn->escape_string($row['name']) ."',
                '". $shop ."',
                '". $row['displayid'] ."',
                '". $row['class'] ."',
                '". $row['ItemLevel'] ."',
                '". $row['quality'] ."',
                '". $price ."',
                '". $row['AllowableClass'] ."',
                '". $faction ."',
                '". $row['subclass'] ."',
                '". $row['Flags'] ."');")
                or die("Error whilst adding items to the database. Error message: ". $conn->error);

            $GameServer->logThis("Added " . $row['name'] . " to the " . $shop . " shop");

            echo 'Successfully added item';
            break;
        }

        case "clear":
        {
            $shop = $conn->escape_string($_POST['shop']);

            if ($shop == 1)
            {
                $shop = "vote";
            }
            elseif ($shop == 2)
            {
                $shop = "donate";
            }

            $conn->query("DELETE FROM shopitems WHERE in_shop='". $shop ."';");
            $conn->query("TRUNCATE shopitems;");
            return;

            break;
        }

        case "delmulti":
        {
            $il_from = $conn->escape_string($_POST['il_from']);
            $il_to   = $conn->escape_string($_POST['il_to']);
            $quality = $conn->escape_string($_POST['quality']);
            $shop    = $conn->escape_string($_POST['shop']);
            $type    = $conn->escape_string($_POST['type']);

            if (empty($il_from) || empty($il_to) || empty($shop))
            {
                die("Please enter all fields.");
            }

            $advanced = "";
            if ($type != "all")
            {
                if ($type == "15-5" || $type == "15-5")
                {
                    //Mount or pet
                    $type = explode('-', $type);

                    $advanced .= "AND type='" . $type[0] . "' AND subtype='" . $type[1] . "'";
                }
                else
                    $advanced .= "AND type='" . $type . "'";
            }

            if ($quality != "all")
                $advanced .= "AND quality='" . $quality . "'";

            $count = $conn->query("SELECT COUNT(*) FROM shopitems WHERE itemlevel >=". $il_from ." AND itemlevel <=". $il_to ." ". $advanced .";");

            $conn->query("DELETE FROM shopitems WHERE itemlevel >=". $il_from ." AND itemlevel <=". $il_to ." ". $advanced .";");
            echo "Successfully removed ". $count ." items!";

            break;
        }

        case "delsingle":
        {
            $entry = $conn->escape_string($_POST['entry']);
            $shop  = $conn->escape_string($_POST['shop']);

            if (empty($entry) || empty($shop))
                die("Please enter all fields.");

            $conn->query("DELETE FROM shopitems WHERE entry=". $entry ." AND in_shop='". $shop ."';");
            echo 'Successfully removed item';

            break;
        }

        case "modmulti":
        {
            $il_from = $conn->escape_string($_POST['il_from']);
            $il_to   = $conn->escape_string($_POST['il_to']);
            $price   = $conn->escape_string($_POST['price']);
            $quality = $conn->escape_string($_POST['quality']);
            $shop    = $conn->escape_string($_POST['shop']);
            $type    = $conn->escape_string($_POST['type']);

            if (empty($il_from) || empty($il_to) || empty($price) || empty($shop))
                die("Please enter all fields.");

            $advanced = "";
            if ($type != "all")
            {
                if ($type == "15-5" || $type == "15-5")
                {
                    //Mount or pet
                    $type = explode('-', $type);

                    $advanced .= "AND type='" . $type[0] . "' AND subtype='" . $type[1] . "'";
                }
                else
                    $advanced .= "AND type='" . $type . "'";
            }

            if ($quality != "all")
                $advanced .= "AND quality='" . $quality . "'";

            $count = $conn->query("COUNT(*) FROM shopitems WHERE itemlevel >='" . $il_from . "' AND itemlevel <='" . $il_to . "' " . $advanced);

            $conn->query("UPDATE shopitems SET price='". $price ."' WHERE itemlevel >=". $il_from ." AND itemlevel <=". $il_to ." ". $advanced .";");
            echo "Successfully modified ". $count ." items!";

            break;
        }

        case "modsingle":
        {
            $entry = $conn->escape_string($_POST['entry']);
            $price = $conn->escape_string($_POST['price']);
            $shop  = $conn->escape_string($_POST['shop']);

            if (empty($entry) || empty($price) || empty($shop))
            {
                die("Please enter all fields.");
            }

            $conn->query("UPDATE shopitems SET price='". $price ."' WHERE entry=". $entry ." AND in_shop='". $shop ."';");
            echo 'Successfully modified item';
            break;
        }

    }