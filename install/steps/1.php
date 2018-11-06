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

<p id="steps">Introduction &raquo; <b>MySQL Info</b> &raquo; Configure &raquo; Database &raquo; Realm Info &raquo; Finished<p>
<hr/>
<h3>Select the Checkbox if your auth and/or world server database is not in the same database as your website.<br>
Default means that you can leave the field blank and it will be given the value infront of the word "Default", E.g: "Default: root".</h3>
<hr/>
  <table cellpadding="15" cellspacing="5">
    <tr>

      <td><input type="checkbox"disabled checked></td>

      <th>
        Website Host:<br>
        <input type="text" placeholder="Default: 127.0.0.1" id="website_host">
      </th>        

      <th>
        Website Port:<br>
        <input type="text" placeholder="Default: 3306" id="website_port">
      </th>

      <th>
        Website User:<br>
        <input type="text" placeholder="Default: root" id="website_user">
      </th>

      <th>
        Website Password:<br>
        <input type="password" placeholder="Default: `blank`" id="website_password">
      </th>

    </tr>


    <tr>
      
      <td><input id="checkbox_logon" type="checkbox"></td>

      <th>
        Logon Host:<br>
        <input type="text" placeholder="Default: 127.0.0.1" id="logon_host" disabled>
      </th>

      <th>
        Logon Port:<br>
        <input type="text" placeholder="Default: 3306" id="logon_port" disabled>
      </th>

      <th>
        Logon User:<br>
        <input type="text" placeholder="Default: root" id="logon_user" disabled>
      </th>

      <th>
        Logon Password:<br>
        <input type="password" id="logon_password" placeholder="Default: `blank`" id="logon_password" disabled>
      </th>

    </tr>

    <tr>
      
      <td><input id="checkbox_characters" type="checkbox"></td>

      <th>
        Characters Host:<br>
        <input type="text"  placeholder="Default: 127.0.0.1" id="characters_host" disabled>
      </th>

      <th>
        Characters Port:<br>
        <input type="text"  placeholder="Default: 3306" id="characters_port" disabled>
      </th>

      <th>
        Characters User:<br>
        <input type="text"  placeholder="Default: root" id="characters_user" disabled>
      </th>

      <th>
        Characters Password:<br>
        <input type="password" placeholder="Default: `blank`" id="characters_password" disabled>
      </th>

    </tr>

    <tr>
      
      <td><input id="checkbox_world" type="checkbox"></td>

      <th>
        World Host:<br>
        <input type="text"  placeholder="Default: 127.0.0.1" id="world_host" disabled>
      </th>

      <th>
        World Port:<br>
        <input type="text"  placeholder="Default: 3306" id="world_port" disabled>
      </th>

      <th>
        World User:<br>
        <input type="text"  placeholder="Default: root" id="world_user" disabled>
      </th>

      <th>
        World Password:<br>
        <input type="password" placeholder="Default: `blank`" id="world_password" disabled>
      </th>

    </tr>


    <tr><td colspan="8"> <hr> </td></tr>
    <tr>
      <th></th>

      <th>
        Realmlist:<br>
        <input type="text" placeholder="Default: logon.yourserver.com" id="realmlist" required>
      </th>

      <th>
        Website Domain:<br>
        <input type="text" placeholder="Default: http://yourserver.com" id="domain" required>
      </th>

      <th>
        Website Title:<br>
        <input type="text" placeholder="Default: YourServer" id="title" required>
      </th>

      <th>Core Expansion:<br>
        <select id="expansion">
          <option value="0">Vanilla (No expansion)</option>
          <option value="1">The Burning Crusade</option>
          <option value="2" selected>Wrath of the Lich King (TrinityCore)</option>
          <option value="3">Cataclysm (SkyfireEMU)</option>
          <option value="4">Mists of Pandaria</option>
          <option value="5">Legion</option>
        </select>
      </th>
    </tr>

    <tr>
      <th></th>
      
      <th>
        Website Database:<br>
        <input type="text" placeholder="Default: craftedcms" id="website_database" required>
      </th>

      <th>
        Logon Database:<br>
        <input type="text" placeholder="Default: auth" id="logon_database" required>
      </th>

      <th>
        Characters Database:<br>
        <input type="text" placeholder="Default: characters" id="characters_database" required>
      </th>

      <th>
        World Database:<br>
        <input type="text" placeholder="Default: world" id="world_database" required>
      </th>

    </tr>

    <tr>
      <td></td>

      <th>
        PayPal Email:<br>
        <input type="email" placeholder="Default: youremail@gmail.com" id="paypal" required>
      </th>

      <th>
        Default Email:<br>
        <input type="email" placeholder="Default: noreply@yourserver.com" id="email" required>
      </th>

    </tr>

    <tr>
      <td colspan="8"><hr /></td>
    </tr>

    <tr>
      <td colspan="8">
        <input type="submit" value="Procceed to Step 2" onclick="step1()">
      </td>
    </tr>
    
  </table>