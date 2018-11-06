<?php

#   ___           __ _           _ __    __     _     
#  / __\ __ __ _ / _| |_ ___  __| / / /\ \ \___| |__  
# / / | '__/ _` | |_| __/ _ \/ _` \ \/  \/ / _ \ '_ \ 
#/ /__| | | (_| |  _| ||  __/ (_| |\  /\  /  __/ |_) |
#\____/_|  \__,_|_|  \__\___|\__,_| \/  \/ \___|_.__/ 
#
#		-[ Created by �Nomsoft
#		  `-[ Original core by Anthony (Aka. CraftedDev)
#
#				-CraftedWeb Generation II-                  
#			 __                           __ _   							   
#		  /\ \ \___  _ __ ___  ___  ___  / _| |_ 							   
#		 /  \/ / _ \| '_ ` _ \/ __|/ _ \| |_| __|							   
#		/ /\  / (_) | | | | | \__ \ (_) |  _| |_ 							   
#		\_\ \/ \___/|_| |_| |_|___/\___/|_|  \__|	- www.Nomsoftware.com -	   
#                  The policy of Nomsoftware states: Releasing our software   
#                  or any other files are protected. You cannot re-release    
#                  anywhere unless you were given permission.                 
#                  � Nomsoftware 'Nomsoft' 2011-2012. All rights reserved.    

class Connect
{

    public static $connectedTo = "global";

    public static function connectToDB()
    {
        if ($conn = new mysqli(
            $GLOBALS['connection']['web']['host'], 
            $GLOBALS['connection']['web']['user'], 
            $GLOBALS['connection']['web']['password']))
        {
            $conn->set_charset("UTF8");
            return $conn;
        }
        else
        {
            buildError("<b>Database Connection error:</b> A connection could not be established. Error: " . $conn->error, NULL);
            self::$connectedTo = null;
        }
    }

    public static function connectToRealmDB($realmid)
    {
        $conn = self::connectToDB();
        self::selectDB("webdb", $conn);

        if ($GLOBALS['realms'][$realmid]['mysqli_host'] != $GLOBALS['connection']['host'] || 
            $GLOBALS['realms'][$realmid]['mysqli_user'] != $GLOBALS['connection']['user'] || 
            $GLOBALS['realms'][$realmid]['mysqli_pass'] != $GLOBALS['connection']['password'])
        {
            $conn->set_charset("UTF8");
            return new mysqli($GLOBALS['realms'][$realmid]['mysqli_host'], $GLOBALS['realms'][$realmid]['mysqli_user'], $GLOBALS['realms'][$realmid]['mysqli_pass'])
            or buildError("<b>Database Connection error:</b> A connection could not be established to Realm. Error: " . $conn->error, NULL);
        }
        else
        {
            self::connectToDB();
        }
        $conn->select_db($GLOBALS['realms'][$realmid]['chardb']) or buildError("<b>Database Selection error:</b> The realm database could not be selected. Error: " . $conn->error, NULL);
        self::$connectedTo = 'chardb';
    }

    public static function selectDB($db, $conn, $realmid = 1)
    {
        switch ($db)
        {
            default:
                $conn->select_db($db);
                break;

            case "logondb": 
                $conn->select_db($GLOBALS['connection']['logon']['database']);
                break;

            case "webdb":
                $conn->select_db($GLOBALS['connection']['web']['database']);
                break;

            case "worlddb":
                $conn->select_db($GLOBALS['connection']['world']['database']);
                break;

            case "chardb":
                $conn->select_db($GLOBALS['realms'][$realmid]['chardb']);
                break;
        }
        return TRUE;
    }

}

$Connect = new Connect();
$conn    = $Connect->connectToDB();


/*     * ********************** */
/* Realms & service prices automatic settings
  /* (Indented on purpose)
  /************************ */
$realms  = array();
$service = array();

$Connect->selectDB("webdb", $conn);

//Realms
$getRealms = $conn->query("SELECT * FROM realms ORDER BY id ASC;");
while ($row = $getRealms->fetch_assoc())
{
    $realms[$row['id']]['id']           = $row['id'];
    $realms[$row['id']]['name']         = $row['name'];
    $realms[$row['id']]['chardb']       = $row['char_db'];
    $realms[$row['id']]['description']  = $row['description'];
    $realms[$row['id']]['port']         = $row['port'];

    $realms[$row['id']]['rank_user']    = $row['rank_user'];
    $realms[$row['id']]['rank_pass']    = $row['rank_pass'];
    $realms[$row['id']]['ra_port']      = $row['ra_port'];
    $realms[$row['id']]['soap_port']    = $row['soap_port'];

    $realms[$row['id']]['host']         = $row['host'];

    $realms[$row['id']]['sendType']     = $row['sendType'];

    $realms[$row['id']]['mysqli_host']  = $row['mysqli_host'];
    $realms[$row['id']]['mysqli_user']  = $row['mysqli_user'];
    $realms[$row['id']]['mysqli_pass']  = $row['mysqli_pass'];
}

//Service prices
$getServices = $conn->query("SELECT enabled, price, currency, service FROM service_prices;");
while ($row = $getServices->fetch_assoc())
{
    $service[$row['service']]['status']   = $row['enabled'];
    $service[$row['service']]['price']    = $row['price'];
    $service[$row['service']]['currency'] = $row['currency'];
}


## Unset Magic Quotes
if (get_magic_quotes_gpc())
{
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process))
    {
        if (is_array($val) || is_object($val))
        {
            foreach ($val as $k => $v)
            {
                unset($process[$key][$k]);
                if (is_array($v))
                {
                    $process[$key][stripslashes($k)] = $v;
                    $process[]                       = &$process[$key][stripslashes($k)];
                }
                else
                {
                    $process[$key][stripslashes($k)] = stripslashes($v);
                }
            }
        }
    }
    unset($process);
}