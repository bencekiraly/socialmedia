<?php

    echo "<div id=\"content\">";

    require "config/db.php";
    $connect = new Connect();
    $connected = $connect->getDb();

    $userdata = $connected->query("SELECT * FROM users WHERE email ='".$_SESSION['loginmail']."'")->fetch_assoc();

    echo "<div id=\"useredit\">";
        
    echo "<form id=\"editform\" action=\"includes/formroute.php\" method=\"POST\" enctype=\"multipart/form-data\">";
    echo "<label for=\"editname\">Név</label>";
    echo "<input type=\"text\" name=\"editname\" id=\"editname\" value=\"".$userdata['name']."\" required>";
    echo "<label for=\"editmail\">Email cím</label>";
    echo "<input type=\"email\" name=\"editmail\" id=\"editmail\" value=\"".$userdata['email']."\"  required>";
    echo "<label for=\"editoldpw\">Régi jelszó</label>";
    echo "<input type=\"password\" name=\"editoldpw\" id=\"editoldpw\">";
    echo "<label for=\"editpw1\">Új jelszó</label>";
    echo "<input type=\"password\" name=\"editpw1\" id=\"editpw1\">";
    echo "<label for=\"editpw2\">Új jelszó újra</label>";
    echo "<input type=\"password\" name=\"editpw2\" id=\"editpw2\">";
    echo "<label for=\"image\">Profilkép</label>";
    echo "<input type=\"file\" name=\"image\" id=\"image\">";
    echo "<input type=\"hidden\" name=\"edit\" id=\"edit\" value=\"1\">";
    echo "<input type=\"submit\" value=\"Módosítás\">";
    echo "</form>";
    echo "</div>";
    echo "<p id=\"warning\">Ha nem akarsz módosítani, csak hagyd úgy a beviteli mezőket, ahogy vannak.</p>";
    echo "</div>";
    
?>