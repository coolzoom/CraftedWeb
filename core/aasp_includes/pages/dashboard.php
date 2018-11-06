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

  function setError($haystack)
  {
    return strpos($haystack, "Error") !== false;
  }


    global $GameServer, $GameAccount;
    $conn = $GameServer->connect();
?>
<div class="box_right_title">Dashboard</div>
<table style="width: 605px;">
    <tr>
        <td><span class='blue_text'>Active Connections</span></td>
        <td><?php echo $GameServer->getActiveConnections(); ?></td>
        
        <td><span class='blue_text'>Active Accounts(This Month)</span></td>
        <td><?php echo $GameServer->getActiveAccounts(); ?></td>
    </tr>
    <tr>
        <td><span class='blue_text'>Accounts Logged In Today</span></td>
        <td><?php echo $GameServer->getAccountsLoggedToday(); ?></td>

        <td><span class='blue_text'>Accounts Vreated Today</span></td>
        <td><?php echo $GameServer->getAccountsCreatedToday(); ?></td>
    </tr>
</table>
</div>

<?php
    $GameServer->checkForNotifications();
?>

<div class="box_right">
    <div class="box_right_title">Admin Panel Log</div>
    <?php
        $GameServer->selectDB("webdb", $conn);
        $result = $conn->query("SELECT * FROM admin_log ORDER BY id DESC LIMIT 25;");
        if ($result->num_rows == 0)
        {
            echo "The admin log is empty!";
        }
        else
        {
            ?>
            <table class="center">
                <tr>
                    <th>Date</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc())
                { ?>
                    <tr>
                        <td><?php echo date("Y-m-d H:i:s", $row['timestamp']); ?></td>
                        <td><?php echo $GameAccount->getAccName($row['account']); ?></td>
                        <td><?php echo $row['action']; ?></td>
                    </tr>
          <?php } ?>
            </table><br/>
            <a href="?page=logs&selected=admin" title="Get more logs">Older Logs...</a>
    <?php } ?>
</div>
