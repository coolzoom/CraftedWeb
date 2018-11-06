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

    require "core/includes/classes/template_parse.php";

    global $Connect, $Plugins;
    $conn = $Connect->connectToDB();
    $Connect->selectDB("webdb", $conn);

    if ($getTemplate = $conn->query("SELECT `path` FROM template WHERE applied='1';"))
    {

      $template = $getTemplate->fetch_assoc();

      if (!file_exists("core/styles/". $template['path'] ."/style.css") || !file_exists("core/styles/" . $template['path'] . "/template.html"))
      {
        buildError("<b>Template Error: </b>The active template does not exist or missing files. (". $template['path'].")", NULL);
        exit_page();
      }
?>
<link rel="stylesheet" href="core/styles/<?php echo $template['path']; ?>/style.css" />
<link rel="stylesheet" href="core/styles/global/style.css" />
<?php
    $Plugins->load('styles');
  }
  else
  {
    buildError("<b>Error getting the template's path, see logs for more info.</b>", NULL, $conn->error);
  }
?>