<?php


    if(isset($_SESSION['callback'])){
        $callback = $_SESSION['callback'];
        switch ($callback){
            case 0: echo "<p id=\"success\">Sikeres telepítés!</p>"; break;
            case 1: echo "<p id=\"error\">Sikertelen telepítés!</p>"; break;
            case 10: include "includes/login.php"; break;
            case 11: include "includes/registration.php"; break;
            case 12: include "includes/stats.php"; break;
            case 20: include "includes/user/page.php"; break;
            case 21: include "includes/user/stats.php"; break;
            case 22: include "includes/user/edit.php"; break;
            case 23: include "includes/user/tweet.php"; break;
            case 24: include "includes/page.php"; break;
            case 25: include "includes/user/tags.php"; break;
            case 26: include "includes/tags.php"; break;
            case 101: echo "<p id=\"error\">Rossz email!</p>"; include "includes/login.php"; break;
            case 102: echo "<p id=\"error\">Rossz jelszó!</p>"; include "includes/login.php"; break;
            case 200: echo "<p id=\"success\">Sikeres regisztráció, mostmár beléphetsz!</p>"; include "includes/login.php"; break;
            case 201: echo "<p id=\"error\">Nem egyezik meg a két jelszó!</p>"; include "includes/registration.php"; break;
            case 202: echo "<p id=\"error\">Nem töltötted ki az email címet!</p>"; include "includes/registration.php"; break;
            case 203: echo "<p id=\"error\">Nem töltötted ki a név mezőt!</p>"; include "includes/registration.php"; break;
            case 204: echo "<p id=\"error\">Nem adtad meg a jelszót!</p>"; include "includes/registration.php"; break;
            case 205: echo "<p id=\"error\">Nem ismételted meg a jelszót!</p>"; include "includes/registration.php"; break;
            case 206: echo "<p id=\"error\">Nem érvényes email cím!</p>"; include "includes/registration.php"; break;
            case 207: echo "<p id=\"error\">Ezzel az email címmel már regisztráltak!</p>"; include "includes/registration.php"; break;
            case 300: echo "<p id=\"success\">Sikeres módosítás!</p>"; include "includes/user/edit.php"; break;
            case 301: echo "<p id=\"error\">Nem megfelelő az email cím!</p>"; include "includes/user/edit.php"; break;
            case 302: echo "<p id=\"error\">Ez az email cím már használatban van!</p>"; include "includes/user/edit.php"; break;
            case 303: echo "<p id=\"error\">Nem megfelelő a régi jelszó!</p>"; include "includes/user/edit.php"; break;
            case 304: echo "<p id=\"error\">Nem egyeznek az új jelszavak!</p>"; include "includes/user/edit.php"; break;
            case 305: echo "<p id=\"error\">Üres az új jelszó mező!</p>"; include "includes/user/edit.php"; break;
            case 400: echo "<p id=\"success\">Sikeres tweet!</p>"; include "includes/user/tweet.php"; break;
        }
        unset($callback);
        unset($_SESSION['callback']);
    }
?>