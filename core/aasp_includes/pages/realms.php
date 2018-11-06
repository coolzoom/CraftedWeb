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


    global $GameServer, $GamePage;
    $conn = $GameServer->connect();
    $GameServer->selectDB("webdb", $conn);

    $GamePage->validatePageAccess('Realms');

    if ($GamePage->validateSubPage() == TRUE)
    {
        $GamePage->outputSubPage();
    }
    else
    {
        ?>
        <div class='box_right_title'>New Realm</div>
        <?php
        if (isset($_POST['add_realm']))
        {
            $GameServer->addRealm(
                $_POST['realm_name'], 
                $_POST['realm_desc'], 
                $_POST['realm_host'], 
                $_POST['realm_port'], 
                $_POST['realm_chardb'], 
                $_POST['realm_sendtype'], 
                $_POST['realm_rank_username'], 
                $_POST['realm_rank_password'], 
                $_POST['realm_ra_port'], 
                $_POST['realm_soap_port'], 
                $_POST['realm_a_host'], 
                $_POST['realm_a_user'], 
                $_POST['realm_a_pass']);
        }
        ?>

        <form action="?page=realms" method="post" style="line-height: 15px;">
            <b>General Realm Information</b><hr/>
            <!-- 
            Realm ID: <br/>
            <input type="text" name="realm_id" placeholder="Default: 1"/> <br/>
            <i class='blue_text'>This must be the same ID of the one you have specified in your realmlist table in Auth. 
                Otherwise the uptime won't work properly if you have more than 1 realm.</i><br/>
            -->
            Realm Name: <br/>
            <input type="text" name="realm_name" placeholder="Default: Sample Realm"/> <br/>
            (Optional) Realm Description: <br/>
            <input type="text" name="realm_desc" placeholder="Default: Blizzlike 3x"/> <br/>
            Realm Port: <br/>
            <input type="text" name="realm_port" placeholder="Default: 8085"/> <br/>
            Host: (IP or DNS) <br/>
            <input type="text" name="realm_host" placeholder="Default: 127.0.0.1"/> <br/>

            <br/>
            <b>Remote Console Information</b> <i>(Vote & Donation Shop)</i><hr/>
            Remote Console <i>(You Can Always Change This Later)</i>: <br/>
            <select name="realm_sendtype">
                <option value="ra">RA</option>
                <option value="soap">SOAP</option>
            </select><br/>
            <i class='blue_text'>Specify A Level 3 GM Account (Used For The Remote Console)<br/>
                Tip: Do Not Use Your Admin Account. Use A Level 3 Account.</i><br/>
            Username: <br/>
            <input type="text" name="realm_rank_username" placeholder="Default: rauser"/> <br/>
            Password: <br/>
            <input type="password" name="realm_rank_password" placeholder="Default: rapassword"/> <br/>
            RA Port: <i>(Can Be Ignored If You Have Chosen SOAP)</i> <br/>
            <input type="text" name="realm_ra_port" placeholder="Default: 3443"/> <br/>
            SOAP Port: <i>(Can Be Ignored If You Have Chosen RA)</i> <br/>
            <input type="text" name="realm_soap_port" placeholder="Default: 7878"/> <br/>
            <br/>
            <b>MySQL Information</b> <i>(If Left Blank, Settings Will Be Copied From Your Configuration File)</i><hr/>
            MySQL Host: <br/>
            <input type="text" name="realm_m_host" placeholder="Default: 127.0.0.1"/><br/>
            MySQL User: <br/>
            <input type="text" name="realm_m_user" placeholder="Default: root"/><br/>
            MySQL Password: <br/>
            <input type="text" name="realm_m_pass" placeholder="Default: ascent"/><br/>
            Character Database: <br/>
            <input type="text" name="realm_chardb" placeholder="Default: characters"/> <br/>
            <hr/>
            <input type="submit" value="Add" name="add_realm" />                     
        </form>
    <?php } ?>
