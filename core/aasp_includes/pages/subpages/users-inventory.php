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

    global $GamePage, $GameServer, $GameAccount; 
    $conn = $GameServer->connect();
?>
<div class="box_right_title">
    <?php echo $GamePage->titleLink(); ?> &raquo; Character Inventory
</div>
Showing Inventory Of Character 
<a href="?page=users&selected=viewchar&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>">
    <?php echo $GameAccount->getCharName($_GET['guid'], $_GET['rid']); ?>
</a>
<hr/>
Filter:
<a href="?page=users&selected=inventory&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>&f=equip">
<?php
    if (isset($_GET['f']) && $_GET['f'] == "equip")
    {
        echo "<b>";
    }
?>
    Equipped Items</a>
<?php
    if (isset($_GET['f']) && $_GET['f'] == "equip")
    {
        echo "</b>";
    }
?>
</a> 

&nbsp; | &nbsp; 

<a href="?page=users&selected=inventory&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>&f=bank">
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "bank")
        {
            echo "<b>";
        }
    ?>
    Items in bank
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "bank")
        {
            echo "</b>";
        }
    ?>
</a> 

&nbsp; | &nbsp; 

<a href="?page=users&selected=inventory&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>&f=keyring">
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "keyring")
        {
            echo "<b>";
        }
    ?>
    Items in keyring
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "keyring")
        {
            echo "</b>";
        }
    ?>
</a> 

&nbsp; | &nbsp; 

<a href="?page=users&selected=inventory&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>&f=currency">
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "currency")
        {
            echo "<b>";
        }
    ?>
    Currencies
    <?php
        if (isset($_GET['f']) && $_GET['f'] == "currency")
        {
            echo "</b>";
        }
    ?>
</a> 

&nbsp; | &nbsp; 

<a href="?page=users&selected=inventory&guid=<?php echo $_GET['guid']; ?>&rid=<?php echo $_GET['rid']; ?>">
    <?php
        if (!isset($_GET['f']))
        {
            echo "<b>";
        }
    ?>
    All Items
    <?php
        if (!isset($_GET['f']))
        {
            echo "</b>";
        }
    ?>
</a> 
<p/>
<?php
    $GameServer->connectToRealmDB($_GET['rid']);
    $equip_array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18);

    $result = $conn->query("SELECT guid, itemEntry, count FROM item_instance WHERE owner_guid=". $conn->escape_string($_GET['guid']) .";");
    if ($result->num_rows == 0)
    {
        echo "No Items Were Found!";
    }
    else
    {
        echo "<table cellspacing='3' cellpadding='5'>";
        while ($row = $result->fetch_assoc())
        {
            $entry = $row['itemEntry'];

            if (isset($_GET['f']))
            {
                if ($_GET['f'] == 'equip')
                {
                    $getPos = $conn->query("SELECT slot, bag FROM character_inventory 
                        WHERE item='". $row['guid'] ."' AND bag='0' AND slot RANGE(0,18) AND guid=". $conn->escape_string($_GET['guid']) .";");
                }
                elseif ($_GET['f'] == 'bank')
                {
                    $getPos = $conn->query("SELECT slot, bag FROM character_inventory 
                        WHERE item='". $row['guid'] ."' AND slot>=39 AND slot<=73;");
                }
                elseif ($_GET['f'] == 'keyring')
                {
                    $getPos = $conn->query("SELECT slot, bag FROM character_inventory 
                        WHERE item='". $row['guid'] ."' AND slot>=86 AND slot<=117;");
                }
                elseif ($_GET['f'] == 'currency')
                {
                    $getPos = $conn->query("SELECT slot, bag FROM character_inventory 
                        WHERE item='". $row['guid'] ."' AND slot>=118 AND slot<=135;");
                }
            }
            else
            {
                $getPos = $conn->query("SELECT slot, bag FROM character_inventory WHERE item='". $row['guid'] ."';");
            }

            if ($getPos->data_seek(0) > 0)
            {
                $pos =$getPos->fetch_assoc();

                $GameServer->selectDB('worlddb');
                $get = $conn->query("SELECT name, entry, quality, displayid FROM item_template WHERE entry='". $entry ."';");
                $r   = $get->fetch_assoc();

                $GameServer->selectDB('webdb');
                $getIcon = $conn->query("SELECT icon FROM item_icons WHERE displayid='". $r['displayid'] ."';");
                if ($getIcon->num_rows == 0)
                {
                    //No icon found. Probably cataclysm item. Get the icon from wowhead instead.
                    $sxml = new SimpleXmlElement(file_get_contents("http://www.wowhead.com/item=". $entry ."&xml"));

                    $icon = strtolower($conn->escape_string($sxml->item->icon));
                    //Now that we have it loaded. Add it into database for future use.
                    //Note that WoWHead XML is extremely slow. This is the main reason why we're adding it into the db.
                    $conn->query("INSERT INTO item_icons VALUES('". $row['displayid'] ."', '". $icon ."');");
                }
                else
                {
                    $iconrow = $getIcon->fetch_assoc();
                    $icon    = strtolower($iconrow['icon']);
                }

                $GameServer->connectToRealmDB($_GET['rid']);
                ?>
                <tr bgcolor="#e9e9e9">
                    <td width="36"><img src="http://static.wowhead.com/images/wow/icons/medium/<?php echo $icon; ?>.jpg"></td>
                    <td>
                        <a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $r['entry']; ?>" title="" target="_blank"><?php echo $r['name']; ?></a>
                    </td>
                    <td>x<?php echo $row['count']; ?> 

                        <?php
                        if (!isset($_GET['f']))
                        {
                            if (in_array($pos['slot'], $equip_array) && $pos['bag'] == 0)   echo "(Equipped)";
                            if ($pos['slot'] >= 39 && $pos['slot'] <= 73)                   echo "(Bank)";
                            if ($pos['slot'] >= 86 && $pos['slot'] <= 117)                  echo "(Keyring)";
                            if ($pos['slot'] >= 118 && $pos['slot'] <= 135)                 echo "(Currency)";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        echo "</table>";
    }