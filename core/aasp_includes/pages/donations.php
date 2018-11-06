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

    global $GameServer, $GamePage, $GameAccount;
    $conn = $GameServer->connect();
    $GameServer->selectDB("webdb", $conn);

    $GamePage->validatePageAccess("Donations");

    if ($GamePage->validateSubPage() == TRUE)
    {
        $GamePage->outputSubPage();
    }
    else
    {
        $donationsTotal       = $conn->query("SELECT mc_gross FROM payments_log;");
        $donationsTotalAmount = 0;
        while ($row                  = $donationsTotal->fetch_assoc())
        {
            $donationsTotalAmount = $donationsTotalAmount + $row['mc_gross'];
        }

        $donationsThisMonth       = $conn->query("SELECT mc_gross FROM payments_log WHERE paymentdate LIKE '%". date('Y-md') ."%';");
        $donationsThisMonthAmount = 0;
        while ($row = $donationsThisMonth->fetch_assoc())
        {
          $donationsThisMonthAmount = $donationsThisMonthAmount + $row['mc_gross'];
        }

        $q                    = $conn->query("SELECT mc_gross, userid FROM payments_log ORDER BY paymentdate DESC LIMIT 1;");
        $row                  = $q->fetch_assoc();
        $donationLatestAmount = $row['mc_gross'];

        $donationLatest = $GameAccount->getAccName($row['userid']);
        ?>
        <div class="box_right_title">Donations Overview</div>
        <table style="width: 100%;">
            <tr>
                <td><span class='blue_text'>Total Number Of Donations</span></td>
                <td><?php echo $donationsTotal->num_rows; ?></td>
                
                <td><span class='blue_text'>Total Amount Of Donations</span></td>
                <td><?php echo round($donationsTotalAmount, 0); ?>$</td>
            </tr>
            <tr>
                <td><span class='blue_text'>Number Of Donations This Month</span></td>
                <td><?php echo $donationsThisMonth->num_rows; ?></td>
                
                <td><span class='blue_text'>Amount Of Donations This Month</span></td>
                <td><?php echo round($donationsThisMonthAmount, 0); ?>$</td>
            </tr>
            <tr>
                <td><span class='blue_text'>Latest Donation Amount</span></td>
                <td><?php echo round($donationLatestAmount);  ?>$</td>
                
                <td><span class='blue_text'>Latest Donator</span></td>
                <td><?php echo $donationLatest; ?></td>
            </tr>
        </table>
        <hr/>
        <a href="?page=donations&selected=browse" class="content_hider">Browse Donations</a>
    <?php }