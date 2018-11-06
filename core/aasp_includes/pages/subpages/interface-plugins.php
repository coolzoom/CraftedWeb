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

  global $GamePage, $GameServer;
  $conn = $GameServer->connect();
  $GameServer->selectDB("webdb", $conn);
?>
<div class="box_right_title">Plugins</div>
<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Author</th>
        <th>Created</th>
        <th>Status</th>
    </tr>
    <?php
        $bad = array(".", "..", "index.html");

        $folder = scandir("../core/plugins/");

        if (is_array($folder) || is_object($folder))
        {
            foreach ($folder as $folderName)
            {
                if (!in_array($folderName, $bad))
                {
                    if (file_exists("../core/plugins/". $folderName ."/info.php"))
                    {
                        include "../core/plugins/" . $folderName . "/info.php";

                        ?> <tr class="center" onclick="window.location = '?page=interface&selected=viewplugin&plugin=<?php echo $folderName; ?>'"> <?php
                            echo "<td><a href='?page=interface&selected=viewplugin&plugin=". $folderName ."'>". $title ."</a></td>";
                            echo "<td>". substr($desc, 0, 40) ."</td>";
                            echo "<td>". $author ."</td>";
                            echo "<td>". $created ."</td>";
                            
                            $chk = $conn->query("SELECT COUNT(*) AS disabledPlugins FROM disabled_plugins WHERE foldername='". $conn->escape_string($folderName) ."';");
                            if ($chk->fetch_assoc()['disabledPlugins'] == 0) echo "<td>Enabled</td>";
                            else echo "<td>Disabled</td>";
                            echo "</tr>";
                        }
                    }
                }
            }


            if ($count == 0)
            {
                $_SESSION['loaded_plugins'] = NULL;
            }
            else
            {
                $_SESSION['loaded_plugins'] = $loaded_plugins;
            }
        ?>
</table>