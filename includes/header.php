<?php

    if(empty($_SESSION['login'])){
        echo "<div id=\"menu\">";
        echo "<ul id=\"mainmenu\">";
        echo "<li><a href=\"index.php?callback=10\"><img src=\"assets/images/logo.png\" id=\"tesztlogo\" alt=\"logo\"/></a></li>";
        echo "<li><a href=\"index.php?callback=10\" ";if($_SESSION['callback'] == 10){echo "id=\"activelink\"";} echo">Bejelentkezés</a></li>";
        echo "<li><a href=\"index.php?callback=11\" ";if($_SESSION['callback'] == 11){echo "id=\"activelink\"";} echo">Regisztráció</a></li>";
        echo "<li><a href=\"index.php?callback=26\" ";if($_SESSION['callback'] == 26){echo "id=\"activelink\"";} echo">#tag-ek</a></li>";
        echo "</ul>";
        echo "</div>";
    }else{
        echo "<div id=\"menu\">";
        echo "<ul id=\"mainmenu\">";
        echo "<li><a href=\"index.php?callback=20\"><img src=\"assets/images/logo.png\" id=\"tesztlogo\" alt=\"logo\"/></a></li>";
        echo "<li><a href=\"index.php?callback=20\" ";if($_SESSION['callback'] == 20){echo "id=\"activelink\"";} echo">Saját oldal</a></li>";
        echo "<li><a href=\"index.php?callback=21\" ";if($_SESSION['callback'] == 21){echo "id=\"activelink\"";} echo">Felhasználó statisztika</a></li>";
        echo "<li><a href=\"index.php?callback=25\" ";if($_SESSION['callback'] == 25){echo "id=\"activelink\"";} echo">#tag-ek</a></li>";
        echo "</ul>";
        echo "<ul id=\"usermenu\">";
        echo "<li><img src=\"upload/profilepic/".$_SESSION['profilepic']."\" id=\"profilepic\" alt=\"profilepic\"/></li>";
        echo "<li><p id=\"echoname\">".$_SESSION['nev']."</p></li>";
        echo "<li><a href=\"index.php?callback=22\" ";if($_SESSION['callback'] == 22){echo "id=\"activelink\"";} echo ">Profil szerkesztése</a></li>";
        echo "<li><a href=\"index.php?callback=23\" ";if($_SESSION['callback'] == 23){echo "id=\"activelink\"";} echo ">Új megosztás</a></li>";
        echo "<li><a href=\"index.php?logout=1\">Kijelentkezés</a></li>";
        echo "</ul>";
        echo "</div>";
    }

?>