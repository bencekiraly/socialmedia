<?php


    echo "<div id=\"content\">";

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();

    $userdata = $connected->query("SELECT * FROM users WHERE email ='".$_SESSION['loginmail']."'")->fetch_assoc();


    echo "<p>Összes belépés száma: ".$userdata['logincount']."</p>";
    echo "<p>Utolsó belépés dátuma: ".$userdata['date']."</p>";
    echo "<p>Összes általad küldött tweet száma: ".$connected->query("SELECT * FROM tweets WHERE user_id = (SELECT id FROM users WHERE email ='".$_SESSION['loginmail']."')")->num_rows."</p>";
    echo "<p>Összes jelöléseid száma: ".$connected->query("SELECT * FROM mentions WHERE user_id='".$_SESSION['userid']."'")->num_rows."</p>";

    echo "</div>";
?>