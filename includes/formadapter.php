<?php

    session_start();

    class DataAdapter{

        public $connect;
        private $tweetid;
        
        public function __construct(){
            
            require "../config/db.php";
            $connect = new Connect();
            $this->connect = $connect->getDb();
        }
        
        public function login($loginmail, $loginpw){
            if(1 == $this->connect->query("SELECT * FROM users WHERE email='".$loginmail."'")->num_rows){
                if(1 == $this->connect->query("SELECT * FROM users WHERE email='".$loginmail."' AND password='".$loginpw."'")->num_rows){
                    $this->connect->query("UPDATE users SET date='".date('Y.m.d H:i')."', logincount = logincount + 1 WHERE email='".$loginmail."'");
                    $logindata = $this->connect->query("SELECT * FROM users WHERE email='".$loginmail."' AND password='".$loginpw."'")->fetch_assoc();
                    $_SESSION['userid'] = $logindata['id'];
                    $_SESSION['nev'] = $logindata['name'];
                    $_SESSION['loginmail'] = $loginmail;
                    $profilepic = $this->connect->query("SELECT path FROM profile_pics WHERE user_id = (SELECT id FROM users WHERE email ='".$loginmail."')")->fetch_assoc();
                    $_SESSION['profilepic'] = $profilepic['path'];
                    if(empty($_SESSION['login'])){
                        $_SESSION['login'] = 1;    
                    }
                    echo $_SESSION['login'];
                    header("Location: ../index.php");
                }else{
                    header("Location: ../index.php?callback=102");
                }
            }else{
                header("Location: ../index.php?callback=101");
            }
        }
        
        public function registration($regmail, $regname, $regpw){
            if (!filter_var($regmail, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../index.php?callback=206");
            }else if(1 == $this->connect->query("SELECT * FROM users WHERE email='".$regmail."'")->num_rows){
                header("Location: ../index.php?callback=207");
            }else{
                $this->connect->query("INSERT INTO users(name, email, password, logincount) VALUES ('".$regname."','".$regmail."','".$regpw."',0)");
                header("Location: ../index.php?callback=200");
            }
        }
        
        public function edit($editmail, $editname, $editoldpw = null, $editnewpw = null){
            $change = 0;
            $logindata = $this->connect->query("SELECT * FROM users WHERE email='".$_SESSION['loginmail']."'")->fetch_assoc();
            if (!filter_var($editmail, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../index.php?callback=301");
            }else if(1 == $this->connect->query("SELECT * FROM users WHERE email='".$editmail."'")->num_rows && $_SESSION['loginmail'] != $editmail){
                header("Location: ../index.php?callback=302");
            }
            if($editoldpw != null){
                if($logindata['password'] != $editoldpw){
                    header("Location: ../index.php?callback=303");
                }else{
                    $this->connect->query("UPDATE users SET password='".$editnewpw."' WHERE email='".$_SESSION['loginmail']."'");
                    $change = 1;
                }
            }
            if($logindata['name'] != $editname){
                $this->connect->query("UPDATE users SET name='".$editname."' WHERE email='".$_SESSION['loginmail']."'");
                $_SESSION['nev'] = $editname;
                $change = 1;
            }
            if($logindata['email'] != $editmail){
                $this->connect->query("UPDATE users SET email='".$editmail."' WHERE email='".$_SESSION['loginmail']."'");
                $_SESSION['loginmail'] = $editmail;
                $change = 1;
            }
            if($change == 1){
                header("Location: ../index.php?callback=300");
            }             
        }
        
        
        public function profilePic($path){
            if(1 == $this->connect->query("SELECT * FROM profile_pics WHERE user_id='".$_SESSION['userid']."'")->num_rows){
                $this->connect->query("UPDATE profile_pics SET path='".$path."' WHERE user_id ='".$_SESSION['userid']."'");
            }else{
                $this->connect->query("INSERT INTO profile_pics(user_id, path) VALUES ('".$_SESSION['userid']."','".$path."')");
            }
            $_SESSION['profilepic'] = $path;
        }  
        
        public function newTweet($text, $cimzett = 0, $hashtag = null){
            $date = date('Y.m.d H:i:s');
            $this->connect->query("INSERT INTO tweets(text, user_id, date) VALUES ('".$text."','".$_SESSION['userid']."','".$date."')");
            $tweetdata = $this->connect->query("SELECT * FROM tweets WHERE user_id='".$_SESSION['userid']."' AND date='".$date."'")->fetch_assoc();
            $this->tweetid = $tweetdata['id'];
            if($hashtag != null){
                if($cimzett != 0){
                    $this->connect->query("INSERT INTO hashtags(tweet_id, keyword) VALUES ('".$tweetdata['id']."','".$hashtag."')");
                    $this->connect->query("INSERT INTO mentions(user_id, tweet_id) VALUES ('".$cimzett."','".$tweetdata['id']."')");
                }else{
                    echo $hashtag;
                    $this->connect->query("INSERT INTO hashtags(tweet_id, keyword) VALUES ('".$tweetdata['id']."','".$hashtag."')");
                }
            }else{
                if($cimzett != 0){
                    $this->connect->query("INSERT INTO mentions(user_id, tweet_id) VALUES ('".$cimzett."','".$tweetdata['id']."')");
                }
            }
            header("Location: ../index.php?callback=400");
        }
        
        public function uploadImage($path){
            $this->connect->query("INSERT INTO shared_pics(tweet_id, path) VALUES ('".$this->tweetid."','".$path."')");
        }
        
        public function likeTweet($tweetid, $isitlike){
            if($isitlike){
            $this->connect->query("INSERT INTO likes(user_id, tweet_id) VALUES ('".$_SESSION['userid']."','".$tweetid."')");
            }else{
                $this->connect->query("DELETE FROM likes WHERE user_id='".$_SESSION['userid']."' AND tweet_id='".$tweetid."'");
            }
            header("Location: ../index.php?callback=20");
        }
        
        public function likePageTweet($tweetid, $isitlike, $userid){
            if($isitlike){
            $this->connect->query("INSERT INTO likes(user_id, tweet_id) VALUES ('".$_SESSION['userid']."','".$tweetid."')");
            }else{
                $this->connect->query("DELETE FROM likes WHERE user_id='".$_SESSION['userid']."' AND tweet_id='".$tweetid."'");
            }
            header("Location: ../index.php?callback=24&id=".$userid."");
        }
        
    }
    

?>