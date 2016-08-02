<?php
    session_start();



?>
<!DOCTYPE html>
<html>
    <head>
        <title>KIBUAAT.SZE</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <?php
        if(isset($_GET['logout'])){
            session_unset();
            header("Location: index.php");
        }
        if(isset($_GET['callback'])){
            $_SESSION['callback'] = $_GET['callback'];
        }else{
            if(isset($_SESSION['login'])){
                $_SESSION['callback'] = 20;
            }else{
                $_SESSION['callback'] = 10;
            }
        }
        if(isset($_GET['id'])){
            $_SESSION['usercheck'] = $_GET['id'];
        }
        include "includes/frame.php";
        
        
        

        
    ?> 
    </body>
</html>