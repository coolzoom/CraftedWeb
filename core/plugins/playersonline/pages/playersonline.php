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
    global $Connect, $conn;
    if ($GLOBALS['playersOnline']['enablePage'] != TRUE)
    {
        header("Location: ?page=account");
    }
    $Connect->selectDB("webdb", $conn);
    $result    = $conn->query("SELECT id,name FROM realms WHERE id='" . $GLOBALS['playersOnline']['realm_id'] . "'");
    $row       = $result->fetch_assoc();
    $rid       = $row['id'];
    $realmname = $row['name'];

    $Connect->connectToRealmDB($rid);

    $count = $conn->query("SELECT COUNT(*) AS online FROM characters WHERE name!='' AND online=1");
?>
<div class="box_two_title">Online Players - <?php echo $realmname; ?></div>
<?php
    if ($count->data_seek(0) == 0)
    {
        echo '<b>No players are online right now!</b>';
    }
    else
    {
        ?>
        <table width="100%">
            <tr>
                <th>Name</th>
                <th>Race</th>
                <th>Class</th>
                <th>Guild</th>
                <th>Hk's</th>
                <th>Level</th>
            </tr>
            <?php
            if ($GLOBALS['playersOnline']['pageResults'] > 0)
            {
                $count = $count->fetch_assoc()['online'];
                if ($count > 10)
                    $count = $count - 10;

                $rand = rand(1, $count);

                $result = $conn->query("SELECT guid, name, totalKills, level, race, class, gender, account FROM characters WHERE name!='' 
			AND online=1 LIMIT " . $rand . "," . $GLOBALS['playersOnline']['pageResults'] . "");
            }
            else
            {
                $result = $conn->query("SELECT guid, name, totalKills, level, race, class, gender, account FROM characters WHERE name!='' 
			AND online=1");
            }
            while ($row = $result->fetch_assoc())
            {
                $Connect->connectToRealmDB($rid);
                $getGuild = $conn->query("SELECT guildid FROM guild_member WHERE guid='" . $row['guid'] . "'");
                if ($getGuild->num_rows == 0)
                    $guild    = "None";
                else
                {
                    $g        = $getGuild->fetch_assoc();
                    $getGName = $conn->query("SELECT name FROM guild WHERE guildid='" . $g['guildid'] . "'");
                    $x        = $getGName->fetch_assoc();
                    $guild    = '&lt; ' . $x['name'] . ' &gt;';
                }

                if ($GLOBALS['playersOnline']['display_GMS'] == false)
                {
                    //Check if GM.
                    $Connect->selectDB("logondb", $conn);
                    $checkGM = $conn->query("SELECT COUNT(*) FROM account_access WHERE id='" . $row['account'] . "' AND gmlevel >0");
                    if ($checkGM->data_seek(0) == 0)
                    {
                        echo
                        '<tr style="text-align: center;">
					<td>' . $row['name'] . '</td>
					<td><img src="styles/global/images/icons/race/' . $row['race'] . '-' . $row['gender'] . '.gif" ></td>
					<td><img src="styles/global/images/icons/class/' . $row['class'] . '.gif" ></td>
					<td>' . $guild . '</td>
					<td>' . $row['totalKills'] . '</td>
					<td>' . $row['level'] . '</td>
				</tr>';
                    }
                }
                else
                {
                    echo
                    '<tr style="text-align: center;">
					<td>' . $row['name'] . '</td>
					<td><img src="styles/global/images/icons/race/' . $row['race'] . '-' . $row['gender'] . '.gif" ></td>
					<td><img src="styles/global/images/icons/class/' . $row['class'] . '.gif" ></td>
					<td>' . $guild . '</td>
					<td>' . $row['totalKills'] . '</td>
					<td>' . $row['level'] . '</td>
				</tr>';
                }
            }
            ?>
        </table>
    <?php } ?>