<?php

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();
    
    $tags = $connected->query("SELECT COUNT(keyword) AS theCount, keyword FROM hashtags GROUP BY keyword ORDER BY theCount DESC");

    echo "<div id=\"content\">";
    echo "<div id=\"leftcontent\">";
    echo "<div id=\"tags\">";
    while ($row = $tags->fetch_assoc()){
        echo "<form action=\"includes/formroute.php\" method=\"POST\">";
        echo "<p><button name=\"hashtaga\" class=\"hashtagb\" value=\"".$row['keyword']."\">".$row['keyword']."</button></p>";
        echo "</form>";  
    }
    echo "</div>";
    echo "</div>";
    echo "<div id=\"righcontent\">";
    


    if(isset($_SESSION['keyword'])){
        $tweetid = $connected->query("SELECT * FROM hashtags WHERE keyword='".$_SESSION['keyword']."'");
        unset($_SESSION['keyword']);
        while($col = $tweetid->fetch_assoc()){
            $tweet = $connected->query("SELECT * FROM tweets WHERE id='".$col['tweet_id']."'"); 
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
                echo "</div>";
            }
        }
    }
    echo "</div>";
    echo "</div>";

?>