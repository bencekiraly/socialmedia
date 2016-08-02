<?php

    echo "<div id=\"login\">";
    echo "<form id=\"loginform\" method=\"POST\" action=\"includes/formroute.php\">";
    echo "<label for=\"loginmail\">Email cím</label>";
    echo "<input type=\"text\" name=\"loginmail\" id=\"loginmail\">";
    echo "<label for=\"loginpw\">Jelszó</label>";
    echo "<input type=\"password\" name=\"loginpw\" id=\"loginpw\">";
    echo "<input type=\"submit\" value=\"Belépés\">";
    echo "</form>";
    echo "</div>";

?>