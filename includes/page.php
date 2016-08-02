<?php

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();
    
    $user = $connected->query("SELECT * FROM users WHERE id='".$_SESSION['usercheck']."'")->fetch_assoc();
    $pic = $connected->query("SELECT * FROM profile_pics WHERE user_id='".$_SESSION['usercheck']."'")->fetch_assoc();
    
    echo "<div id=\"content\">";
    echo "<div id=\"leftcontent\">";
    echo "<div id=\"profile\">";
    echo "<p id=\"pageimg\"><img src=\"upload/profilepic/".$pic['path']."\" id=\"profilepicpage\" alt=\"profilepicpage\"/></p>";
    echo "<p id=\"pagename\">".$user['name']."</p>";
    echo "<p id=\"pagemail\">".$user['email']."</p>";
    echo "</div>";
    echo "</div>";
    echo "<div id=\"righcontent\">";
    
    $tweet = $connected->query("SELECT * FROM tweets WHERE user_id='".$user['id']."' ORDER BY id DESC");

    while ($row = $tweet->fetch_assoc()){
        $name = $connected->query("SELECT name FROM users WHERE id='".$row['user_id']."'")->fetch_assoc();
        echo "<div class=\"tweetbox\">";
        echo "<p class=\"tweetusername\">".$name['name']."</p>";
        echo "<p class=\"tweetdate\">".$row['date']."</p>";
        echo "<p class=\"tweettext\">Szöveg: ".$row['text']."</p>";
        if(1 == $connected->query("SELECT * FROM hashtags WHERE tweet_id='".$row['id']."'")->num_rows){
            $hashtag = $connected->query("SELECT keyword FROM hashtags WHERE tweet_id='".$row['id']."'")->fetch_assoc();
            echo "<p class=\"tweethashtag\">Hashtag: ".$hashtag['keyword']."</p>";
        }
        if(1 == $connected->query("SELECT * FROM mentions WHERE tweet_id='".$row['id']."'")->num_rows){
            $cimzett = $connected->query("SELECT user_id FROM mentions WHERE tweet_id='".$row['id']."'")->fetch_assoc();
            $cimzettnev = $connected->query("SELECT name FROM users WHERE id='".$cimzett['user_id']."'")->fetch_assoc();
            echo "<p class=\"tweetcimzett\">Címzett: ".$cimzettnev['name']."</p>";    
        }
        if(1 == $connected->query("SELECT * FROM shared_pics WHERE tweet_id='".$row['id']."'")->num_rows){
            $image = $connected->query("SELECT path FROM shared_pics WHERE tweet_id='".$row['id']."'")->fetch_assoc();
            echo "<p><img src=\"upload/images/".$image['path']."\" class=\"tweetpicture\" alt=\"tweetpic\"/></p>";        
        }
        echo "<p class=\"howlike\">Ennyien kedvelték: ".$connected->query("SELECT * FROM likes WHERE tweet_id='".$row['id']."'")->num_rows."</p>";
        if(1 == $connected->query("SELECT * FROM likes WHERE user_id='".$_SESSION['userid']."' AND tweet_id='".$row['id']."'")->num_rows){
            echo "<form action=\"includes/formroute.php\" method=\"POST\">";
            echo "<button name=\"likedtweet\" class=\"likedtweet\" value=\"0\">Kedveltem!</button>";
            echo "<input type=\"hidden\" name=\"tweetid\" value=\"".$row['id']."\">";
            echo "<input type=\"hidden\" name=\"userid\" value=\"".$row['user_id']."\">";
            echo "</form>";
        }else{
            echo "<form action=\"includes/formroute.php\" method=\"POST\">";
            echo "<button name=\"likedtweet\" class=\"liketweet\" value=\"1\">Kedvelem!</button>";
            echo "<input type=\"hidden\" name=\"tweetid\" value=\"".$row['id']."\">";
            echo "<input type=\"hidden\" name=\"userid\" value=\"".$row['user_id']."\">";
            echo "</form>";  
        }
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";

?>