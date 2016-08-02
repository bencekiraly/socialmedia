<?php

    echo "<div id=\"content\">";

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();

    echo "<p>Összes felhasználó száma: ".$connected->query("SELECT * FROM users")->num_rows."</p>";
    echo "<p>Összes tweet száma: ".$connected->query("SELECT * FROM tweets")->num_rows."</p>";
    echo "<p>Összes hashtag száma: ".$connected->query("SELECT * FROM hashtags GROUP BY keyword")->num_rows."</p>";
    echo "<p>Összes like száma: ".$connected->query("SELECT * FROM likes")->num_rows."</p>";

    echo "</div>";
?>