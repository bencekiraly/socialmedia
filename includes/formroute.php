<?php

    include "formadapter.php";

    $adapter = new DataAdapter();

    if(isset($_POST['loginmail']) && isset($_POST['loginpw'])){
        $adapter->login($_POST['loginmail'],$_POST['loginpw']);
        break;
    }
    
    $reg = 0;

    if(isset($_POST['reg'])){
        $reg = 1;
    }

    if(isset($_POST['regmail']) && isset($_POST['regname']) && isset($_POST['regpw1']) && isset($_POST['regpw2']) && $reg == 1){
        if($_POST['regpw1'] != $_POST['regpw2']){
            $reg = 0;
            header("Location: ../index.php?callback=201");
        }else{
            $reg = 0;
            $adapter->registration($_POST['regmail'], $_POST['regname'], $_POST['regpw1']);
        }
    }else if(empty($_POST['regmail']) && $reg == 1){
        $reg = 0;
        header("Location: ../index.php?callback=202");
    }else if(empty($_POST['regname']) && $reg == 1){
        $reg = 0;
        header("Location: ../index.php?callback=203");
    }else if(empty($_POST['regpw1']) && $reg == 1){
        $reg = 0;
        header("Location: ../index.php?callback=204");
    }else if(empty($_POST['regpw2']) && $reg == 1){
        $reg = 0;
        header("Location: ../index.php?callback=205");
    }

    $edit = 0;

    if(isset($_POST['edit'])){
        $edit = 1;
    }

    if(isset($_POST['editname']) && isset($_POST['editmail']) && $edit == 1){
        if(isset($_POST['editoldpw'])){
            if(empty($_POST['editpw1']) && empty($_POST['editpw2'])){
                header("Location: ../index.php?callback=305");
            }else if($_POST['editpw1'] != $_POST['editpw2']){
                header("Location: ../index.php?callback=304");
            }else{
                $adapter->edit($_POST['editmail'], $_POST['editname'], $_POST['editoldpw'], $_POST['editpw1'], $_POST['editpw2']);
            }
        }else if(empty($_POST['editoldpw']) && isset($_POST['editpw1'])){
            header("Location: ../index.php?callback=303");
        }
        if(empty($_POST['editoldpw'])){
            $adapter->edit($_POST['editmail'], $_POST['editname']);
        }
        if(isset($_FILES['image'])){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../upload/profilepic/".$_SESSION['userid'].".".$file_ext);
                $adapter->profilePic($_SESSION['userid'].".".$file_ext);
            }else{
                print_r($errors);
            }
        }
    }

    $tweet = 0;

    if(isset($_POST['tweet'])){
        $tweet = 1;
    }


    if($_POST['tweettext'] !== null && $tweet == 1){
        if(isset($_POST['hashtag'])){
            if(isset($_POST['cimzett'])){
                $adapter->newTweet($_POST['tweettext'], $_POST['cimzett'], $_POST['hashtag']);
            }else{
                $adapter->newTweet($_POST['tweettext'], 0, $_POST['hashtag']);
            }
        }else{
            if(isset($_POST['cimzett'])){
                $adapter->newTweet($_POST['tweettext'], $_POST['cimzett']);
            }else{
                $adapter->newTweet($_POST['tweettext']);
            }
        }
        if(isset($_FILES['image'])){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            $rand = rand(1000000, 9999999);
            $date = date('Hi');
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../upload/images/".$_SESSION['userid']."".$rand."".$date.".".$file_ext);
               $adapter->uploadImage($_SESSION['userid']."".$rand."".$date.".".$file_ext);
            }else{
                print_r($errors);
            }
        }
    }

    if(isset($_POST['tweetid']) && isset($_POST['liketweet'])){
        $adapter->likeTweet($_POST['tweetid'], $_POST['liketweet']);
    }

    if(isset($_POST['tweetid']) && isset($_POST['likedtweet']) && isset($_POST['userid'])){
        $adapter->likePageTweet($_POST['tweetid'], $_POST['likedtweet'], $_POST['userid']);
    }

    if(isset($_POST['hashtagb'])){
        $_SESSION['keyword'] = $_POST['hashtagb'];
        header("Location: ../index.php?callback=25");
    }

    if(isset($_POST['hashtaga'])){
        $_SESSION['keyword'] = $_POST['hashtaga'];
        header("Location: ../index.php?callback=26");
    }

?>