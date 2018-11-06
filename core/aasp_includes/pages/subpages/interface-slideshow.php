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
  $conn = $GameServer->connect();
  $GameServer->selectDB("webdb", $conn);
?>
<div class="box_right_title"><?php echo $GamePage->titleLink(); ?> &raquo; Slideshow</div>
<?php
    $status = 'Disabled';
    if ($GLOBALS['enableSlideShow']) $status = 'Enabled';

    $count = $conn->query("SELECT COUNT(*) AS sliderImages FROM slider_images;");
?>
The Slideshow Is <b><?php echo $status; ?></b>. You Have <b><?php echo round($count->fetch_assoc()['sliderImages']); ?></b> Images In The Slideshow.
<hr/>
<?php
    if (isset($_POST['addSlideImage']))
    {
      $GamePage->addSlideImage($_FILES['slideImage_upload'], $_POST['slideImage_path'], $_POST['slideImage_url']);
    }
?>
<a href="#addimage" onclick="addSlideImage()" class="content_hider">Add Image</a>
<div class="hidden_content" id="addSlideImage">
    <form action="" method="post" enctype="multipart/form-data">

        Upload An Image:<br/>
        <input type="file" name="slideImage_upload"><br/>

        Or Enter Image URL: (This Will Override Your Uploaded Image)<br/>
        <input type="text" name="slideImage_path"><br/>

        Where Should The Image Redirect? (Leave Empty If No Redirect)<br/>
        <input type="text" name="slideImage_url"><br/>

        <input type="submit" value="Add" name="addSlideImage">
    </form>
</div>
<br/>&nbsp;<br/>
<?php
    $result = $conn->query("SELECT * FROM slider_images ORDER BY position ASC;");
    if ($result->num_rows == 0)
    {
        echo "You don't have any images in the slideshow!";
    }
    else
    {
        echo "<table>";
        $c   = 1;
        while ($row = $result->fetch_assoc())
        {
            echo "<tr class='center'>";
            echo "<td><h2>&nbsp; ". $c ." &nbsp;</h2><br/><a href='#remove' onclick='removeSlideImage(". $row['position'] .")'>Remove</a></td>";
            echo "<td><img src='../core/". $row['path'] ."' alt='". $c ."' class='slide_image' maxheight='200'/></td>";
            echo "</tr>";
            $c++;
        }
        echo "</table>";
    }