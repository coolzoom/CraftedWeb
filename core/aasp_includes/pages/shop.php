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

    $GamePage->validatePageAccess("Shop");

    if ($GamePage->validateSubPage() == TRUE)
    {
        $GamePage->outputSubPage();
    }
    else
    {   
        $conn = $GameServer->connect();
        $GameServer->selectDB("webdb", $conn);
        $inShop     = $conn->query("SELECT COUNT(id) AS items FROM shopitems;");
        $purchToday = $conn->query("SELECT COUNT(id) AS purchases FROM shoplog WHERE date LIKE '%". date('Y-m-d') ."%';");
        $getAvg     = $conn->query("SELECT AVG(price) AS priceAvg FROM shopitems;");
        $totalPurch = $conn->query("SELECT COUNT(id) AS purchasesTotal FROM shoplog;");



        //Note: The round() function will return 0 if no value is set :)
        ?>
        <div class="box_right_title">Shop Overview</div>
        <table style="width: 100%;">
            <tr>
                <td><span class='blue_text'>Items In Shop</span></td>
                <td><?php echo round($inShop->fetch_assoc()['items']); ?></td>

                <td><span class='blue_text'>Average Item Cost</span></td>
                <td><?php echo round($getAvg->fetch_assoc()['priceAvg']); ?> Vote Points</td>
            </tr>
            <tr>
                <td><span class='blue_text'>Purchases Today</span></td>
                <td><?php echo round($purchToday->fetch_assoc()['purchases']); ?></td>
                <td><span class='blue_text'>Total Purchases</span></td>
                <td><?php echo round($totalPurch->fetch_assoc()['purchasesTotal']); ?></td>
            </tr>
        </table>
        <hr/>
        <a href="?page=shop&selected=add" class="content_hider">Add Items</a>
        <a href="?page=shop&selected=manage" class="content_hider">Manage Items</a>
        <a href="?page=shop&selected=tools" class="content_hider">Tools</a>
    <?php }