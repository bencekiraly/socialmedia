<?php

    

    echo "<div id=\"reg\">";
    echo "<form id=\"regform\" action=\"includes/formroute.php\" method=\"POST\">";
    echo "<label for=\"regname\">Név</label>";
    echo "<input type=\"text\" name=\"regname\" id=\"regname\" required>";
    echo "<label for=\"regmail\">Email cím</label>";
    echo "<input type=\"email\" name=\"regmail\" id=\"regmail\" required>";
    echo "<label for=\"regpw1\">Jelszó</label>";
    echo "<input type=\"password\" name=\"regpw1\" id=\"regpw1\" required>";
    echo "<label for=\"regpw2\">Jelszó újra</label>";
    echo "<input type=\"password\" name=\"regpw2\" id=\"regpw2\" required>";
    echo "<input type=\"hidden\" name=\"reg\" value=\"1\">";
    echo "<input type=\"submit\" value=\"Regisztráció\">";
    echo "</form>";
    echo "</div>";

?>