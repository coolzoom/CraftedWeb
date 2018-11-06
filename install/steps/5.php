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
?>
<style type="text/css">
  
  #main_box
  {
    width: 1000px;
  }

</style>
<p id="steps"><b>Introduction</b> &raquo; MySQL Info &raquo; Configure &raquo; Database &raquo; <b>Realm Info</b> &raquo; Finished<p>

<hr>

<table cellpadding="10" cellspacing="5">
    <tr>
        <th>
          Realm Name:<br>
          <input type="text" placeholder="Default: Sample Realm" id="realm_name" required>
        </th>

        <th>
          Administrator Username:
          <input type="text" placeholder="Default: admin" id="realm_access_username" required>
        </th> 

        <th>
          Administrator Password:
          <input type="password" placeholder="Default: adminpass" id="realm_access_password" required>
        </th>
    </tr>

    <tr>
        <th>
          Description:
          <input type="text" placeholder="Default: Blizzlike 1x" id="realm_description" required>
        </th>

        <th>Remote Console:<br>
            <select id="realm_sendtype">
              <option value="none" selected></option>
              <option value="RA">RA</option>
              <option value="SOAP">SOAP</option>
            </select>
        </th>

        <th id="realm_ra">
          RA Port:
          <input type="text" placeholder="Default: 3443" id="realm_ra_port" required>
        </th>

        <th id="realm_soap">
          SOAP Port:
          <input type="text" placeholder="Default: 7878" id="realm_soap_port">
        </th>
    </tr>
    
    <tr>
        <th colspan="4"><input type="submit" value="Finished" onclick="step5()"></th>
    </tr>
</table>