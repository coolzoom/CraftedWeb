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

    $GamePage->validatePageAccess('Interface');

    if ($GamePage->validateSubPage() == TRUE)
    {
        $GamePage->outputSubPage();
    }
    else
    {
        ?>
        <div class="box_right_title">Template</div>          

        Here You Can Choose Which Template That Should Be Active On Your Website. This Is Also Where You Install New Themes For Your Website.<br/><br/>

        <h3>Choose Template</h3>
        <select id="choose_template">
            <?php
            $result = $conn->query("SELECT * FROM template ORDER BY id ASC;");
            while ($row = $result->fetch_assoc())
            {
                if ($row['applied'] == 1)
                {
                    echo "<option selected='selected' value='". $row['id'] ."'>[Active] ";
                }
                else
                {
                    echo "<option value='". $row['id'] ."'>";
                }

                echo $row['name'] ."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Save" onclick="setTemplate()"/><hr/><p/>

        <h3>Install a new template</h3>
        <a href="#" onclick="templateInstallGuide()">How To Install New Templates On Your Website</a><br/><br/><br/>
        Path to the template<br/>
        <input type="text" id="installtemplate_path"/><br/>
        Choose A Name<br/>
        <input type="text" id="installtemplate_name"/><br/>
        <input type="submit" value="Install" onclick="installTemplate()"/>
        <hr/>
        <p/>

        <h3>Uninstall a template</h3>
        <select id="uninstall_template_id">
            <?php
            $result = $conn->query("SELECT * FROM template ORDER BY id ASC;");
            while ($row = $result->fetch_assoc())
            {
                if ($row['applied'] == 1)
                {
                    echo "<option selected='selected' value='". $row['id'] ."'>[Active] ";
                }
                else
                {
                    echo "<option value='". $row['id'] ."'>";
                }

                echo $row['name'] ."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Uninstall" onclick="uninstallTemplate()"/> 
    <?php }