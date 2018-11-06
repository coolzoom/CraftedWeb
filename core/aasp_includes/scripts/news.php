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

define('INIT_SITE', TRUE);
include "../../includes/misc/headers.php";
include "../../includes/configuration.php";
include "../functions.php";
global $GameServer, $GameAccount;
$conn = $GameServer->connect();

$GameServer->selectDB("webdb", $conn);

  # Organized Alphabeticaly

  switch ($_POST['function']) 
  {
    case "delete":
    {
      if (empty($_POST['id']))
      {
        die('No ID Specified. Aborting...');
      }

      $conn->query("DELETE FROM news WHERE id=". $conn->escape_string($_POST['id']) .";");
      $conn->query("DELETE FROM news_comments WHERE id=". $conn->escape_string($_POST['id']) .";");
      $GameServer->logThis("Deleted A News Post");

      break;
    }

    case "edit":
    {
      $id      = $conn->escape_string($_POST['id']);
      $title   = $conn->escape_string(ucfirst($_POST['title']));
      $author  = $conn->escape_string(ucfirst($_POST['author']));
      $content = $conn->escape_string($_POST['content']);

      if (empty($id) || empty($title) || empty($content))
      {
          die("Please enter both fields.");
      }
      else
      {
          $conn->query("UPDATE news SET title='". $title ."', author='". $author ."', body='". $content ."' WHERE id=". $id .";");
          $GameServer->logThis("Updated news post with ID: <b>". $id ."</b>");
          return TRUE;
      }

      break;
    }

    case "getNewsContent":
    {
      $result  = $conn->query("SELECT * FROM news WHERE id=". $conn->escape_string($_POST['id']) .";");
      $row     = $result->fetch_assoc();
      $content = str_replace('<br />', "\n", $row['body']);

      echo "<h3>Edit News</h3><br/>Title: <br/><input type='text' id='editnews_title' value='". $row['title'] ."'><br/><br/>
            Content:<br/><textarea cols='55' rows='8' id='editnews_content'>". $content ."</textarea><br/>
            <br/><input type='submit' value='Save' onclick='editNewsNow(". $row['id'] .")'>";

      break;
    }

    case "post":
    {
      if (empty($_POST['title']) || empty($_SESSION['cw_user']) || empty($_POST['content']))
      {
        die('<span class="red_text">Please enter all fields.</span>');
      }
      
      $title    = $conn->escape_string($_POST['title']);
      $content  = $conn->escape_string($_POST['content']);
      $author   = $conn->escape_string($_SESSION['cw_user']);
      $img      = $conn->escape_string($_POST['image']);
      $date     = date("Y-m-d H:i:s");

      $result = $conn->query("INSERT INTO news (`title`, `body`, `author`, `image`, `date`) VALUES 
        ('". $title ."','". $content ."', '". $author ."','". $img ."', '". $date ."');");
      if ($result) 
      {
        $GameServer->logThis("Posted a news post");
        echo "Successfully posted news.";
      }
      else
      {
        die("Error - ". $conn->error);
      }

      break;
    }

  }
