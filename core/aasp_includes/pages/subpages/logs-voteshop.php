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

<div class="box_right_title">Vote Shop logs</div>
<?php
    $per_page = 40;

    $GameServer->selectDB("webdb", $conn);

    $pages_query = $conn->query("SELECT COUNT(*) AS voteLogs FROM shoplog WHERE shop='vote';");
    $pages       = ceil($pages_query->fetch_assoc()['voteLogs'] / $per_page);

    $page  = ( isset($_GET['page']) ) ? $conn->escape_string($_GET['page']) : 1;
    $start = ($page - 1) * $per_page;

    $result = $conn->query("SELECT * FROM shoplog WHERE shop='vote' ORDER BY id DESC LIMIT ". $start .", ". $per_page .";");
    if ($result->num_rows == 0)
    {
        echo "Seems Like The Vote Shop Log Was Empty!";
    }
    else
    {
        ?>
        <input type='text' value='Search...' id="logs_search" onkeyup="searchLog('vote')">
        <?php echo "<br/><b>Showing " . $start . "-" . ($start + $per_page) . "</b>"; ?>
        <hr/>
        <div id="logs_content">
            <table width="100%">
                <tr>
                    <th>User</th>
                    <th>Character</th>
                    <th>Realm</th>
                    <th>Item</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc())
                {
                    ?>
                    <tr class="center">
                        <td><?php echo $GameAccount->getAccName($row['account']); ?></td>
                        <td><?php echo $GameAccount->getCharName($row['char_id'], $row['realm_id']); ?></td>
                        <td><?php echo $GameServer->getRealmName($row['realm_id']); ?></td>
                        <td><a href="http://<?php echo $GLOBALS['tooltip_href']; ?>item=<?php echo $row['entry']; ?>" title="" target="_blank">
                                <?php echo $GameServer->getItemName($row['entry']); ?></a></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>	
                <?php } ?>
            </table>
            <hr/>

            <?php
            if ($pages >= 1 && $page <= $pages)
            {
                if ($page > 1)
                {
                    $prev = $page - 1;
                    echo "<a href='?page=logs&selected=voteshop&log_page=". $prev ."' title='Previous'>Previous</a> &nbsp;";
                }
                for ($x = 1; $x <= $pages; $x++)
                {
                    if ($page == $x)
                    {
                        echo "<a href='?page=logs&selected=voteshop&log_page=". $x ."' title='Page ". $x ."'><b>". $x ."</b></a>";
                    }
                    else
                    {
                        echo "<a href='?page=logs&selected=voteshop&log_page=". $x ."' title='Page ". $x ."'>". $x ."</a> ";
                    }
                }

                if ($page < $x - 1)
                {
                    $next = $page + 1;
                    echo "&nbsp; <a href='?page=logs&selected=voteshop&log_page=". $next ."' title='Next'>Next</a> &nbsp; &nbsp;";
                }
            }
            ?>
        </div>
    <?php }