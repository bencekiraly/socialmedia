<?php

    echo "<div id=\"content\">";

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();

    $userdata = $connected->query("SELECT * FROM users WHERE email ='".$_SESSION['loginmail']."'")->fetch_assoc();
    $cimzett = $connected->query("SELECT * FROM users");

    echo "<div id=\"newtweet\">";
    echo "<form id=\"tweetform\" action=\"includes/formroute.php\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<label for=\"tweettext\">Tweet szövege</label>";
    echo "<textarea name=\"tweettext\" id=\"tweettext\" rows=\"7\" cols=\"26\" required>";
    echo "</textarea>";
    echo "<select name=\"cimzett\" >";
    echo "<option selected disabled>Címzett(ha van)</option>";
    while ($row = $cimzett->fetch_assoc()){
        if($row['name'] === $_SESSION['nev']){
            
        }else{
            echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
        }
    }
    echo "</select>";
    echo "<br/>";
    echo "<label for=\"hashtag\">Hashtag(ha van)</label>";
    echo "<input type=\"text\" name=\"hashtag\" id=\"hashtag\" value=\"\">";
    echo "<label for=\"image\">Kép hozzáadása</label>";
    echo "<input type=\"file\" name=\"image\" id=\"image\">";
    echo "<input type=\"hidden\" name=\"tweet\" id=\"tweet\" value=\"1\">";
    echo "<input type=\"submit\" value=\"Elküldés\">";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    
?>